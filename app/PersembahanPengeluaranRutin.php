<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersembahanPengeluaranRutin extends Model
{
	protected $table = "persembahan_pengeluaran_rutin";
	protected $dates = ['tanggal'];

	protected $fillable = ["nama_pengguna","kode_persembahan_pengeluaran_rutin", "tanggal","kategori_id","detail_pengeluaran","cover","nominal","status","keterangan"];

	public function nama_kategori()
	{
		return $this->belongsTo('App\DetailKategori','kategori_id');
	}

	public function user()
    {
       return $this->belongsTo(User::class);
    }

	public function kategori_pengeluaran()
	{
		return $this->belongsTo('App\DetailPengeluaran','detail_pengeluaran');
	}
}
