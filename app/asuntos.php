<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class asuntos extends Model
{
	use SoftDeletes;

	protected $table = 'asuntos';
	protected $dates = ['deleted_at'];	
    protected $fillable = ['nomasu'];
    protected $primaryKey = 'idasu';
}
