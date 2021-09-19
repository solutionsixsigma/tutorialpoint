<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SubTopics extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_subtopics";
    protected $fillable = ['subtopics_name','subject_id','topics_id'];
}
