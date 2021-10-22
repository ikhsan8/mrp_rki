<?php

namespace App\Http\Controllers\Mrp;

use App\Models\Mrp\MrpBom;
use App\Models\Mrp\MrpBomMaterial;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MrpReportBomNewController extends Controller
{
    public function index(Request $request) 
    {

        $data['page_title'] = 'Report BOM';
        $data['boms'] = MrpBom::orderBy('id', 'desc')->get();

        if ($request->get('start_date')) {
            $date = date('Y-m', strtotime($request->start_date));
            $data['boms'] = MrpBom::where('created_at', 'like', '%' . $date . '%')->orderBy('id', 'desc')->get();
        }
        return view('mrp.boms.report-bom', $data);
    }

    public function show($id)
    {
        $data['bom'] = MrpBom::findOrFail($id);

        return view('mrp.boms.bom-show', $data);
    }
}
