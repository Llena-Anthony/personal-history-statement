<?php

namespace App\Models;

use Carbon\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class FluencyDetail extends Model
{
    public $timestamps = false;
    public $fillable = [
        'username',
        'lang',
        'speak_fluency',
        'read_fluency',
        'write_fluency'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'username','username');
    }
    public function languageDetail()
    {
        return $this->belongsTo(LanguageDetail::class,'lang','lang_id');
    }
}
