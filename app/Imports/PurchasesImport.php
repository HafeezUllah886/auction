<?php
// filepath: /C:/laragon/www/auction/app/Imports/PurchasesImport.php
namespace App\Imports;

use App\Models\purchase;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchasesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new purchase([
            'year' => $row[0],
            'model' => $row[1],
            'chassis' => $row[2],
            'engine' => $row[3],
            'cno' => $row[4],
            'date' => $row[5],
            'auction' => $row[6],
            'price' => $row[7],
            'ptax' => $row[8],
            'afee' => $row[9],
            'atax' => $row[10],
            'rikuso' => $row[11],
            'total' => $row[12],
            'recycle' => $row[13],
            'adate' => $row[14],
            'sdate' => $row[15],
            'notes' => $row[16],
        ]);
    }
}
