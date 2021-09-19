<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Keyword extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_keyword";
    protected $fillable = ['keyword_name','subject_id'];
}
