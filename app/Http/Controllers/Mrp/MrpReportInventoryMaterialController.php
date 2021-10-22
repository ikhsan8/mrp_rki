<?php

namespace App\Http\Controllers\Mrp;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel;
use App\Models\Mrp\MrpInventoryMaterialList;
use App\Models\Mrp\MrpInventoryMaterialIncoming;
use App\Models\Mrp\MrpInventoryMaterialOut;
use App\Models\Mrp\MrpMaterialSortir;
use App\Models\Mrp\MrpMaterialSortirOK;
use App\Models\Mrp\MrpMaterialSortirNG;
use App\Models\Mrp\MrpEmployee;
use App\Models\Mrp\MrpShift;
use App\Models\Mrp\MrpMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;



class MrpReportInventoryMaterialController extends Controller
{
    function __construct()  
    {
        $this->middleware('permission:report_inventory_material-list', ['only' => ['index']]);
        $this->middleware('permission:report_inventory_material-export', ['only' => ['export_excel']]);
    }

    // public function index(Request $request)
    // {

    //     $data['page_title'] = 'Report Inventory Material';
    //     $data_start = date('Y-m-d', strtotime($request->start_date));
    //     $data_end = date('Y-m-d', strtotime($request->end_date));
    //     $data['allinvenmaterial'] = [];

    //    if ($data_start && $data_end) {
    //     // material incoming
    //     $material_incoming = MrpInventoryMaterialIncoming::whereBetween('created_at', [$data_start, $data_end])->get();
    //     foreach ($material_incoming as $mi) {
    //         $dmi = [];
    //         $dmi['material_name'] = optional($mi)->inventoryMaterialList->material->material_name;
    //         $dmi['part_number'] = optional($mi)->inventoryMaterialList->material->part_number;
    //         $dmi['material_incoming'] = optional($mi)->material_incoming;  
    //         $dmi['pic'] = optional($mi)->employee->employee_name;
    //         $dmi['date'] = date('Y-m-d', strtotime(optional($mi)->created_at));
    //         // $dmi['from'] = 'Inventory Material Incoming';
            
    //         array_push($data['allinvenmaterial'], $dmi);
    //     }

    //     // material out
    //     $material_outgoing = MrpInventoryMaterialOut::whereBetween('created_at', [$data_start, $data_end])->get();
    //     foreach ($material_outgoing as $mo) {
    //         $dmo = [];
    //         $dmo['material_name'] = optional($mo)->inventoryMaterialList->material->material_name;
    //         $dmo['part_number'] = optional($mo)->inventoryMaterialList->material->part_number;
    //         $dmo['material_out'] = optional($mo)->material_outgoing;
    //         $dmo['pic'] = optional($mo)->employee->employee_name ?? "";
    //         $dmo['date'] = date('Y-m-d', strtotime(optional($mo)->created_at));
    //         // $dmo['from'] = 'Stock Out Prodcution';

    //         array_push($data['allinvenmaterial'], $dmo);

    //     }

    //     // material sortir
    //     $material_sortir = MrpMaterialSortir::whereBetween('created_at', [$data_start, $data_end])->get();
    //     foreach ($material_sortir as $ms) {
    //         $dms = [];
    //         $dms['material_name'] = optional($ms)->inventoryMaterialList->material->material_name;
    //         $dms['part_number'] = optional($ms)->inventoryMaterialList->material->part_number;
    //         $dms['material_incoming'] = '';
    //         $dms['qty_sortir'] = optional($ms)->qty_sortir;
    //         $dms['pic'] = optional($ms)->employee->employee_name;
    //         $dms['date'] = date('Y-m-d', strtotime(optional($ms)->created_at));
    //         // $dms['from'] = 'Material Sortir';

    //         array_push($data['allinvenmaterial'], $dms);

    //     }

    //     // material sortir ok
    //     $material_sortir_ok = MrpMaterialSortirOK::whereBetween('created_at', [$data_start, $data_end])->get();
    //     foreach ($material_sortir_ok as $msok) {
    //         $dmsok = [];
    //         $dmsok['material_name'] = optional($msok)->inventoryMaterialList->material->material_name;
    //         $dmsok['part_number'] = optional($msok)->inventoryMaterialList->material->part_number;
    //         $dmsok['material_incoming'] = '';
    //         $dmsok['qty_ok'] = optional($msok)->qty_ok;
    //         $dmsok['pic'] = optional($msok)->employee->employee_name;
    //         $dmsok['date'] = date('Y-m-d', strtotime(optional($msok)->created_at));

    //         // $dmsok['from'] = 'Material Sortir OK';


    //         array_push($data['allinvenmaterial'], $dmsok);
    //     }
        
    //     // material sortir ng
    //     $material_sortir_ng = MrpMaterialSortirNG::whereBetween('created_at', [$data_start, $data_end])->get();
    //     foreach ($material_sortir_ng as $msng) {
    //         $dmsng = [];
    //         $dmsng['material_name'] = optional($msng)->inventoryMaterialList->material->material_name;
    //         $dmsng['part_number'] = optional($msng)->inventoryMaterialList->material->part_number;
    //         $dmsng['qty_ng'] = optional($msng)->qty_ng;
    //         $dmsng['material_incoming'] = '';
    //         $dmsng['date'] = date('Y-m-d', strtotime(optional($msng)->created_at));
    //         $dmsng['pic'] = optional($msng)->employee->employee_name;
    //         $dmsng['from'] = 'Material Sortir NG';

    //         array_push($data['allinvenmaterial'], $dmsng);

    //     }

    //    } 


    //     return view('mrp.inventories.reports.report_inventory_material-list', $data);
    // }

    public function index(Request $request)
    {
        $data['page_title'] = 'Report Inventory Material';
        $data_start = date('Y-m-d', strtotime($request->start_date));
        $data_end = date('Y-m-d', strtotime($request->end_date));
        $data['allinvenmaterial'] = [];
        $material = MrpMaterial::all();
       
        //  dd($material[0]->inventoryMaterialLists[0]->inventoryMaterialOuts);
        
       if ($data_start && $data_end) {
           
    }
           $data['material_all'] = $material->map(function ($q){
               $data['date_in'] = $q->inventoryMaterialLists[0]->inventoryMaterialIncomings[0]->created_at ?? '';
               $data['date_out'] = $q->inventoryMaterialLists[0]->inventoryMaterialOuts[0]->created_at ?? '';
               $data['part_name'] = $q->inventoryMaterialLists[0]->material->material_name ?? '';
               $data['part_number'] = $q->inventoryMaterialLists[0]->material->part_number ?? '';
               $data['incoming'] = $q->inventoryMaterialLists[0]->inventoryMaterialIncomings->sum('material_incoming') ?? '';
               $data['outgoing'] = $q->inventoryMaterialLists[0]->inventoryMaterialOuts->sum('material_outgoing');
               $data['sortir'] = $q->inventoryMaterialLists[0]->materialSortir->sum('qty_sortir') ?? '';
               $data['sortir_ok'] = $q->inventoryMaterialLists[0]->materialSortirOk->sum('qty_ok') ?? '';
               $data['sortir_ng'] = $q->inventoryMaterialLists[0]->materialSortirNg->sum('qty_ng') ?? '';
               $data['stock'] = $q->inventoryMaterialLists->sum('stock') ?? '';
               
               
               
               return (object)$data;
            });
            // dd($material_all);

        return view('mrp.inventories.reports.report_inventory_material-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function export_excel()
	{
		return Excel::download(new ReportProduction, 'Report Production.xlsx');
	}

    public function create()
    {
        
    }
        
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
    }
}