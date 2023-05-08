<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Component extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['title'];

    protected $guarded = [];

    public function package()
    {
        return $this->belongsToMany(Package::class, 'package_components', 'component_id', 'package_id');
    }
}
