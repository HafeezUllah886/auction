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
                                    <input type="text" name="cno" id="cno" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="auction">Auction</label>
                                    <input type="text" name="auction" id="auction" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" oninput="updateChanges()" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="tax">Tax</label>
                                    <input type="number" name="tax" id="tax" oninput="updateChanges()" value="0" class="form-control">
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
                                    <label for="total">Total</label>
                                    <input type="number" name="total" readonly id="total" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="recycle">Recycle</label>
                                    <input type="number" name="recycle" id="recycle" class="form-control">
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
            var tax = parseFloat($('#tax').val());
            var rikuso = parseFloat($('#rikuso').val());

            var amount = (price + tax + rikuso);
            $("#total").val(amount.toFixed(2));

        }

        function updateTotal() {
            var total = 0;
            $("input[id^='amount_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                total += parseFloat(inputValue);
            });

            $("#totalAmount").html(total.toFixed(2));

            var totalFright = 0;
            $("input[id^='frightValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalFright += parseFloat(inputValue);
            });

            $("#totalFright").html(totalFright.toFixed(2));

            var totalLabor = 0;
            $("input[id^='laborValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalLabor += parseFloat(inputValue);
            });

            $("#totalLabor").html(totalLabor.toFixed(2));

            var totalClaim = 0;
            $("input[id^='claimValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalClaim += parseFloat(inputValue);
            });

            $("#totalClaim").html(totalClaim.toFixed(2));

            var totalDiscount = 0;
            $("input[id^='discountValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalDiscount += parseFloat(inputValue);
            });

            $("#totalDiscount").html(totalDiscount.toFixed(2));

            var totalPDiscount = 0;
            $("input[id^='discountPValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalPDiscount += parseFloat(inputValue);
            });

            $("#totalPDiscount").html(totalPDiscount.toFixed(2));

            var totalQty = 0;
            $("input[id^='qty_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalQty += parseFloat(inputValue);
            });

            $("#totalQty").html(totalQty.toFixed(2));

            var claim = $("#claim").val();
            var net = total - claim;

            $("#net").val(net.toFixed(2));
        }

        function deleteRow(id) {
            existingProducts = $.grep(existingProducts, function(value) {
                return value !== id;
            });
            $('#row_'+id).remove();
            updateTotal();
        }


    </script>
@endsection
