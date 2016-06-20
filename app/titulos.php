<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class titulos extends Model
{
	use SoftDeletes;

	protected $table = 'titulos';
	protected $dates = ['deleted_at'];	
    protected $fillable = ['nomtit'];
    protected $primaryKey = 'idtit';
}
