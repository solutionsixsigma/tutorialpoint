<?php

namespace App\Imports;

use App\Models\SubTopics;
use Maatwebsite\Excel\Concerns\ToModel;

class SubTopicsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubTopics([
            //
        ]);
    }
}
