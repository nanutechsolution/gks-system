<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar_sampul',
        'is_published',
        'tanggal_publish',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'tanggal_publish' => 'date',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
