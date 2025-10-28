<?php

namespace App\Http\Controllers;

use App\Exports\excel_export as ExcelExport;
use App\Imports\PurchasesImport;
use App\Models\accounts;
use App\Models\auctions;
use App\Models\excel_export;
use App\Models\excel_export_cars;
use App\Models\excel_export_parts;
use App\Models\yards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = $request->start ?? firstDayOfMonth();
        $end = $request->end ?? lastDayOfMonth();

        $exports = excel_export::whereBetween('date', [$start, $end])->orderby('id', 'desc')->get();

        return view('excel_export.index', compact('exports', 'start', 'end'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('excel_export.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $export = excel_export::create(
                [
                    'date' => $request->date,
                    'c_no' => $request->cno,
                    'bl_no' => $request->bl_no,
                    'bl_amount' => $request->bl_amount,
                    'bl_amount_pkr' => $request->bl_amount_pkr,
                    'conversion_rate' => $request->ex_rate,
                    'key' => $request->key,
                ]
            );

            $total = 0;

            $cars = $request->car_id;

            if ($cars) {

                foreach ($cars as $key => $car) {
                    $total += $request->price_pkr[$key];
                    excel_export_cars::create(
                        [
                            'excel_export_id' => $export->id,
                            'model' => $request->model[$key],
                            'maker' => $request->maker[$key],
                            'chassis_no' => $request->chassis[$key],
                            'auction' => $request->auction[$key],
                            'year' => $request->year[$key],
                            'color' => $request->color[$key],
                            'grade' => $request->grade[$key],
                            'price' => $request->price[$key],
                            'price_pkr' => $request->price_pkr[$key],
                            'remarks' => $request->remarks[$key],
                        ]
                    );
                }

            }

            $parts = $request->part_id;

            if ($parts) {

                foreach ($parts as $key => $part) {
                    $total += $request->part_price_pkr[$key];
                    excel_export_parts::create(
                        [
                            'excel_export_id' => $export->id,
                            'description' => $request->part_desc[$key],
                            'weight_ltr' => $request->part_weight[$key],
                            'grade' => $request->part_grade[$key],
                            'qty' => $request->part_qty[$key],
                            'price' => $request->part_price[$key],
                            'price_pkr' => $request->part_price_pkr[$key],
                        ]
                    );
                }
            }

            $net_amount = $total + $request->bl_amount_pkr;

            $export->update(
                [
                    'container_amount' => $total,
                    'net_amount' => $net_amount,
                ]
            );

            DB::commit();

            return to_route('excel_export.index')->with('success', 'Export Created');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $export = excel_export::find($id);

        return view('excel_export.view', compact('export'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $export = excel_export::find($id);
        $yards = yards::all();
        $auctions = auctions::all();

        $transporters = accounts::where('type', 'Transporter')->get();

        return view('excel_export.edit', compact('export', 'yards', 'auctions', 'transporters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'chassis' => 'required|unique:purchases,chassis,'.$id,
                ],
                [
                    'chassis.unique' => 'Chassis No. Already Exist',
                ]
            );
            DB::beginTransaction();

            $export = excel_export::find($id);
            $export->update(
                [
                    'transporter_id' => $request->transporter,
                    'year' => $request->year,
                    'maker' => $request->maker,
                    'model' => $request->model,
                    'chassis' => $request->chassis,
                    'loot' => $request->loot,
                    'yard' => $request->yard,
                    'date' => $request->date,
                    'auction' => $request->auction,
                    'price' => $request->price,
                    'ptax' => $request->ptax,
                    'afee' => $request->afee,
                    'atax' => $request->atax,
                    'transport_charges' => $request->transport_charges,
                    'total' => $request->total,
                    'recycle' => $request->recycle,
                    'adate' => $request->adate,
                    'ddate' => $request->ddate,
                    'number_plate' => $request->number_plate,
                    'nvalidity' => $request->nvalidity,
                    'notes' => $request->notes,
                ]
            );

            DB::commit();

            return to_route('excel_export.show', $export->id)->with('success', 'Export Updated');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $export = excel_export::find($id);
            $export->delete();
            DB::commit();
            session()->forget('confirmed_password');

            return redirect()->route('excel_export.index')->with('success', 'Export Deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->forget('confirmed_password');

            return redirect()->route('excel_export.index')->with('error', $e->getMessage());
        }
    }

    public function export($id)
    {
        return Excel::download(new ExcelExport($id), 'export_' . $id . '.xlsx');
    }

    public function import(Request $request)
    {
        try {
            $file = $request->file('excel');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'xlsx') {
                Excel::import(new ExcelExportImport, $file);

                return back()->with('success', 'Successfully imported');
            } else {
                return back()->with('error', 'Invalid file extension');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

   public function send_purchase($id)
{
    $purchase = excel_export::find($id);

    $cars = [];
    foreach ($purchase->cars as $car) {
        $cars[] = [
            'purchase_id' => $purchase->id,
            'model' => $car->model,
            'maker' => $car->maker,
            'chassis_no' => $car->chassis_no,
            'auction' => $car->auction,
            'year' => $car->year,
            'color' => $car->color,
            'grade' => $car->grade,
            'price' => $car->price,
            'price_pkr' => $car->price_pkr,
            'remarks' => $car->remarks,
        ];
    }

    $parts = [];
    foreach ($purchase->parts as $part) {
        $parts[] = [
            'purchase_id' => $purchase->id,
            'description' => $part->description,
            'weight_ltr' => $part->weight_ltr,
            'grade' => $part->grade,
            'qty' => $part->qty,
            'price' => $part->price,
            'price_pkr' => $part->price_pkr,
        ];
    }

    $postData = [
        'date' => $purchase->date,
        'cno' => $purchase->c_no,
        'bl_no' => $purchase->bl_no,
        'bl_amount' => $purchase->bl_amount,
        'bl_amount_pkr' => $purchase->bl_amount_pkr,
        'ex_rate' => $purchase->conversion_rate,
        'cars' => $cars,
        'parts' => $parts,
        'key' => $purchase->key,
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://chaman.janbrothers.com/api/purchase/store',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Content-Type: application/json',
        ],
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    if ($error) {
        return back()->with('error', 'Error: ' . $error);
    }

    $responseData = json_decode($response, true);
    $status = $responseData['status'] ?? 'success';
    $message = $responseData['message'] ?? 'Operation completed successfully';
    
    return back()->with($status, $message);
}
}
