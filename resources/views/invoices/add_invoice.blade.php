@extends('layouts.master')

@section('css')
    <!-- Internal Select2 CSS -->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Internal Fileupload CSS -->
    <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!-- Internal Fancy uploader CSS -->
    <link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!-- Internal Sumoselect CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!-- Internal TelephoneInput CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('title', 'Add Invoice')

@section('page-header')
    <!-- Breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Add Invoice</span>
            </div>
        </div>
    </div>
    <!-- Breadcrumb -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="store" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Invoice Number</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="Please enter the invoice number" required>
                            </div>

                            <div class="col">
                                <label>Invoice Date</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder=""
                                    type="text" value="" required>
                            </div>

                            <div class="col">
                                <label>Due Date</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder=""
                                    type="text" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Section</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <option value="" selected disabled>Select Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Product</label>
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Collection Amount</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Commission Amount</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="Please enter the commission amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="Please enter the discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">VAT Rate</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <option value="" selected disabled>Select VAT rate</option>
                                    <option value="5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">VAT Value</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total Amount (Including VAT)</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Notes</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* Attachment format: pdf, jpeg, jpg, png</p>
                        <h5 class="card-title">Attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify"
                                accept=".pdf, .jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Row -->

@endsection

@section('js')
    <!-- Internal Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Fileuploads JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!-- Internal Fancy uploader JS -->
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!-- Internal Form-elements JS -->
    <script src="{{ asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <!-- Internal Sumoselect JS -->
    <script src="{{ asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal Datepicker JS -->
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal jquery.maskedinput JS -->
    <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!-- Internal spectrum-colorpicker JS -->
    <script src="{{ asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Form-elements JS -->
    <script src="{{ asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>


    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('Please enter the commission amount');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }
    </script>

@endsection
