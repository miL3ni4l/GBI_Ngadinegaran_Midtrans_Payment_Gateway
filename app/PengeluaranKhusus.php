<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengeluaranKhusus extends Model
{
	protected $table = "pengeluaran_khusus";
	protected $dates = ['tanggal'];

	protected $fillable = ["nama_pengguna","kode_pemasukan_rutin", "tanggal","kategori_id","kas_id","cover","nominal","status","keterangan"];

	public function detail_kategori()
	{
		return $this->belongsTo('App\DetailKategori','kategori_id');
	}

	public function kas()
	{
		return $this->belongsTo('App\Kas');
	}

	public function user()
    {
       return $this->belongsTo(User::class);
    }
}
