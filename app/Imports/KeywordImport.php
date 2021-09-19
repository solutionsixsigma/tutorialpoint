<?php

namespace App\Imports;

use App\Models\Keyword;
use Maatwebsite\Excel\Concerns\ToModel;

class KeywordImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Keyword([
            //
        ]);
    }
}
