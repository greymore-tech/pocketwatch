<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versions extends Model
{
    use HasFactory;
    
    protected $table = "versions";
    protected $fillable = ['version_number'];
}
