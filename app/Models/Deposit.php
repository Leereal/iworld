<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];
    /**
     * Get the user who placed the deposit
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the plan for  the deposit
     */
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    /**
     * Get the bank for  the deposit
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }
}
