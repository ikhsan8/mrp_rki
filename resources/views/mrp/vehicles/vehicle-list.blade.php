@extends('mrp')

@section('title', $page_title)

@section('content')
<div class="row ">
    <div class="col-xl-12">
        <div class="white_card mb_30 shadow pt-4">
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>{{$page_title}}</h4>

                        <div class="box_right d-flex lms_block">
                            <a href="{{route('mrp.master-data-index')}}">
                                <div class="btn btn-warning ml-10">
                                    <i class="ti-back-left"></i>
                                    Back
                                </div>
                            </a>
                            @if (auth()->user()->can('vehicle-create'))
                            <a href="{{route('mrp.vehicle-create')}}" >
                            <div class="btn btn-primary ml-10">
                                <i class="ti-plus"></i>
                                Add New
                            </div>
                            </a>
                            @endif
                        </div>
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
                        <table class="table vehicle ">
                            <thead>
                                <tr>
                                    <th scope="col" >No</th>
                                    <th scope="col">Car Code</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Driver</th>
                                    <th scope="col">Descripiton</th>
                                    <th scope="col" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$car->car_code}}</td>
                                    <td>{{$car->type}}</td>
                                    <td>{{$car->driver}}</td>
                                    <td>{{$car->description}}</td>
                                    <td>
                                        <div class="action_btns d-flex">
                                            @if (auth()->user()->can('vehicle-edit'))
                                            <a href="{{route('mrp.vehicle-edit',$car->id)}}" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                            @endif
                                            @if (auth()->user()->can('vehicle-delete'))
                                            <a href="" onclick="deleteData(event,{{$car->id}},'{{$car->car_code}}')"  class="action_btn"> <i class="fas fa-trash"></i> </a>
                                            @endif
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
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="{{asset('assets')}}/vendors/datatable/css/buttons.dataTables.min.css" />
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
<script>
    
    if ($('.vehicle').length) {
        $('.vehicle').DataTable({
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
  
    var urlDelete = `{{route('mrp.vehicle-delete')}}`
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
