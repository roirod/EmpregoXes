<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class especiali extends Model
{
	use SoftDeletes;

	protected $table = 'especiali';
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomesp'];
    protected $primaryKey = 'idesp';
}