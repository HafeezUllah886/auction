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
        return Purchase::select('year', 'maker', 'model', 'chassis', 'engine', 'yard', 'date', 'auction', 'price', 'ptax', 'afee', 'atax', 'transport_charges', 'recycle','total', 'adate', 'ddate', 'notes')
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
            'Yard',
            'Purchase Date',
            'Auction',
            'Price',
            'Purchase Tax',
            'Auction Fee',
            'Auction Tax',
            'Transport Charges',
            'Recycle',
            'Total',
            'Arrival Date',
            'Document Date',
            'Notes'
        ];
    }
}
