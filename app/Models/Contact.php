<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'email', 'phone', 'address'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
