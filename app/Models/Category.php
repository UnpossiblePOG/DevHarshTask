<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    public function materials(): HasMany
    {
        //below part firms a relationship between category data and Material Data
        //By defining hasMany, we can use Eloquent syntax like with(),whereHas(), has(),withCount()
        //find(), create() and so on.. Otherwise we have to use basic queries to fetch data.
        return $this->hasMany(Material::class);
    }
}