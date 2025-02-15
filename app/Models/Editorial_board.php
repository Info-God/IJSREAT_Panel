<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial_board extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'member_id';

    protected $keyType = 'int'; 
}
