<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asuntos extends Model
{
	protected $table = 'asuntos';
    protected $fillable = ['nomasu'];
    protected $primaryKey = 'idasu';
}
