<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsTranslation extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
    ];
}
