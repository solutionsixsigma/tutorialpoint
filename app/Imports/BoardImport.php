<?php

namespace App\Imports;

use App\Models\Board;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BoardImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new Board([
            'board_name' => $row['board_name'],
            'board_type' => $row['board_type'],
            'board_nick' => $row['board_nick'],
        ]);
    }

}
