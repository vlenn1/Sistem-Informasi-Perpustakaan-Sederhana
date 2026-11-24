<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Hasmany;

class Category extends Model
{
    protected $fillable = ['name',];

    public function books():Hasmany{
        return $this->hasMany(Book::class);
    }
}
