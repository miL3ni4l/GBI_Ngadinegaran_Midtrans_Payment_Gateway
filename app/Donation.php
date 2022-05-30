<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    // protected $guarded = [];

    protected $table = "persembahan";
	protected $dates = ['created_at'];

	protected $fillable = ["donation_type","transaction_id", "donor_name","donor_email","amount","note","status","snap_token"];

    public function detail_kategori()
	{
		return $this->belongsTo('App\Donation','donation_type');
	}

    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setStatusPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setStatusFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setStatusExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
}
