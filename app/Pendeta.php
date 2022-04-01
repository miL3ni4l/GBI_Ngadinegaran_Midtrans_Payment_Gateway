<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendeta extends Model
{

    protected $table = 'pendetas';
	protected $dates = ['tgl_lahir'];

	protected $fillable = ['nama_pendeta','alias', 'tempat_lahir','tgl_lahir','tlp_pendeta', 'istri', 'pendidikan', 'karir', 'biografi', 'keterangan_pendeta', 'cover'];

}
