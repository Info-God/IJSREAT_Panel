<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Indexing extends Model
{
    use HasFactory;

    protected $fillable = ["indexing_image_url", "indexing_name", "indexing_url"];

    protected $primaryKey = 'indexing_id';

    protected $keyType = 'int'; 
}
