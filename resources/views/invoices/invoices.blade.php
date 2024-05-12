@extends('layouts.master')
@section('title')
    Invoices List
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    .scrollable-dropdown {
    max-height: 200px; /* Adjust the max height as needed */
    overflow-y: auto;
    }
@endsection
@section('page-header')
    <div class="row">
        <!--div-->
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ all
                        invoices</span>
                </div>
            </div>
            {{-- <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                                                        <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
                                                    </div>
                                                    <div class="pr-1 mb-3 mb-xl-0">
                                                        <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
                                                    </div>
                                                    <div class="pr-1 mb-3 mb-xl-0">
                                                        <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
                                                    </div>
                                                    <div class="mb-3 mb-xl-0">
                                                    </div> --}}
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session('success1'))
        <div class="alert alert-danger">
            {{ session('success1') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @can('Add Invoice')
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; add invoice</a>
                </div>
            @endcan
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">Invoice Number</th>
                                            <th class="border-bottom-0">Invoice Date</th>
                                            <th class="border-bottom-0">Due Date</th>
                                            <th class="border-bottom-0">Product</th>
                                            <th class="border-bottom-0">Section</th>
                                            <th class="border-bottom-0">Discount</th>
                                            <th class="border-bottom-0">Tax Rate</th>
                                            <th class="border-bottom-0">Tax Value</th>
                                            <th class="border-bottom-0">Total</th>
                                            <th class="border-bottom-0">Status</th>
                                            <th class="border-bottom-0">Amount Collection</th>
                                            <th class="border-bottom-0">Amount Commission</th>
                                            <th class="border-bottom-0">Value Status</th>
                                            <th class="border-bottom-0">Notes</th>
                                            <th class="border-bottom-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($invoices as $invoice)
                                            @php
                                                $i++;
                                            @endphp

                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->invoice_Date }}</td>
                                                <td>{{ $invoice->Due_date }}</td>
                                                <td>{{ $invoice->product }}</td>
                                                <td><a
                                                        href="{{ url('invoicesdetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}</a>
                                                </td>
                                                <td>{{ $invoice->Discount }}</td>
                                                <td>{{ $invoice->Value_VAT }}</td>
                                                <td>{{ $invoice->Rate_VAT }}</td>
                                                <td>{{ $invoice->Total }}</td>
                                                <td>
                                                    @if ($invoice->Value_Status == 1)
                                                        <span class="text-success">{{ $invoice->Status }}</span>
                                                    @elseif($invoice->Value_Status == 0)
                                                        <span class="text-danger">{{ $invoice->Status }}</span>
                                                    @else
                                                        <span class="text-warning">{{ $invoice->Status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $invoice->Amount_collection }}</td>
                                                <td>{{ $invoice->Amount_Commission }}</td>
                                                <td>{{ $invoice->Value_Status }}</td>
                                                <td>{{ $invoice->note }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @can('Edit Invoice')
                                                                <a class="dropdown-item"
                                                                    href="{{ url('invoices/edit') }}/{{ $invoice->id }}">Edit
                                                                    Invoice</a>
                                                            @endcan
                                                            @can('Delete Invoice')
                                                                <a class="dropdown-item modal-effect" href="#"
                                                                    data-effect="effect-scale" data-id="{{ $invoice->id }}"
                                                                    data-invoice_number="{{ $invoice->invoice_number }}"
                                                                    data-toggle="modal" data-target="#modaldemo9">Delete
                                                                    Invoice</a>
                                                            @endcan
                                                            @can('Change Payment Status')
                                                                <a class="dropdown-item"
                                                                    href="invoices/Status_show/{{ $invoice->id }}">Change
                                                                    Payment
                                                                    Status</a>
                                                            @endcan
                                                            @can('Archive Invoice')
                                                                <a class="dropdown-item" href="#"
                                                                    data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                                    data-target="#Transfer_invoice"><i
                                                                        class=""></i>&nbsp;&nbsp;Archive
                                                                    Invoice</a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>


                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div> <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">delete invoice</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="invoices/destroy" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p> are you sure? </p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-danger">confirm</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive the invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="invoices/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                    </div>
                    <div class="modal-body">
                        are you sure??
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <input type="hidden" name="id_page" id="id_page" value="2">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-success">confirm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('invoice_number')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
            modal.find('.modal-body #description').val(description);
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection
