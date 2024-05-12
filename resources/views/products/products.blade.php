@extends('layouts.master')
@section('title')
    Products
@endsection()
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Products</span>
            </div>

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
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">STRIPED ROWS</h4>
                        <div class="row">

                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">Example of Valex Striped Rows.. <a href="">Learn more</a>
                        </p>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#exampleModal">Add Section</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example2" data-page-length="50">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">product name</th>
                                        <th class="wd-15p border-bottom-0">section name</th>
                                        <th class="wd-20p border-bottom-0">option</th>
                                        <th class="wd-20p border-bottom-0">notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($products as $product)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->section->section_name }}</td>
                                            <td>
                                                <button class="btn btn-outline-success btn-sm"
                                                    data-name="{{ $product->product_name }}"
                                                    data-pro_id="{{ $product->id }}"
                                                    data-section_name="{{ $product->section->section_name }}"
                                                    data-description="{{ $product->description }}" data-toggle="modal"
                                                    data-target="#edit_Product">edit</button>

                                                <button class="btn btn-outline-danger btn-sm "
                                                    data-pro_id="{{ $product->id }}"
                                                    data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                                    data-target="#modaldemo9">delete</button>
                                            </td>
                                            <td>{{ $product->description }}</td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
            <!-- add -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="product/store" method="post">
                            @method('POST')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        required>
                                </div>

                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Section</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled>Celect Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- edit -->
            <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">edit product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action='product/update' method="post">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="title">product name</label>

                                    <input type="hidden" class="form-control" name="pro_id" id="pro_id"
                                        value="">

                                    <input type="text" class="form-control" name="product_name" id="product_name">
                                </div>

                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">section</label>
                                <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2"
                                    required>
                                    @foreach ($sections as $section)
                                        <option>{{ $section->section_name }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="des">notes :</label>
                                    <textarea name="description" cols="20" rows="5" id='description' class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">confirm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- delete -->
            <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">delete product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="product/destroy" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                <p>are you sure ??</p><br>
                                <input type="hidden" name="pro_id" id="pro_id" value="">
                                <input class="form-control" name="product_name" id="product_name" type="text"
                                    readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancle</button>
                                <button type="submit" class="btn btn-danger">confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- row closed -->
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
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection
