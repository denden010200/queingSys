<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class date_select extends Model
{
    use HasFactory;

    protected $fillables = [
        'date', 'slots'
    ];
}
