@extends('mrp')
@section('title', $page_title)
@section('content')
    <div class="row ">
        <div class="col-xl-12">
            <div class="white_card mb_30 shadow pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>{{ $page_title }}</h4>

                            <div class="box_right d-flex lms_block">
                                <a href="{{ route('mrp.inventory-product-index') }}">
                                    <div class="btn btn-warning ml-10">
                                        <i class="ti-back-left"></i>
                                        Back
                                    </div>
                                </a>
                                <a href="{{ route('mrp.inventory_product-create') }}">
                                    <div class="btn btn-primary ml-10">
                                        <i class="ti-plus"></i>
                                        Add New
                                    </div>
                                </a>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert  {{ Session::get('alert-class', 'alert-info') }} d-flex align-items-center justify-content-between"
                                role="alert">
                                <div class="alert-text">
                                    <p>{{ Session::get('message') }}</p>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ti-close  f_s_14"></i>
                                </button>
                            </div>

                        @endif
                        <div class="QA_table mb_30">
                            <!-- table-responsive -->
                            <table class="table lms_table_active3 ">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Part Name</th>
                                        <th scope="col">Part Number</th>
                                        <th scope="col">Initial Stock</th>
                                        <th scope="col">Total Stock</th>
                                        <th scope="col">Target Qty (day)</th>
                                        <th scope="col">Target Qty</th>
                                        <th scope="col">Target (day)</th>
                                        <th scope="col">Stock Available For (day)</th>
                                        <!-- <th scope="col">Dimmension Long</th>
                                        <th scope="col">Dimmension Width</th>
                                        <th scope="col">Dimmension Height</th>
                                        <th scope="col">Dimmension Weight</th> -->
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inven_products as $inventory_product)
                                        
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                    <td>{{date('Y-m-d', strtotime($inventory_product->created_at)) ?? "N/A"}}</td>
                                            <td>{{ $inventory_product->product->part_name ?? 'N/A' }}</td>
                                            <td>{{ $inventory_product->product->part_number ?? 'N/A' }}</td>
                                            <td>{{ $inventory_product->initial_stock ?? 'N/A' }}</td>
                                            <td>{{ $inventory_product->stock ?? 'N/A' }}</td>
                                            <td>{{$inventory_product->total_target_day ?? "N/A"}}</td>
                                            <td>{{$inventory_product->qty_target ?? "N/A"}}</td>
                                            <td>{{$inventory_product->target_day ?? "N/A"}}</td>
                                            <td>{{ $inventory_product->totalStock() }}</td>
                                            <!-- <td>{{$inventory_product->product->dim_long ?? "N/A"}}</td>
                                            <td>{{$inventory_product->product->dim_width ?? "N/A"}}</td>
                                            <td>{{$inventory_product->product->dim_height ?? "N/A"}}</td>
                                            <td>{{$inventory_product->product->dim_weight ?? "N/A"}}</td> -->
                                            <td>{{ $inventory_product->description }}</td>
                                            <td>
                                                <div class="action_btns d-flex">
                                                    <a href="{{route('mrp.inventory_product-edit',$inventory_product->id)}}" data-toggle="tooltip" title="Edit" class="action_btn mr_10" > <i class="far fa-edit"></i> </a>
                                                    <a href=""
                                                        onclick="deleteData(event,{{ $inventory_product->id }},'')"
                                                        data-toggle="tooltip" title="Delete" class="action_btn mr_10"> <i
                                                            class="fas fa-trash"></i> </a>
                                                    {{-- <a href="{{route('mrp.inventory_product-add-stock',$inventory_product->id)}}" data-toggle="tooltip" title="Add Stock" class="action_btn "> <i class="fas fa-plus"></i> </a> --}}

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/buttons.dataTables.min.css" />
@endpush
@push('js')

    <script src="{{ asset('assets') }}/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/datatable/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/datatable/js/dataTables.buttons.min.js"></script>
    <script>
        if ($('.lms_table_active3').length) {
            $('.lms_table_active3').DataTable({
                bLengthChange: false,
                "bDestroy": false,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: 'Quick Search',
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
                searching: true,
                info: true,
                paging: true
            });
        }

        var urlDelete = `{{ route('mrp.inventory_product-delete') }}`

        function deleteData(event, id, textData) {
            event.preventDefault();
            $.confirm({
                title: 'Are you sure for delete data ?',
                content: textData,
                buttons: {
                    confirm: {
                        btnClass: 'btn-red',
                        keys: ['enter'],
                        action: function() {
                            axios.delete(urlDelete, {
                                    params: {
                                        id: id,
                                        text: textData
                                    }
                                })
                                .then(function(response) {
                                    // handle success
                                    location.reload();
                                })
                                .catch(function(error) {
                                    // handle error
                                    console.log(error);
                                })
                                .then(function() {
                                    // always executed
                                });

                        }
                    },
                    cancel: {
                        btnClass: 'btn-dark',
                        keys: ['esc'],

                    },

                }
            });
        }
    </script>
@endpush
