<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = ['name', 'email', 'phone', 'status', 'assigned_to', 'notes'];

    public function agent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

}
