<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'judul',
        'content',
    ];

    public $timestamps = false;
}
