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
            'year' => $row['Year'],
            'model' => $row['Model'],
            'chassis' => $row['Chassis'],
            'engine' => $row['Engine'],
            'cno' => $row['Cno'],
            'date' => $row['Purchase Date'],
            'auction' => $row['Auction'],
            'price' => $row['Price'],
            'ptax' => $row['P_Tax'],
            'afee' => $row['Auction Fee'],
            'atax' => $row['Fee Tax'],
            'rikuso' => $row['Rikuso'],
            'total' => $row['Total'],
            'recycle' => $row['Recycle'],
            'adate' => $row['Arrival Date'],
            'sdate' => $row['Syorui Date'],
            'notes' => $row['Notes'],
        ]);
    }
}
