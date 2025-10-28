<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\excel_export as ExcelExportModel;
use App\Models\excel_export_cars as ExcelExportCars;
use App\Models\excel_export_parts as ExcelExportParts;

class excel_export implements WithMultipleSheets
{
    protected $id;
   
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function sheets(): array
    {
        return [
            new ExcelExportMainSheet($this->id),
            new ExcelExportCarsSheet($this->id),
            new ExcelExportPartsSheet($this->id),
        ];
    }
}

class ExcelExportMainSheet implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return ExcelExportModel::where('excel_export.id', $this->id)
            ->get([
                'excel_export.c_no',
                'excel_export.bl_no',
                'excel_export.bl_amount',
                'excel_export.bl_amount_pkr',
                'excel_export.container_amount',
                'excel_export.net_amount',
                'excel_export.conversion_rate',
                'excel_export.date',
            ]);
    }

    public function headings(): array
    {
        return [
            'C No',
            'BL No',
            'BL Amount',
            'BL Amount (PKR)',
            'Container Amount',
            'Net Amount',
            'Conversion Rate',
            'Date'
        ];
    }

    public function title(): string
    {
        return 'excel_export';
    }
}

class ExcelExportCarsSheet implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return ExcelExportCars::where('excel_export_id', $this->id)->get([
            'model',
            'maker',
            'chassis_no',
            'auction',
            'year',
            'color',
            'grade',
            'price',
            'price_pkr',
            'remarks',
        ]);
    }

    public function headings(): array
    {
        return [
            'Model',
            'Maker',
            'Chassis No',
            'Auction',
            'Year',
            'Color',
            'Grade',
            'Price',
            'Price (PKR)',
            'Remarks'
        ];
    }

    public function title(): string
    {
        return 'excel_export_cars';
    }
}

class ExcelExportPartsSheet implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return ExcelExportParts::where('excel_export_id', $this->id)->get([
            'description',
            'weight_ltr',
            'grade',
            'qty',
            'price',
            'price_pkr',
        ]);
    }

    public function headings(): array
    {
        return [
            'Description',
            'Weight (Ltr)',
            'Grade',
            'Quantity',
            'Price',
            'Price (PKR)'
        ];
    }

    public function title(): string
    {
        return 'excel_export_parts';
    }
}