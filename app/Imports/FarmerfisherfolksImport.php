<?php

namespace App\Imports;

use App\Models\FarmerFisherfolk;
use Maatwebsite\Excel\Concerns\ToModel;

class FarmerfisherfolksImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if (!empty($row[0])) {
            return new FarmerFisherfolk([
                'rsbsa' => $row[0],
                'lastname' => $row[1],
                'firstname' => $row[2],
            ]);
          
        }

    }
}
