<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Subject extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_subject";
    protected $fillable = ['subject_name'];
}
