<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'parent_id',
        'level',
        'menu',
        'hasContent',
    ];

    public $timestamps = false;


    protected function casts():array
    {
        return ['parent_id'=>'int','level'=>'int', 'hasContent'=>'boolean'];
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(MenuContent::class, "parent_id");
    }

}
