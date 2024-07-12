<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model
{
    use HasFactory;
    protected $table = 'hari_libur';
    protected $guarded = ['id'];
    protected $casts = [
        'tanggal_awal'=> 'date',
        'tanggal_akhir'=> 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where(function($query) {
            $query = $query->orWhere(function($query){
                $query->whereDate('tanggal_akhir', '>=', request('start'))
                ->whereDate('tanggal_awal','<=', request('end'));
            });
        });
    }
}
