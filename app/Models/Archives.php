<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{
    use HasFactory;

    protected $guarded = ['paper_uniqueid'];

    protected $primaryKey = 'paper_id';

    protected $keyType = 'int'; 
}
