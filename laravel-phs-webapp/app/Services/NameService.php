<?php

namespace App\Services;

use App\Models\NameDetails;

class NameService
{
    /**
     * Create or find a name record
     */
    public static function createOrFindName($firstName, $lastName, $middleName = null, $nickname = null, $nameExtension = null)
    {
        // Check if name already exists
        $existingName = NameDetails::where('first_name', $firstName)
            ->where('last_name', $lastName)
            ->where('middle_name', $middleName)
            ->where('name_extension', $nameExtension)
            ->first();

        if ($existingName) {
            return $existingName;
        }

        // Create new name record
        return NameDetails::create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'nickname' => $nickname,
            'name_extension' => $nameExtension,
        ]);
    }

    /**
     * Update an existing name record
     */
    public static function updateName($nameId, $firstName, $lastName, $middleName = null, $nickname = null, $nameExtension = null)
    {
        $name = NameDetails::find($nameId);
        
        if (!$name) {
            return null;
        }

        $name->update([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'nickname' => $nickname,
            'name_extension' => $nameExtension,
        ]);

        return $name;
    }

    /**
     * Parse a full name into components
     */
    public static function parseFullName($fullName)
    {
        $nameParts = explode(' ', trim($fullName));
        
        if (count($nameParts) === 1) {
            return [
                'first_name' => $nameParts[0],
                'middle_name' => null,
                'last_name' => '',
            ];
        }

        $firstName = $nameParts[0];
        $lastName = end($nameParts);
        $middleName = count($nameParts) > 2 ? implode(' ', array_slice($nameParts, 1, -1)) : null;

        return [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
        ];
    }

    /**
     * Get full name from NameDetails
     */
    public static function getFullName($nameDetails)
    {
        if (!$nameDetails) {
            return '';
        }

        $name = $nameDetails->first_name;
        
        if ($nameDetails->middle_name) {
            $name .= ' ' . $nameDetails->middle_name;
        }
        
        $name .= ' ' . $nameDetails->last_name;
        
        if ($nameDetails->name_extension) {
            $name .= ' ' . $nameDetails->name_extension;
        }

        return $name;
    }
} 