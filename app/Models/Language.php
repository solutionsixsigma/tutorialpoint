<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Language extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_language";
    protected $fillable = ['language_name','language_ico'];
}
