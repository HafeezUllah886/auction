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
        dd($row);
        return new purchase([
            'year' => $row['year'],
            'model' => $row['model'],
            'chassis' => $row['chassis_no'],
            'engine' => $row['engine_no'],
            'cno' => $row['cno'],
            'date' => $row['p_date'],
            'auction' => $row['auction'],
            'price' => $row['price'],
            'ptax' => $row['p_tax'],
            'afee' => $row['auction_fee'],
            'atax' => $row['fee_tax'],
            'rikuso' => $row['rikuso'],
            'total' => $row['total'],
            'recycle' => $row['recycle'],
            'adate' => $row['arrival_date'],
            'sdate' => $row['syorui_date'],
            'notes' => $row['notes'],
            'refID' => getRef(),
        ]);
    }
}
