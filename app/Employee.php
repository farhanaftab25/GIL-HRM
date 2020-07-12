<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
