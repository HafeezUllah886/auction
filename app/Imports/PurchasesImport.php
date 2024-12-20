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
            'model' => $row['model'],
            'chassis' => $row['chassis'],
            'engine' => $row['engine'],
            'cno' => $row['cno'],
            'date' => $row['date'],
            'auction' => $row['auction'],
            'price' => $row['price'],
            'ptax' => $row['ptax'],
            'afee' => $row['afee'],
            'atax' => $row['atax'],
            'rikuso' => $row['rikuso'],
            'total' => $row['total'],
            'recycle' => $row['recycle'],
            'adate' => $row['adate'],
            'sdate' => $row['sdate'],
            'notes' => $row['notes'],
        ]);
    }
}
