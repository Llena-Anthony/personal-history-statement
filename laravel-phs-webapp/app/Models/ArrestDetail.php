<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class ArrestDetail extends Model
{
    protected $primaryKey = 'arrest_detail_id';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'court_name',
        'nature_of_offense',
        'disposition_of_case',
    ];

    public function getSearchableFields()
    {
        return [
            'court_name' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Name of Court'
            ],
            'nature_of_offense' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Nature of Offense'
            ],
            'disposition_of_case' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Disposition of the Case'
            ]
        ];
    }
}
