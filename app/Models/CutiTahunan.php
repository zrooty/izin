<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CutiTahunan extends Model
{
    use HasFactory;

    protected $table = 'cuti_tahunan';
    protected $guarded = ['id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sisaCuti(): Attribute
    {
        return Attribute::make(get: fn ($value, $attribute) => $attribute['total'] - $attribute['digunakan']);
    }
}
