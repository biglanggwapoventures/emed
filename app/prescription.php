<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    protected $fillable = [
		'brandname','genericname','quantity','dosage','frequency','start','end','pnotes'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
