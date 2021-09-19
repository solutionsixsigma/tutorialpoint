<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class QuestionType extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_typeofquestion";
    protected $fillable = ['typeofquestion_name'];
}
