<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference_Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'organised_by',
        'conference_date',
        'volume',
        'year',
        'issue',
    ];
}
