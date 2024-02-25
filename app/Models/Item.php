<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'status'];

    public function user()  //item테이블과 user테이블 관계를 맺는..
    {
        return $this->belongsTo(User::class);
    }
}
