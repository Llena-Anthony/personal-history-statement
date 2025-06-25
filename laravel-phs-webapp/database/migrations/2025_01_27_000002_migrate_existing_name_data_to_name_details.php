<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Migrate PHS name data
        $phsRecords = DB::table('p_h_s')->whereNotNull('first_name')->get();
        foreach ($phsRecords as $record) {
            $nameId = DB::table('name_details')->insertGetId([
                'first_name' => $record->first_name,
                'middle_name' => $record->middle_name,
                'last_name' => $record->last_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            DB::table('p_h_s')->where('id', $record->id)->update(['name_id' => $nameId]);
        }

        // Migrate FamilyBackground name data
        $familyBackgrounds = DB::table('family_backgrounds')->get();
        foreach ($familyBackgrounds as $record) {
            // Spouse name
            if ($record->spouse_first_name && $record->spouse_last_name) {
                $spouseNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->spouse_first_name,
                    'middle_name' => $record->spouse_middle_name,
                    'last_name' => $record->spouse_last_name,
                    'name_extension' => $record->spouse_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['spouse_name_id' => $spouseNameId]);
            }

            // Father name
            if ($record->father_first_name && $record->father_last_name) {
                $fatherNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->father_first_name,
                    'middle_name' => $record->father_middle_name,
                    'last_name' => $record->father_last_name,
                    'name_extension' => $record->father_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['father_name_id' => $fatherNameId]);
            }

            // Mother name
            if ($record->mother_first_name && $record->mother_last_name) {
                $motherNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->mother_first_name,
                    'middle_name' => $record->mother_middle_name,
                    'last_name' => $record->mother_last_name,
                    'name_extension' => $record->mother_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['mother_name_id' => $motherNameId]);
            }

            // Step parent/guardian name
            if ($record->step_parent_guardian_first_name && $record->step_parent_guardian_last_name) {
                $stepParentNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->step_parent_guardian_first_name,
                    'middle_name' => $record->step_parent_guardian_middle_name,
                    'last_name' => $record->step_parent_guardian_last_name,
                    'name_extension' => $record->step_parent_guardian_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['step_parent_guardian_name_id' => $stepParentNameId]);
            }

            // Father-in-law name
            if ($record->father_in_law_first_name && $record->father_in_law_last_name) {
                $fatherInLawNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->father_in_law_first_name,
                    'middle_name' => $record->father_in_law_middle_name,
                    'last_name' => $record->father_in_law_last_name,
                    'name_extension' => $record->father_in_law_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['father_in_law_name_id' => $fatherInLawNameId]);
            }

            // Mother-in-law name
            if ($record->mother_in_law_first_name && $record->mother_in_law_last_name) {
                $motherInLawNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->mother_in_law_first_name,
                    'middle_name' => $record->mother_in_law_middle_name,
                    'last_name' => $record->mother_in_law_last_name,
                    'name_extension' => $record->mother_in_law_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('family_backgrounds')->where('id', $record->id)->update(['mother_in_law_name_id' => $motherInLawNameId]);
            }
        }

        // Migrate MaritalStatus name data
        $maritalStatuses = DB::table('marital_statuses')->get();
        foreach ($maritalStatuses as $record) {
            if ($record->spouse_first_name && $record->spouse_last_name) {
                $spouseNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $record->spouse_first_name,
                    'middle_name' => $record->spouse_middle_name,
                    'last_name' => $record->spouse_last_name,
                    'name_extension' => $record->spouse_suffix,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('marital_statuses')->where('id', $record->id)->update(['spouse_name_id' => $spouseNameId]);
            }
        }

        // Migrate Siblings name data
        if (Schema::hasTable('siblings')) {
            $siblings = DB::table('siblings')->get();
            foreach ($siblings as $record) {
                if ($record->first_name && $record->last_name) {
                    $nameId = DB::table('name_details')->insertGetId([
                        'first_name' => $record->first_name,
                        'middle_name' => $record->middle_name,
                        'last_name' => $record->last_name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    DB::table('siblings')->where('id', $record->id)->update(['name_id' => $nameId]);
                }
            }
        }

        // Migrate CharacterReferences name data
        $characterReferences = DB::table('character_references')->get();
        foreach ($characterReferences as $record) {
            if ($record->ref_name) {
                // Parse the ref_name to extract first, middle, last names
                $nameParts = explode(' ', trim($record->ref_name));
                $firstName = $nameParts[0] ?? '';
                $lastName = end($nameParts) ?? '';
                $middleName = count($nameParts) > 2 ? implode(' ', array_slice($nameParts, 1, -1)) : null;
                
                $nameId = DB::table('name_details')->insertGetId([
                    'first_name' => $firstName,
                    'middle_name' => $middleName,
                    'last_name' => $lastName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('character_references')->where('ref_id', $record->ref_id)->update(['ref_name_id' => $nameId]);
            }
        }

        // Migrate Children name data
        $children = DB::table('children')->get();
        foreach ($children as $record) {
            if ($record->name) {
                // Parse the name to extract first, middle, last names
                $nameParts = explode(' ', trim($record->name));
                $firstName = $nameParts[0] ?? '';
                $lastName = end($nameParts) ?? '';
                $middleName = count($nameParts) > 2 ? implode(' ', array_slice($nameParts, 1, -1)) : null;
                
                $nameId = DB::table('name_details')->insertGetId([
                    'first_name' => $firstName,
                    'middle_name' => $middleName,
                    'last_name' => $lastName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('children')->where('id', $record->id)->update(['name_id' => $nameId]);
            }
        }
    }

    public function down()
    {
        // This migration is not reversible as it involves data transformation
        // The data would need to be manually restored if needed
    }
}; 