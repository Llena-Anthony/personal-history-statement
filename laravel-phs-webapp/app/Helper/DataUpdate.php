<?php

namespace App\Helper;

use App\Models\ReferenceDetail;
use App\Models\Miscellaneous;

class DataUpdate {
    /**
     * Update or create character references for a user.
     */
    public static function updateCharacterReferences($username, $references) {
        ReferenceDetail::where('username', $username)
            ->where('ref_type', 'character')
            ->delete();
        foreach ($references as $reference) {
            if (!empty($reference['name']) || !empty($reference['address'])) {
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'character',
                    'ref_name' => $reference['name'] ?? '',
                    'ref_address' => $reference['address'] ?? '',
                ]);
            }
        }
    }

    /**
     * Update or create neighbor references for a user.
     */
    public static function updateNeighbors($username, $neighbors) {
        ReferenceDetail::where('username', $username)
            ->where('ref_type', 'neighbor')
            ->delete();
        foreach ($neighbors as $neighbor) {
            if (!empty($neighbor['name']) || !empty($neighbor['address'])) {
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'neighbor',
                    'ref_name' => $neighbor['name'] ?? '',
                    'ref_address' => $neighbor['address'] ?? '',
                ]);
            }
        }
    }
}
