@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    invoices details
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">invoices list</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    invoices details</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif






    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">information</a>
                                            </li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">paid status </a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">attachments</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>

                                                            <th scope="row">invoice number</th>
                                                            <td>{{ $invoice->invoice_number }}</td>
                                                            <th scope="row">invoice Date</th>
                                                            <td>{{ $invoice->invoice_Date }}</td>
                                                            <th scope="row">Due_date</th>
                                                            <td>{{ $invoice->Due_date }}</td>
                                                            <th scope="row">section</th>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">product</th>
                                                            <td>{{ $invoice->product }}</td>
                                                            <th scope="row">Amount_collection</th>
                                                            <td>{{ $invoice->Amount_collection }}</td>
                                                            <th scope="row">Amount_Commission</th>
                                                            <td>{{ $invoice->Amount_Commission }}</td>
                                                            <th scope="row">discount</th>
                                                            <td>{{ $invoice->Discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">taxe rate</th>
                                                            <td>{{ $invoice->Rate_VAT }}</td>
                                                            <th scope="row">taxe value</th>
                                                            <td>{{ $invoice->Value_VAT }}</td>
                                                            <th scope="row">total</th>
                                                            <td>{{ $invoice->Total }}</td>
                                                            <th scope="row">curent status</th>

                                                            @if ($invoice->Value_Status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoice->Status }}</span>
                                                                </td>
                                                            @elseif($invoice->Value_Status == 0)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoice->Status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">notes</th>
                                                            <td>{{ $invoice->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>invoice number</th>
                                                            <th>product name</th>
                                                            <th>section</th>
                                                            <th>paid status</th>
                                                            <th>paid date</th>
                                                            <th>notes</th>
                                                            <th>adding date</th>
                                                            <th>user</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($details as $detail)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $detail->invoice_number }}</td>
                                                                <td>{{ $detail->product }}</td>
                                                                <td>{{ $invoice->Section->section_name }}</td>
                                                                @if ($detail->Value_Status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @elseif($detail->Value_Status == 0)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $detail->Status }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $detail->Payment_Date }}</td>
                                                                <td>{{ $detail->note }}</td>
                                                                <td>{{ $detail->created_at }}</td>
                                                                <td>{{ $detail->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        @can('Add Attachment')
                                            <div class="tab-pane" id="tab6">

                                                <!--المرفقات-->
                                                <div class="card card-statistics">

                                                    <div class="card-body">
                                                        <p class="text-danger">* file format pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">add file</h5>
                                                        <form method="post" action="{{ url('add_file') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoice->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoice->id }}">
                                                                <label class="custom-file-label" for="customFile">select the
                                                                    file</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">confirm</button>
                                                        </form>
                                                    </div>

                                                    <br>

                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0 table table-hover"
                                                            style="text-align:center">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th scope="col">#</th>
                                                                    <th scope="col"> file name</th>
                                                                    <th scope="col">added by</th>
                                                                    <th scope="col">adding date</th>
                                                                    <th scope="col">option</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($attachments as $attachment)
                                                                    <?php $i++; ?>
                                                                    <tr>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $attachment->file_name }}</td>
                                                                        <td>{{ $attachment->Created_by }}</td>
                                                                        <td>{{ $attachment->created_at }}</td>
                                                                        <td colspan="2">

                                                                            <a class="btn btn-outline-success btn-sm"
                                                                                href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                role="button"><i
                                                                                    class="fas fa-eye"></i>&nbsp;
                                                                                show</a>

                                                                            <a class="btn btn-outline-info btn-sm"
                                                                                href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                                role="button"><i
                                                                                    class="fas fa-download"></i>&nbsp;
                                                                                download</a>
                                                                            @can('Delete Attachment')
                                                                                <button class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-file_name="{{ $attachment->file_name }}"
                                                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                    data-id_file="{{ $attachment->id }}"
                                                                                    data-target="#delete_file">delete</button>
                                                                            @endcan

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->

    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete" method="delete">
                    {{-- @method('POST') --}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> are you sure??</h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->

    <script src="{{ URL::asset('assets/pl
            ugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar
                 js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

@endsection
