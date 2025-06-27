<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditReputation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dependent_on_salary',
        'has_loans',
        'has_filed_assets_liabilities',
        'assets_liabilities_agency',
        'assets_liabilities_month',
        'assets_liabilities_year',
        'has_filed_itr',
        'itr_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function otherIncomes()
    {
        return $this->hasMany(OtherIncome::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function characterReferences()
    {
        return $this->hasMany(CharacterReference::class);
    }
}
