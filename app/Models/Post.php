<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\PostService;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(category::class,'post_categorys');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function category()
    // {
    //     return $this->belongsTo(category::class);
    // }




}
