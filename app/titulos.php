<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class titulos extends Model
{
	protected $table = 'titulos';
    protected $fillable = ['nomtit'];
    protected $primaryKey = 'idtit';
}
