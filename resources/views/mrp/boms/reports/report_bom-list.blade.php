@extends('mrp')

@section('title', $page_title)

@section('content')

<style>
    .document {
        width: 100%;
        height: 18rem;
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

{{-- <div class="row">
    <div class="col-lg-6">
        <div class="white_card mb_30 shadow pt-4">
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Date Picker Bom Export</h4>
                    </div>
                    <div>
                        <form action="{{ route('mrp.report.report_bom-list') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input autocomplete="off"
                                            class="datepicker-here form-control digits @error('start_date') is-invalid @enderror"
                                            type="text" data-language="en" data-min-view="months" data-view="months"
                                            data-date-format="MM yyyy" name="start_date">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-group-lg">
                                            <i class="fas fa-cog fa-lg"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- @if (isset($status)) --}}
<div class="col-xl-12">
    <div class="white_card mb_30 shadow pt-1">
        <div class="white_card_body" style="padding: 5px 10px 15px 15px !important;">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h4>{{ $page_title }}</h4>

                    {{-- <div class="box_right d-flex lms_block">
                        <a href="{{ route('mrp.report.report_bom-export', $start_date) }}">
                            <div class="btn btn-success ml-10 btn-sm">
                                <i class="fas fa-file-excel"></i>
                                Excel
                            </div>
                        </a>
                        {{-- <a href="">
                            <div class="btn btn-danger ml-10 btn-sm">
                                <i class="fas fa-file-pdf"></i>
                                PDF
                            </div>
                        </a> --}}
                        
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
                <div class=" mb_30 ">
                
                    <div class="table-responsive" style="padding-bottom:10px;" id="style-1">
                        <table class="report table-bordered"
                            style="font-size: 11px; table-layout: auto !important;">
                            <thead>
                                <tr>
                                    <th scope="col" >No</th>
                                    <th scope="col">Bom Code</th>
                                    <th scope="col">Bom Name</th>
                                    <!-- <th scope="col">Part Name</th>
                                    <th scope="col">Part Number</th> -->
                                    <th scope="col">Material</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" >Action</th>\
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @foreach ($boms as $bom) -->
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$bom->bom_code}}</td>
                                    <td>{{$bom->bom_name}}</td>
                                    <!-- <td>{{$bom->part_name}}</td>
                                    <td>{{$bom->part_number}}</td> -->
                                    @if (auth()->user()->can('bom-delete'))
                                    <td>
                                        <button onclick="detailMaterial({{$bom->id}})" class="btn btn-info btn-sm"><i class="ti-eye"></i> View Material </button>
                                    </td>
                                    @endif
                                    <td>{{$bom->description}}</td>
                                    <td>
                                      
                                    </td>
                                </tr>
                                <!-- @endforeach -->


                            </tbody>
                           
                        </table>

                        
                    </div>
                    <br>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
{{-- @endif --}}
@endsection


                    {{-- <div class="mb_30">
                        <div class="row">
                                <div class="table-responsive" style="padding-bottom:10px;" id="style-1">
                                    <table class="report table-bordered" style="font-size: 11px;">
                                        
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                            
   

 

@push('css')
<!-- datatable CSS -->
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="{{ asset('assets') }}/vendors/datepicker/date-picker.css">
@endpush
@push('js')

<script src="{{asset('assets')}}/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.js"></script>
<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.en.js"></script>
<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.custom.js"></script>
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
  
    var urlDelete = `{{route('mrp.bom-delete')}}`
    function deleteData(event,id,textData){
        event.preventDefault();
        $.confirm({
            title: 'Are you sure for delete data ?',
            content: textData,
            buttons: {
                confirm:   {
                    btnClass: 'btn-red',
                    keys: ['enter'],
                    action: function(){
                        axios.delete(urlDelete,{params:{id:id,text:textData}})
                            .then(function (response) {
                                // handle success
                                location.reload();
                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                            })
                            .then(function () {
                                // always executed
                            });

                    }
                },
                cancel:  {
                    btnClass: 'btn-dark',
                    keys: ['esc'],
                    
                },
                
            }
        });
    }
</script>
@endpush