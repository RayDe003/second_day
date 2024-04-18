<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'year',
        'price',
        'is_new',
        'annotation'
    ];

    public function bookInstances()
    {
        return $this->hasMany(BookInstance::class, 'book_id', 'id');
    }

}