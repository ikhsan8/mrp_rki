@extends('mrp')

@section('title', $page_title)

@section('content')

{{-- <div class="col-sm-6">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Import data from excel</h4>  
        </div>

        <form action="{{ route('import.bom') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="card-body">
                <div class="form-group @error('import_file') error @enderror">
                    <label class="form-label">File Excel </label>

                    <input class="form-control form-control-sm" type="file" id="formFile" name="import_file">

                    @error('import_file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="box-footer">        
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="ti-upload"></i> Upload
                </button>
            </div>
        </form> 
    </div>
</div> --}}

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
                            @if (auth()->user()->can('bom-create'))
                            <a href="{{route('mrp.bom-create')}}" >
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
                        <table class="table bom ">
                            <thead>
                                <tr>
                                    <th scope="col" >No</th>
                                    <th scope="col">Bom Code</th>
                                    <th scope="col">Bom Name</th>
                                    <!-- <th scope="col">Part Name</th>
                                    <th scope="col">Part Number</th> -->
                                    <th scope="col">Material</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boms as $bom)
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
                                        <div class="action_btns d-flex">
                                        @if (auth()->user()->can('bom-edit'))
                                            <a href="{{route('mrp.bom-edit',$bom->id)}}" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                            @endif
                                            @if (auth()->user()->can('bom-delete'))
                                            <a href="" onclick="deleteData(event,{{$bom->id}},'{{$bom->bom_name}}')"  class="action_btn"> <i class="fas fa-trash"></i> </a>
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
    
    if ($('.bom').length) {
        $('.bom').DataTable({
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
