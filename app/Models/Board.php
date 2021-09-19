<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Board extends Model
{
    use HasFactory;
    protected $table="tutorialpoint_board";
    protected $fillable = ['board_name', 'board_type','board_nick'];
}

