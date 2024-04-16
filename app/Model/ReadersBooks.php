<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReadersBooks extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'get_back',
        'get_out',
        'book_instance',
        'status',
        'librarian',
        'reader'
    ];

    protected $table = 'readers_books';
}