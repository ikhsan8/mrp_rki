@extends('mrp')

@section('title', $page_title)

@section('content')
    <style>
        .document {
            width: 100%;
            height: 18rem;
            overflow-x: scroll;
            padding-right: .5rem;
            margin-bottom: 1rem;
        }

        /* CSS REPORT  */
        .report {
            table-layout: fixed;
        }

        .report td {
            padding: 1px 5px;
        }

        .date-head {
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            width: 50px;
            /* padding: 2px 7px !important; */
        }

        .pan {
            font-size: 7px;
        }



        .actual {
            color: #697AAB;
            font-weight: bold
        }

        .ng {
            color: #A94147;
            font-weight: bold
        }



        table.table-bordered>tbody>tr>td {
            border: 1px solid #84757F !important;
        }


        /* SCROLL STYLE */
        /*
                                     *  STYLE 1
                                     */

        #style-1::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;

        }

        #style-1::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

    </style>

<div class="row ">
    <div class="col-xl-12">
        <div class="white_card mb_30 shadow pt-4">
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>{{$page_title}}</h4>
                        
                    </div>
                
                    <form action="" class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Select Month</label> 
                                <input placeholder="Select Month" autocomplete="off"  class="form-control datepicker-here  digits @error('start_date') is-invalid @enderror"
                                type="text" data-language="en" data-min-view="months" data-view="months"
                                data-date-format="MM yyyy" name="start_date">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="">_</label>
                                <button class="btn btn-secondary form-control"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg></i></button>
                            </div>
                        </div>
                    </form>

					</div>

                    @if(Session::has('message'))
                    <div class="alert  {{ Session::get('alert-class', 'alert-info') }} d-flex align-items-center justify-content-between" role="alert">
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
                                    <td scope="col">No</td>
                                    <td scope="col">Date</td>
                                    <td scope="col">BOM</td>
                                    <td scope="col">Description</td>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($boms as $bom)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{date('Y-m-d', strtotime($bom->created_at))}}</td>
                                    <td>{{$bom->bom_name}}</td>
                                    <td>{{$bom->description}}</td>
                                    
                                </tr>
                                
                                <table class="table display responsive nowrap datatable2 table-bordered" id=""> 
                                    <thead class="thead-dark">
                                        <th width="2%">No</th>
                                        <th>Material</th> 
                                        <th>Unit</th>
                                        <th>Quantity</th>   
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($bom->materialUnits() as $materialUnit)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                                <td>{{$materialUnit['inventory_material' ?? '']}}</td>
                                                <td>{{$materialUnit['unit'] ?? ''}}</td>
                                                <td>{{$materialUnit['qty_material']}}</td>
                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endforeach

                                
                                


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="white_card mb_30 shadow pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="table-responsice">
                            <table class="table report_material">
                                <thead>
                                    <tr>
                                        <td scope="col">No</td>
                                        <td scope="col">Date</td>
                                        <td scope="col">BOM</td>
                                        <td scope="col">Material</td>
                                        <td scope="col">Description</td>
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($boms as $bom)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$bom->created_at}}</td>
                                    <td>{{$bom->bom_name}}</td>
                                    @if (auth()->user()->can('bom-delete'))
                                    <td>
                                        <button onclick="detailMaterial({{$bom->id}})" class="btn btn-info btn-sm"><i class="ti-eye"></i> View Material </button>
                                    </td>
                                    @endif
                                    <td>{{$bom->description}}</td>
                                    
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

 

@endsection

@push('css')
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datatable/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/datepicker/date-picker.css">

@endpush
@push('js')

<script src="{{asset('assets')}}/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/jszip.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/pdfmake.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/vfs_fonts.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/buttons.print.min.js"></script>

<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.js"></script>
    <script src="{{ asset('assets') }}/vendors/datepicker/datepicker.en.js"></script>
    <script src="{{ asset('assets') }}/vendors/datepicker/datepicker.custom.js"></script>


    <script>

    function detailMaterial(id) {
        $.confirm({
            title: 'Detail Material',
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'url:bom-show/detail/'+id,
            onContentReady: function () {
                var self = this;
                // this.setContentPrepend('<div>Prepended text</div>');
                // setTimeout(function () {
                //     self.setContentAppend('<div>Appended text after 2 seconds</div>');
                // }, 2000);
            },
            columnClass: 'medium',
        });
    }




        if ($('.report_material').length) {
        $('.report_material').DataTable({
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
            paging: true,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf']
        });
    }

        var urlDelete = `{{ route('mrp.product-delete') }}`

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

        $('#theButton').click(function() {
            $('#theDiv').css({
                position: 'fixed',
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                zIndex: 999999999
            });
        });
    </script>
@endpush
