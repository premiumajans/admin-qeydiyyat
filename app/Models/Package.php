<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Package extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title', 'price', 'alt'];
    
    protected $guarded = [];

    public function components()
    {
        $this->belongsToMany(Component::class,'package_components');
    }
}
