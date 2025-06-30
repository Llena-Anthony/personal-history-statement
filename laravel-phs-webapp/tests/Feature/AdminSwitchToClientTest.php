<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AdminSwitchToClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_switch_to_client_view()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'is_active' => true
        ]);

        // Login as admin
        $this->actingAs($admin);

        // Test switching to client view
        $response = $this->get(route('admin.switch.to.client'));

        // Should redirect to client dashboard
        $response->assertRedirect(route('client.dashboard'));
        
        // Should have success message
        $response->assertSessionHas('success', 'Welcome to your PHS! You can now fill out and manage your Personal History Statement as an Academy member.');

        // Should set session variables
        $this->assertTrue(session('admin_switched_to_client'));
        $this->assertNotNull(session('admin_original_route'));

        // Should log the activity
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $admin->id,
            'description' => 'Admin accessed their own PHS as an Academy member',
            'status' => 'success',
            'action' => 'access_own_phs'
        ]);
    }

    public function test_admin_can_return_to_admin_view()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'is_active' => true
        ]);

        // Login as admin
        $this->actingAs($admin);

        // Set session as if admin switched to client
        session(['admin_switched_to_client' => true]);
        session(['admin_original_route' => route('admin.dashboard')]);

        // Test returning to admin view
        $response = $this->get(route('return.to.admin'));

        // Should redirect to admin dashboard
        $response->assertRedirect(route('admin.dashboard'));
        
        // Should have success message
        $response->assertSessionHas('success', 'Returned to admin view.');

        // Should clear session variables
        $this->assertNull(session('admin_switched_to_client'));
        $this->assertNull(session('admin_original_route'));

        // Should log the activity
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $admin->id,
            'description' => 'Admin returned to admin view from PHS management',
            'status' => 'success',
            'action' => 'return_to_admin'
        ]);
    }

    public function test_non_admin_cannot_access_switch_route()
    {
        // Create a regular user
        $user = User::factory()->create([
            'usertype' => 'client',
            'is_active' => true
        ]);

        // Login as regular user
        $this->actingAs($user);

        // Test accessing switch route
        $response = $this->get(route('admin.switch.to.client'));

        // Should be forbidden
        $response->assertStatus(403);
    }
} 