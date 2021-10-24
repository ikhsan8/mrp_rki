@extends('mrp')

@section('title', $page_title)

@section('content')
<style>
    .document {
        width: 100%;
        height: 30rem;
        overflow-y: scroll;
        padding-right: .5rem;
        margin-bottom: 1rem;
    }

    .table tr {
        cursor: auto;
        border: solid 1px #DEE2E6;
    }

    /* CSS REPORT  */
    .report {
        table-layout: fixed;
        text-align: center
    }

    .report td {
        /* padding: 3px ​7px; */
        padding: 5px 6px;
    }


    .pan {
        font-size: 10px;
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
        border: 0.5px solid #84757F !important;
        border-width: 0px;
    }
/*    
    .report tbody>td{
        border:1px dotted #000000;
        padding:5px;
    }
    .report tbody>td:first-child{
        border-left:0px solid #000000;
    } */
    .report thead>tr>th{
        border:0.5px solid #84757F;
    }
    
    .value-report{
            font-weight: 900;
        font-size: 10px;
        display: block;
    }

</style>
<div class="row ">
    <div class="col-xl-12">
        <div class="white_card mb_30 shadow pt-4">
            {{-- <form action="{{route('mrp.production.production-store')}}" method="post"> --}}
                <div class="white_card_body">
                    <div class="QA_section">
                        @csrf
                        <div class="row">
                        <div class="form-group">
                        <a href="{{ route('mrp.report_planning-list') }}">
                            <button type="button" class="btn btn-warning btn-sm">
                                <i class="ti-back-left"></i>
                                Back</button>
                            
                        </a>
                        <button type="button" onclick="getPDF()" class="btn btn-danger btn-sm">
                                <i class=""></i>
                                Download PDF</button>
                    </div>
                </div>
                         
                        
                        <h4 id="report_detail" style="color: chocolate">Report Details</h4>
                        <div></div>
                        <div class="row canvas_div_pdf">
                                <div class="table-responsive ">
                                    
                                {{-- <div class="row"> --}}
        {{-- <div class="col-lg-12"> --}}
            {{-- <div class="white_card mb_30 shadow pt-4"> --}}
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            {{-- <h4>Report Wip</h4> --}}
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table lms_table_active3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Planning Name</th>
                                            <th>Product</th>
                                            <th>Shift</th>
                                            <th>Qty Plan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($planning as  $plannings)
                                        
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $plannings->date }}</td>
                                                <td>{{ $plannings->planningProduction->plan_name  }}</td>
                                                <td>{{ $plannings->planningProduction->shift->shift_name }}</td>
                                                <td>{{ $plannings->qty_plan }}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                {{-- @foreach ($report_wip as $product => $machines)
                                <h3 style="background:#2B453F;color:white;">{{ $product }}</h3>
                                <table class="report table-bordered" style=" margin-bottom:25px;">
                                    <thead>
                                        <tr>
                                            <th>Machine</th>
                                            <th>Process</th>
                                            <th>Shift</th>
                                            <th>Item</th>
                                            <th>1</th>
                                            <th>2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($machines as $machine => $process)
                                            @foreach ($process as $proc => $shifts)
                                                @foreach ($shifts as $shift => $dataWip)
                                                    <tr>
                                                        <td>{{ $proc  }}</td>
                                                        <td>{{ $machine }}</td>
                                                        <td>{{ $shift }}</td>
                                                        <td style="padding:0px;">
                                                            <table class="" style="width:100%">
                                                                <tr>
                                                                    <td>Actual</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Plan</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Good</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Reject</td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                        @php
                                                            $dateBefore = 0;
                                                        @endphp
                                                        @foreach ($dataWip as $dw)

                                                            @php
                                                                $dateBefore = $dw['dateIndex']
                                                            @endphp
                                                            <td style="padding:0px;">
                                                                <table class="" style="width:100%">

                                                                    <tr>
                                                                        <td>{{ $dw['qty_good'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $dw['qty_plan'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $dw['qty_good'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $dw['qty_reject'] }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            
                                            @endforeach
                                           
                                        @endforeach
                                       
                                        <tr></tr>
                                    </tbody>

                                </table>
                                @endforeach --}}
                                

                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}

                                    


                                        
                                        
                                        
                                             
                                         
                                </div>
                            </div>
                        </div>
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
<!-- datepicker  -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendors/datepicker/date-picker.css">

<style>
    .table tr {
        cursor: pointer;
    }

    .table-hover-custom>tbody>tr:hover {
        background-color: #d1cfcfda !important;
    }

</style>
@endpush
@push('js')
<script src="{{asset('assets')}}/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatable/js/dataTables.buttons.min.js"></script>
<!-- date picker  -->
<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.js"></script>
<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.en.js"></script>
<script src="{{ asset('assets') }}/vendors/datepicker/datepicker.custom.js"></script>

{{-- DOM TO PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>

    function getPDF(){

		var HTML_Width = $(".canvas_div_pdf").width();
		var HTML_Height = $(".canvas_div_pdf").height();
		var top_left_margin = 15;
		var PDF_Width = HTML_Width+(top_left_margin*2);
		var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
		var canvas_image_width = HTML_Width;
		var canvas_image_height = HTML_Height;
		
		var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
		

		html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
			canvas.getContext('2d');
			
			console.log(canvas.height+"  "+canvas.width);
			
			
			var imgData = canvas.toDataURL("image/jpeg", 1.0);
			var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
		    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
			
			
			for (var i = 1; i <= totalPDFPages; i++) { 
				pdf.addPage(PDF_Width, PDF_Height);
				pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
			}
			
		    pdf.save("HTML-Document.pdf");
        });
	};
    
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
         // initial
        $('.no-gutters').hide();
        // $('.main_content_iner').css('padding', '0px');
        $('.main_content').addClass('full_main_content');
        $('.dark_sidebar').addClass('mini_sidebar');
    });
    $("#e1").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#e1 > option").prop("selected", "selected");
            $("#e1").trigger("change");
        } else {
            $("#e1 > option").removeAttr("selected");
            $("#e1").val("");
            $("#e1").trigger("change");
        }
    });

    $("#button").click(function () {
        alert($("#e1").val());
    });

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    $(function () {
    });

    $(document).ready(function () {
        $(".btn-add").click(function () {
            let markup = $(".invisible").html();
            $(".increment").append(markup);
        });
        $("body").on("click", ".btn-remove", function () {
            $(this).parents(".test").remove();
        })
    })

