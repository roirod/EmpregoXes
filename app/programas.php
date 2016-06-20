<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class programas extends Model
{
	use SoftDeletes;

	protected $table = 'programas';
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomprog','feini','fefin','notas'];
    protected $primaryKey = 'idprog';
}