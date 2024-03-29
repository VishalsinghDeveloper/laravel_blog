<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\AdminServices;

class category extends Model
{
    use HasFactory;

    public $table = 'categories';
    public $fillable = [
        'name',
        'description',
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
