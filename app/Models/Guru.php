<?php

namespace App\Models;

use App\Casts\GuruCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'jabatan',
        'level_jabatan',
        'urutan',
        'pelajaran',
        'photo'
    ];

    public $timestamps = false;
    protected function casts(): array
    {
        return [
            "photo" => GuruCast::class,
            "level_jabatan" => "integer",
             "urutan" => "integer"
        ];
    }
}
