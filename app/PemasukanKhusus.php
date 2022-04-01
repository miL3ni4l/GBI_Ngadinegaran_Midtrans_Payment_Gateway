<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemasukanKhusus extends Model
{
	protected $table = "pemasukan_khusus";
	protected $dates = ['tanggal'];

	protected $fillable = ["nama_pengguna","kode_pemasukan_khusus", "tanggal","kategori_id","kas_id","ibadah_id","cover","nominal","status","keterangan"];

	public function detail_kategori()
	{
		return $this->belongsTo('App\DetailKategori','kategori_id');
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
