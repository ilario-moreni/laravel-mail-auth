<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Str;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description'];

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }
}