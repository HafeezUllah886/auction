@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Edit Purchase </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('purchase.update', $purchase->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" id="year" value="{{ $purchase->year }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="maker">Maker</label>
                                    <input type="text" name="maker" id="maker" value="{{ $purchase->maker }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" id="model" value="{{ $purchase->model }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="chessis">Chassis No.</label>
                                    <input type="text" name="chassis" id="chessis" value="{{ $purchase->chassis }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="engine">Engine No.</label>
                                    <input type="text" name="engine" id="engine" value="{{ $purchase->engine }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="yard">Yard</label>
                                    <select name="yard" id="yard" class="form-control">
                                        <option value="">Select Yard</option>
                                        @foreach ($yards as $yard)
                                            <option value="{{ $yard->name }}" @selected($purchase->yard == $yard->name)>{{ $yard->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d', strtotime($purchase->date)) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="auction">Auction</label>
                                    <select name="auction" id="auction" class="form-control">
                                        <option value="">Select Auction</option>
                                        @foreach ($auctions as $auction)
                                            <option value="{{ $auction->name }}" @selected($purchase->auction == $auction->name)>{{ $auction->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="price" id="price" oninput="updateChanges()" value="{{ $purchase->price }}" class="form-control">
                                        <input type="number" name="ptax" id="ptax" readonly value="{{ $purchase->ptax }}" class="form-control input-group-text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Auction Fee</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="afee" id="afee" oninput="updateChanges()" value="{{ $purchase->afee }}" class="form-control">
                                        <input type="number" name="atax" id="atax" readonly value="{{ $purchase->atax }}" class="form-control input-group-text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="transport_charges">Transport Charges</label>
                                    <input type="number" name="transport_charges" id="transport_charges" oninput="updateChanges()" value="{{ $purchase->transport_charges }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="recycle">Recycle</label>
                                    <input type="number" name="recycle"oninput="updateChanges()" value="{{ $purchase->recycle }}" min="0" id="recycle" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="total">Total</label>
                                    <input type="number" name="total" value="{{ $purchase->total }}" readonly id="total" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="adate">Arrival Date</label>
                                    <input type="date" name="adate" id="adate" value="{{ isset($purchase->adate) ? date('Y-m-d' , strtotime($purchase->adate)) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="ddate">Document Received Date</label>
                                    <input type="date" name="ddate" id="ddate" value="{{ isset($purchase->ddate) ? date('Y-m-d' , strtotime($purchase->ddate)) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group mt-2">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5">{{ $purchase->notes }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Update Purchase</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        function updateChanges() {
            var price = parseFloat($('#price').val());
            var ptax = parseFloat($('#ptax').val());
            var afee = parseFloat($('#afee').val());
            var atax = parseFloat($('#atax').val());
            var transport_charges = parseFloat($('#transport_charges').val());
            var recycle = parseFloat($('#recycle').val());

            var pTaxValue = price * 10 / 100;
            var aTaxValue = afee * 10 / 100;

            var amount = (price + pTaxValue + afee + aTaxValue + transport_charges + recycle);

            $("#ptax").val(pTaxValue.toFixed(2));
            $("#atax").val(aTaxValue.toFixed(2));
            $("#total").val(amount.toFixed(2));

        }

        $(document).ready(function () {
    $('input, select, textarea').on('keypress', function (e) {
        // Check if the Enter key is pressed
        if (e.which === 13) {
            e.preventDefault(); // Prevent the default Enter key behavior

            // Find all focusable elements in the form, excluding readonly fields
            const focusable = $(this)
                .closest('form')
                .find('input:not([readonly]), select:not([readonly]), textarea:not([readonly]), button')
                .filter(':visible');

            // Determine the current element's index
            const index = focusable.index(this);

            // Move to the next focusable element
            if (index > -1 && index < focusable.length - 1) {
                focusable.eq(index + 1).focus();
            }
        }
    });
});


    </script>
@endsection
