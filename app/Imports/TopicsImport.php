<?php

namespace App\Imports;

use App\Models\Topics;
use Maatwebsite\Excel\Concerns\ToModel;

class TopicsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Topics([
            //
        ]);
    }
}
