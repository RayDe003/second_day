<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Authors_books extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'author_id',
        'book_id'
    ];
}
