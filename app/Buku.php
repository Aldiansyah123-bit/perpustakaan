<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'id_kategori', 'judul','keterangan', 'stock', 'penulis', 'gambar', 'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori','id');
    }
}
