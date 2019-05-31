<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    protected $table = 'units';
    use SoftDeletes;

    public function createdBy() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updatedBy() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
}
