<?php
/**
 * Created by PhpStorm.
 * User: Nelson
 * Date: 4/26/2019
 * Time: 11:06 AM
 */

namespace App\Imports;

use App\Data;
use Maatwebsite\Excel\Concerns\ToModel;

class DataImport implements ToModel{
    public function model(array $row)
    {
        // TODO: Implement model() method.
        return new Data([
            'name' => $row[1] . ' ' . $row[2],
            'email' => str_replace(' ', '', $row[3])
        ]);
    }
}