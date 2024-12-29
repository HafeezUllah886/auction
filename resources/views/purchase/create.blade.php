@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Purchase </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" id="year" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="maker">Maker</label>
                                    <input type="text" name="maker" id="maker" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" id="model" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="chessis">Chassis No.</label>
                                    <input type="text" name="chassis" id="chessis" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="engine">Engine No.</label>
                                    <input type="text" name="engine" id="engine" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="cno">C No.</label>
                                    <input type="text" name="cno" value="{{ $lastpurchase->cno ?? "" }}" id="cno" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" name="date" id="date" value="{{$lastpurchase->date ? date("Y-m-d", strtotime($lastpurchase->date)) : date("Y-m-d")}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="auction">Auction</label>
                                    <input type="text" name="auction" value="{{ $lastpurchase->auction ?? "" }}" id="auction" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="price" id="price" oninput="updateChanges()" value="0" class="form-control">
                                        <input type="number" name="ptax" id="ptax" readonly value="0" class="form-control input-group-text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Auction Fee</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="afee" id="afee" oninput="updateChanges()" value="0" class="form-control">
                                        <input type="number" name="atax" id="atax" readonly value="0" class="form-control input-group-text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="rikuso">Rikuso</label>
                                    <input type="number" name="rikuso" id="rikuso" oninput="updateChanges()" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="recycle">Recycle</label>
                                    <input type="number" name="recycle"oninput="updateChanges()" value="0" min="0" id="recycle" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="total">Total</label>
                                    <input type="number" name="total" readonly id="total" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="adate">Arrival Date</label>
                                    <input type="date" name="adate" id="adate" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="sdate">Syorui Date</label>
                                    <input type="date" name="sdate" id="sdate" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group mt-2">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Purchase</button>
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
            var rikuso = parseFloat($('#rikuso').val());
            var recycle = parseFloat($('#recycle').val());

            var pTaxValue = price * 10 / 100;
            var aTaxValue = afee * 10 / 100;

            var amount = (price + pTaxValue + afee + aTaxValue + rikuso + recycle);

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
