<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Relation\BelongsTo;



class Project extends Model
{
    protected $fillable = ['title', 'type_id', 'description', 'members_num', 'budget', 'slug'];


    use HasFactory;

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}