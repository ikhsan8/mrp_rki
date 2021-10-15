<?php

namespace App\Http\Controllers\Mrp;
use Illuminate\Support\Facades\Session;
use App\Models\Mrp\MrpInventoryMaterialIncoming;
use App\Models\Mrp\MrpInventoryMaterialList;
use App\Models\Mrp\MrpEmployee;
use App\Models\Mrp\MrpMaterial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MrpInventoryMaterialIncomingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:inventory_material_incoming-list', ['only' => ['index']]);
        $this->middleware('permission:inventory_material_incoming-create', ['only' => ['create']]);
        $this->middleware('permission:inventory_material_incoming-edit', ['only' => ['edit']]);
        $this->middleware('permission:inventory_material_incoming-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['page_title'] = 'Material Conveyor Logistic';
        $data['material_incomings'] = MrpInventoryMaterialIncoming::orderBy('id','desc')->get();
        return view('mrp.inventories.materials.material-incoming.material-incoming-list',$data);
    }

    public function conveyorLogistic()
    {
        $data['page_title'] = 'Material Conveyor Logistic';
        $data['material_incomings'] = MrpInventoryMaterialIncoming::orderBy('id','desc')->get();
        return view('mrp.dashboard.conveyor-logistic.conveyor_logistic-list',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Material Conveyor Logisctic Create';
        $data['materials'] = MrpMaterial::get();
        $data['employees'] = MrpEmployee::get();
        $data['inven_material_list'] = MrpInventoryMaterialList::get();
        return view('mrp.inventories.materials.material-incoming.material-incoming-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_id' => 'required',
            'material_incoming' => 'required',
            'lot_material' => 'nullable|max:8',
            'employee_id' => 'required',
            'current_stock' => 'required',
            // 'sortir' => 'nullable',
            'tanggal_masuk_convetor' => 'nullable',
            'description' => 'nullable'
        ], 
    [
        'material_id.required' => '*Part Name Wajib Diisi!',
        'material_incoming.required' => '*Quantity Wajib Diisi!',
        'employee_id.required' => 'PIC Wajib Diisi!',
        'current_stock.required' => '*Current Stock Wajib Diisi!',
    ]);
        
        try {
            MrpInventoryMaterialList::where('id',$request->material_id)->update([
                'stock' => $request->current_stock
            ]);
            MrpInventoryMaterialIncoming::create([
                'material_id' => $request->material_id,
                'material_incoming' => $request->material_incoming,
                'lot_material' => $request->lot_material,
                // 'sortir' => $request->sortir,
                'employee_id' => $request->employee_id,
                'current_stock' => $request->current_stock,
                'tanggal_masuk_convetor' => date('Y-m-d', strtotime($request->tanggal_masuk_convetor)),
                'description' => $request->description
            ]);
            Session::flash('message', 'Data Successfuly created !');
            Session::flash('alert-class', 'alert-success'); //alert-success alert-warning alert-danger
            return redirect()->route('mrp.material-incoming-list');
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('mrp.material-incoming-list');
        }

        
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
        $data['page_title'] = 'Material Conveyor Logistic Edit';
        $data['materials'] = MrpMaterial::get();
        $data['employees'] = MrpEmployee::get();
        $data['inven_material_list'] = MrpInventoryMaterialList::get();
        $data['material_incoming'] = MrpInventoryMaterialIncoming::find($id);
        return view('mrp.inventories.materials.material-incoming.material-incoming-edit', $data);
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
        $validated = $request->validate([
            'material_id' => 'required',
            'material_incoming' => 'required',
            'lot_material' => 'nullable|max:8',
            'employee_id' => 'required',
            'current_stock' => 'required',
            // 'sortir' => 'nullable',
            'tanggal_masuk_convetor' => 'nullable',
            'description' => 'nullable'
            
        ],
    [
        'material_id.required' => '*Part Name Wajib Diisi!',
        'material_incoming.required' => '*Quantity Wajib Diisi!',
        'employee_id.required' => 'PIC Wajib Diisi!',
        'current_stock.required' => '*Current Stock Wajib Diisi!',
    ]);

        try {
            MrpInventoryMaterialList::where('id',$request->material_id)->update([
                'stock' => $request->current_stock
            ]);
            MrpInventoryMaterialIncoming::where('id',$id)->update([
                'material_id' => $request->material_id,
                'material_incoming' => $request->material_incoming,
                'lot_material' => $request->lot_material,
                'employee_id' => $request->employee_id,
                'current_stock' => $request->current_stock,
                // 'status' => $request->status,
                // 'sortir' => $request->sortir,
                'tanggal_masuk_convetor' => date('Y-m-d', strtotime($request->tanggal_masuk_convetor)),
                'description' => $request->description

                
                ]);
            Session::flash('message', 'Data Successfuly updated !');
            Session::flash('alert-class', 'alert-success'); 
            return redirect()->route('mrp.material-incoming-list');
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('mrp.material-incoming-list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Session::flash('message', "Data $request->text Successfuly deleted !");
            Session::flash('alert-class', 'alert-success'); 
            MrpInventoryMaterialIncoming::destroy($request->id);
            return json_encode(['id' => $request->id]);
        } catch (\Throwable $th) {
            Session::flash('message', 'Failed Data,This Data Has Been Used');
            Session::flash('alert-class', 'alert-danger'); 
            //throw $th;
        }
    }

    public function getInventoryMaterialListById($id)
    {
        $inventory_material = MrpInventoryMaterialList::find($id);
        return $inventory_material;
    }
}
