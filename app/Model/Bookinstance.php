<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bookinstance extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'book_id',
        'ISBN'
    ];
    protected $table = 'bookInstance';

    public function readerBooks()
    {
        return $this->hasMany(ReadersBooks::class, 'book_instance', 'ISBN');
    }
}