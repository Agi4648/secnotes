<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'content',
      'favorite',
      'user_id'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
}
