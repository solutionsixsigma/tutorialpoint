<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Topics extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_topics";
    protected $fillable = ['topics_name','subject_id'];
}
