<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'user_id'];

    public function postCreator() {
        return $this->belongsTo(User::class , 'user_id');
    }
}
