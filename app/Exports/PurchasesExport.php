<?php
// filepath: /C:/laragon/www/auction/app/Exports/PurchasesExport.php
namespace App\Exports;

use App\Models\purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchasesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Purchase::select('year', 'maker', 'model', 'chassis', 'engine', 'cno', 'date', 'auction', 'price', 'ptax', 'afee', 'atax', 'rikuso', 'total', 'recycle', 'adate', 'sdate', 'notes')
            ->whereBetween('date', [$this->start, $this->end])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Year',
            'Maker',
            'Model',
            'Chassis No.',
            'Engine No.',
            'CNO',
            'Purchase Date',
            'Auction',
            'Price',
            'Purchase Tax',
            'Auction Fee',
            'Auction Tax',
            'Rikuso',
            'Total',
            'Recycle',
            'Arrival Date',
            'Syorui Date',
            'Notes'
        ];
    }
}
