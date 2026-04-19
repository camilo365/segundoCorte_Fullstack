<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technician;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'status',
        'due_date',
        'technician_id',
    ];

    public function technician(){
        return $this->belongsTo(Technician::class);
    }

}