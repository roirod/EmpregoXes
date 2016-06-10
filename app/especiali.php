<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class especiali extends Model
{
	protected $table = 'especiali';
    protected $fillable = ['nomesp'];
    protected $primaryKey = 'idesp';
}