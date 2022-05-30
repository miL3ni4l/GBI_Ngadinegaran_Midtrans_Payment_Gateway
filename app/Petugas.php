<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

	protected $fillable = ['kode_petugas','user_id', 'nama','jk','alamat', 'no_telp'];

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

	public function kategori()
    {
    	return $this->hasMany(Kategori::class);
    }

    public function persembahan_pengeluaran_rutin()
    {
    	return $this->hasManyThrough(PersembahanPengeluaranRutin::class);
    }
}
