<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class especiprog extends Model
{
	protected $table = 'especiprog';
    protected $fillable = ['idesp','idprog'];
    protected $primaryKey = 'idesprog';
}