<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
		'name',
		'branches'
	];

	protected $casts = [
		'branches' => 'array'
	];
}
