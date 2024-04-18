<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Reader extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'address',
        'phone_number'
    ];

    public function books()
    {
        return $this->hasManyThrough(Book::class, ReadersBooks::class, 'reader', 'id', 'id', 'book_instance')
            ->with('bookInstance.book_id');
    }

    public function ReadersBooks()
    {
        return $this->hasMany(ReadersBooks::class, 'reader');
    }
}