</script>

<script>
    // $('.row-permission').click(function () {
    //     let data = $(this).find('td input:checkbox');
    //     console.log(data.prop('checked', !data.is(':checked')));
    // });
    // $('#checkAll').click(function (e) {
    //     // var table= $(e.target).closest('.table');
    //     let find = $('.lms_table_active3').find('tr td input:checkbox').prop('checked', true);
    //     console.log(find);
    // });
    // $('#uncheckAll').click(function (e) {
    //     // var table= $(e.target).closest('.table');
    //     let find = $('.lms_table_active3').find('tr td input:checkbox').prop('checked', false);
    //     console.log(find);
    // });

    // --- initial page
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });


    // --- detail process
    function rowProcess(ip, process) {
        let trProcess = `<tr> 
                    <td>${ip}</td>
                    <td>${process.process_name}</td>
                    <td>
                        <table class="table table-bordered">
                           `;
        process.process_machines.forEach(procesMachine => {
            trProcess += rowMachine(procesMachine, process)
        });
        trProcess += `
                        </table>
                    </td>
                </tr>`;

        return trProcess;
    }

    // function rowMachine(machine, process) {
    //     return `<tr>
    //                 <td>MACHINE 2</td>
    //                 <td>
    //                     <div class="form-group">
    //                         <select placeholder="CHOOSE PRODUCT" class="form-control js-example-basic-multiple" name="product[${process.id}_${machine.id}][]"
    //                             multiple="multiple" required>
    //                             <option disabled >CHOOSE PRODUCT</option>
    //                             @foreach ($products as $product)
    //                             <option  value="{{ $product->id }}"  {{ (old('product') == $product->id) ? 'selected' : '' }}>
                                    
    //                                 {{ $product->product_code }} | {{ $product->product_name }} | {{ $product->part_name }}</option>
    //                             @endforeach
    //                         </select>
                             
    //                     </div>
    //                 </td>
    //             </tr>`
    // }

    // --- planning
    

    $('.datatable-wip').DataTable({
         "pageLength": 3
    });

    
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


    function changeActual() {
        let reject = $('#qty_reject').val()
        let good = $('#qty_good').val()

        $('#qty_actual').val(Number(reject) + Number(good))
    }

</script>
@endpush
