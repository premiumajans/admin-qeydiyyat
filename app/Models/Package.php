<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Package extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'title', 
        'price', 
        'exchange', 
        'alt',
    ];
    
    protected $guarded = [];

    public function component()
    {
        return $this->belongsToMany(Component::class, 'package_components', 'package_id', 'component_id');
    }
}
