<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table = "transaksi";
	protected $dates = ['tanggal'];

	protected $fillable = ["nama_pengguna","kode_transaksi", "tanggal","kategori_id","kas_id","ibadah_id","cover","nominal","status","keterangan"];

	public function detail_kategori()
	{
		return $this->belongsTo('App\DetailKategori','kategori_id');
	}

	public function nama_kategori()
	{
		return $this->belongsTo('App\Kategori','kategori_id');
	}

	public function kas()
	{
		return $this->belongsTo('App\Kas');
	}

	public function nama_ibadah()
	{
		return $this->belongsTo('App\Ibadah','ibadah_id');
	}

	public function user()
    {
       return $this->belongsTo(User::class);
    }
}
