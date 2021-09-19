<?php

namespace App\Imports;

use App\Models\Classes;
use Maatwebsite\Excel\Concerns\ToModel;

class ClassesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Classes([
            //
        ]);
    }
}
