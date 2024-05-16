<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'judul',
        'ringkasan',
        'konten',
        'gambar',
        'kategori',
        'publish',
        'oncarousel',
        'user_id',
    ];


    protected function casts():array{
        return    ['publish' => 'boolean','oncarousel'=>'boolean'];
    } 


    public function author(): BelongsTo
    {
        return  $this->belongsTo(User::class, "user_id");
    }
}
