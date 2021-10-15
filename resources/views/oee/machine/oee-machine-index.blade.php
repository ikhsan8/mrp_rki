@extends('oee')

@section('title', $page_title)

@section('content')
<div class="row ">
    <div class="col-lg-12">
        <div class="white_card mb_30 shadow pt-4">
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>{{$page_title}}</h4>
                        <div class="box_right d-flex lms_block">
                            @if (auth()->user()->can('machine-create'))
                            <a href="{{route('oee.machine.create')}}">
                                <div class="btn btn-primary ml-10">
                                    <i class="ti-plus"></i>
                                    Add New
                                </div>
                            </a>
                            @endif
                           
                        </div>
                    </div>
                    @if(Session::has('message'))
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
                                    <th scope="col">Display Code</th>
                                    <th scope="col">Display Ident</th>
                                    <!-- <th scope="col">Display Name</th> -->
                                    <!-- <th scope="col">index</th> -->
                                    <th scope="col">Status</th>
                                    <th scope="col">Target Defect</th>
                                    <th scope="col">Target Effeciency</th>
                                    <th scope="col">Cycle Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machines as $machine)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$machine->code}}</td>
                                    <td>{{$machine->ident}}</td>
                                    <!-- <td>{{$machine->name}}</td> -->
                                    <!-- <td>{{$machine->index}}</td> -->
                                    <td>{{$machine->statusIndex()}}</td>
                                    <td>{{$machine->target_defect_rate}}</td>
                                    <td>{{$machine->target_effeciency}}</td>
                                    <td>{{$machine->cycle_time}}</td>
                                    <td>
                                        <div class="action_btns d-flex">
                                            @if (auth()->user()->can('machine-edit'))
                                            <a href="{{route('oee.machine.edit',$machine->id)}}"
                                                class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                            @endif
                                            @if (auth()->user()->can('machine-delete'))
                                            <a href=""
                                                onclick="deleteData(event,{{$machine->id}},'{{$machine->ident}}')"
                                                class="action_btn"> <i class="fas fa-trash"></i> </a>
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

    var urlDelete = `{{route('oee.machine.delete')}}`

    function deleteData(event, id, textData) {
        event.preventDefault();
        $.confirm({
            title: 'Are you sure for delete data ?',
            content: textData,
            buttons: {
                confirm: {
                    btnClass: 'btn-red',
                    keys: ['enter'],
                    action: function () {
                        axios.delete(urlDelete, {
                                params: {
                                    id: id,
                                    text: textData
                                }
                            })
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
                cancel: {
                    btnClass: 'btn-dark',
                    keys: ['esc'],

                },

            }
        });
    }

</script>
@endpush
