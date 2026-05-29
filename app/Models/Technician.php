<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        'surnames',
        'age',
        'area',
        'email',
        'photo',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
