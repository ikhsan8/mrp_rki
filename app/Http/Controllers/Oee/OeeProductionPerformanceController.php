<?php

namespace App\Http\Controllers\Oee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mrp\MrpShiftController;
use App\Models\Oee\OeeLogValue;
use App\Models\Mrp\MrpShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Oee\OeeMachine;
use Illuminate\Support\Carbon;
use App\Models\Oee\OeeSetProduct;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\Session;


class OeeProductionPerformanceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:production_performance', ['only' => ['index']]);
    }

    public function createDefect()
    {
        return view('oee.production-performance.oee-production-performance-detail-create');
    }

    public function storeDefect(Request $request)
    {
        try {
            $insertDefect = [
                'date' => date('Y-m-d', strtotime($request->date)),
                'trouble' => $request->trouble,
                'cause' => $request->cause,
                'action' => $request->action,
                'status' => $request->status,
                'machine_id' => $request->machine_id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('detail_defects')->insert($insertDefect);

            $response = (object)[
                'status' => 200,
                'message' => "Succes Insert"
            ];
            return json_encode($response);
        } catch (\Throwable $th) {
            $response = (object)[
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return json_encode($response);
        }
    }
    public function getDefect(Request $request)
    {
        try {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            if ($request->startDate) {
                $start = date('Y-m-d 00:00:00', strtotime($request->startDate));
            } elseif ($request->endDate) {
                $end = date('Y-m-d 00:00:00', strtotime($request->endDate));
            }

            if ($request->type == "daily") {
                $start = date('Y-m-d 00:00:00', strtotime($request->startDate));
                $end = date('Y-m-d 23:59:59', strtotime($request->endDate));
            } elseif ($request->type == "monthly") {
                $start = date('Y-m-01 00:00:00', strtotime($request->startDate));
                $end = date('Y-m-t 23:59:59', strtotime($request->endDate));
            } else {
                $start = date('Y-m-d 00:00:00');
                $end = date('Y-m-d 23:59:59');
            }


            $defect =  DB::table('detail_defects')->orderBy('created_at', 'asc')->whereBetween('created_at', [$start, $end])->get();

            $response = (object)[
                'status' => 200,
                'message' => "Succes Get",
                'defect' => $defect
            ];
            return json_encode($response);
        } catch (\Throwable $th) {
            $response = (object)[
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return json_encode($response);
        }
    }

    public function deleteDefect(Request $request)
    {
        try {
            $response = (object)[
                'status' => 200,
                'message' => "Succes Delete Data",
            ];
            DB::table('detail_defects')->where('id', $request->id)->delete();
            return json_encode($response);
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
    }

    public function createEffeciency()
    {
        return view('oee.production-performance.oee-production-performance-detail-effeciency-create');
    }

    public function storeEffeciency(Request $request)
    {
        try {
            $insertEffeciency = [
                'date' => date('Y-m-d', strtotime($request->date)),
                'trouble' => $request->trouble,
                'cause' => $request->cause,
                'action' => $request->action,
                'status' => $request->status,
                'machine_id' => $request->machine_id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('detail_effeciency')->insert($insertEffeciency);

            $response = (object)[
                'status' => 200,
                'message' => "Succes Insert"
            ];
            return json_encode($response);
        } catch (\Throwable $th) {
            $response = (object)[
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return json_encode($response);
        }
    }
    public function getEffeciency(Request $request)
    {
        try {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            if ($request->startDate) {
                $start = date('Y-m-d 00:00:00', strtotime($request->startDate));
            } elseif ($request->endDate) {
                $end = date('Y-m-d 00:00:00', strtotime($request->endDate));
            }

            if ($request->type == "daily") {
                $start = date('Y-m-d 00:00:00', strtotime($request->startDate));
                $end = date('Y-m-d 23:59:59', strtotime($request->endDate));
            } elseif ($request->type == "monthly") {
                $start = date('Y-m-01 00:00:00', strtotime($request->startDate));
                $end = date('Y-m-t 23:59:59', strtotime($request->endDate));
            } else {
                $start = date('Y-m-d 00:00:00');
                $end = date('Y-m-d 23:59:59');
            }

            $defect =  DB::table('detail_effeciency')->orderBy('created_at', 'asc')->whereBetween('created_at', [$start, $end])->get();

            $response = (object)[
                'status' => 200,
                'message' => "Succes Get",
                'defect' => $defect
            ];
            return json_encode($response);
        } catch (\Throwable $th) {
            $response = (object)[
                'status' => 500,
                'message' => $th->getMessage()
            ];
            return json_encode($response);
        }
    }

    public function deleteEffeciency(Request $request)
    {
        try {
            $response = (object)[
                'status' => 200,
                'message' => "Succes Delete Data",
            ];
            DB::table('detail_effeciency')->where('id', $request->id)->delete();
            return json_encode($response);
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }
    }

    public function index()
    {
        $data['page_title'] = "Production Performance";
        return view('oee.production-performance.oee-production-performance', $data);
    }

    public function detailDefect($id)
    {
        $oeeMachine = OeeMachine::where('name', $id)->first();
        $data['page_title'] = "Detail Defect ";
        $data['machine'] = $oeeMachine;
        return view('oee.production-performance.oee-production-performance-detail', $data);
    }

    public function detailEffeciency($id)
    {
        $oeeMachine = OeeMachine::where('name', $id)->first();
        $data['page_title'] = "Detail Effeciency ";
        $data['machine'] = $oeeMachine;
        return view('oee.production-performance.oee-production-performance-detail-effeciency', $data);
    }

    public function daily(Request $request)
    {
        // $date_now = Carbon::now(); // will get you the current date, time 
        $date = $request->get('date_from');
        $date2 = $request->get('date_to');

        $OeeMachines = OeeMachine::orderBy('index')->get();
        if ($request->type === 'monthly') {
            $dataLogs = DB::table('oee_plc_values')
                ->select(DB::raw("
            date_trunc('day',datetime) AS dttime ,
            max(productionquantity) as total_qty,
            max(passquantity) as good_qty,
            max(failquantity) as reject_qty,
            max(runningtimesecond) as running_second,
            max(runningtimesecond)/60 as running_minute,
            max(runningtimehour) as running_hour,
            max(abnormalytimesecond)/60 as abnormaly_time_minute,
            min(device) as device_id
            "))
                // ->where("datetime", ">=", $date.' 00:00:00')
                // ->where("datetime", "<=", $date.' 23:59:59')
                ->where("datetime", "like", $date . '%')
                ->groupBy('dttime')
                ->groupBy('dttime')
                ->groupBy('device')
                ->orderBy('dttime', 'asc')
                ->get()->toArray();
        } else if ($request->type === 'daily') {
            $dataLogs = DB::table('oee_plc_values')
                ->select(DB::raw("
            date_trunc('hour',datetime) +
            (((date_part('minute', datetime)::integer / 60::integer) * 60::integer)
            || 'minutes')::interval AS dttime ,
            max(productionquantity) as total_qty,
            max(passquantity) as good_qty,
            max(failquantity) as reject_qty,
            max(runningtimesecond) as running_second,
            max(runningtimesecond)/60 as running_minute,
            max(runningtimehour) as running_hour,
            max(abnormalytimesecond)/60 as abnormaly_time_minute,
            min(device) as device_id
            "))
                ->where("datetime", ">=", $date . ' 00:00:00')
                ->where("datetime", "<=", $date2 . ' 23:59:59')
                ->groupBy('dttime')
                ->groupBy('dttime')
                ->groupBy('device')
                ->orderBy('dttime', 'asc')
                ->get()->toArray();
        } else {
            $dataLogs = DB::table('oee_plc_values')
                ->select(DB::raw("
            date_trunc('hour',datetime) +
            (((date_part('minute', datetime)::integer / 60::integer) * 60::integer)
            || 'minutes')::interval AS dttime ,
            max(productionquantity) as total_qty,
            max(passquantity) as good_qty,
            max(failquantity) as reject_qty,
            max(runningtimesecond) as running_second,
            max(runningtimesecond)/60 as running_minute,
            max(runningtimehour) as running_hour,
            max(abnormalytimesecond)/60 as abnormaly_time_minute,
            min(device) as device_id
            "))
                ->where("datetime", ">=", $date . ' 00:00:00')
                ->where("datetime", "<=", $date2 . ' 23:59:59')
                ->groupBy('dttime')
                ->groupBy('dttime')
                ->groupBy('device')
                ->orderBy('dttime', 'asc')
                ->get()->toArray();
        }

        $dataPerformances = [];
        foreach ($OeeMachines as $oms) {
            $dataPerformances[$oms->name] = [
                'times' => [],
                'production_output' => [],
                'production_plan' => [],
                'production_diff' => [],
                'production_fail' => [],
                'production_defect_rate_target' => [],
                'production_defect_rate' => [],
                'production_efficiency_target' => [],
                'production_efficiency' => [],
            ];

            foreach ($dataLogs as $d) {
                if ($d->device_id === $oms->name) {
                    array_push($dataPerformances[$oms->name]['times'], $d->dttime);
                    array_push($dataPerformances[$oms->name]['production_output'], $d->total_qty);
                    array_push($dataPerformances[$oms->name]['production_plan'], ($d->running_second / $oms->cycle_time));
                    array_push($dataPerformances[$oms->name]['production_diff'], $d->total_qty - ($d->running_second / $oms->cycle_time));
                    array_push($dataPerformances[$oms->name]['production_fail'], $d->reject_qty);
                    array_push($dataPerformances[$oms->name]['production_defect_rate_target'], $oms->target_defect_rate);
                    array_push($dataPerformances[$oms->name]['production_defect_rate'], ($d->reject_qty / max($d->total_qty, 1)) * 100);
                    array_push($dataPerformances[$oms->name]['production_efficiency_target'], $oms->target_effeciency);
                    array_push($dataPerformances[$oms->name]['production_efficiency'], ($d->good_qty / max($d->total_qty, 1)) * 100);
                }
            }
            // $datetimes = [];
            // $dataOee = array_map(function ($d) use (&$datetimes) {
            //     $_availability = (($d->running_minute - $d->abnormaly_time_minute) / 500) * 100;
            //     $_performance = ($d->total_qty / (480 * 20)) * 100;
            //     $_quality = ($d->good_qty / $d->total_qty) * 100;
            //     $_oee = (($_availability / 100) * ($_performance / 100) * ($_quality / 100)) * 100;
            //     array_push($datetimes, $d->dttime);
            //     return [
            //         'datetime' => $d->dttime,
            //         'availability' => $_availability,
            //         'performance' => $_performance,
            //         'quality' => $_quality,
            //         'oee' => $_oee,
            //     ];
            // }, $dataLogs);
        }


        return $dataPerformances;
    }


    public function getDataLogsOee($datetime, $timeFrom, $timeTo, $machine, $type)
    {
        $dataLogs = DB::table('oee_plc_values')
            ->select(DB::raw("date_trunc('day',datetime) +
            (((date_part('minute', datetime)::integer / 60::integer) * 60::integer)
            || 'minutes')::interval AS dttime ,
            max(productionquantity) as total_qty,
            max(passquantity) as good_qty,
            max(failquantity) as reject_qty,
            max(runningtimesecond) as running_second,
            max(runningtimesecond)/60 as running_minute,
            max(runningtimehour) as running_hour,
            max(abnormalytimesecond)/60 as abnormaly_time_minute,
            max(abnormalytimesecond) as abnormaly_time_second,
            max(station1) as st1,
            max(station1up) as st1up,
            max(station2) as st2,
            max(station3_high) as st3_high,
            max(station3_low) as st3_low,
            max(station3_height) as st3_height,
            max(station3up_height) as st3up_height,
            max(station3_noball) as st3_noball,
            max(station3_twoball) as st3_twoball,
            max(station5_height) as st5_height,
            max(station5_high) as st5_high,
            max(station5_low) as st5_low,
            max(station6_high) as st6_high,
            max(station6_low) as st6_low,
            max(station8_high) as st8_high,
            max(station8_low) as st8_low,
            max(station9_interface) as st9_interface,
            max(station10_high) as st10_high,
            max(station10_low) as st10_low,
            max(station10_direction) as st10_direction,
            max(station10_presshigh) as st10_presshigh,
            max(station10_presslevel) as st10_presslevel,
            max(station11_presslow) as st11_presslow,
            max(station11_presslevel) as st11_presslevel,


            min(device) as device_id
            "))
            ->where("datetime", ">=", $timeFrom)
            ->where("datetime", "<=", $timeTo)
            // ->where("datetime", "like", $date.'%')
            ->where("runningtimesecond",'>', 0)
            ->where("device", $machine)
            ->groupBy('dttime')
            ->groupBy('dttime')
            ->groupBy('device')
            ->orderBy('dttime', 'asc')
            ->first();

        return $dataLogs;
    }
    public function dailyDetailDefect(Request $request)
    {
        $machine = $request->get('name');
        $date = date('Y-m-d');
        $date2 = date('Y-m-d');
        $dataTimes = [];

        if ($date) {
            $date = $request->get('date_from');
            $date2 = $request->get('date_to');
        }

        if($request->type == 'monthly'){
            $date = $request->get('date_from').'-01';
            $date2 = $request->get('date_to').'-'.date("t", strtotime($date));;
        }

        $begin = new DateTime($date);
        $end   = new DateTime($date2);

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            array_push($dataTimes, $i->format("Y-m-d"));
        }


        $OeeMachines = OeeMachine::orderBy('index')->where('name', $machine)->first();

        $dataTrend = [
            'times' => [],
            'running' => [],
            'downtime' => [],
            'production_output' => [],
            'production_good' => [],
            'production_plan' => [],
            'production_diff' => [],
            'production_fail' => [],
            'production_defect_rate_target' => [],
            'production_defect_rate' => [],
            'production_efficiency_target' => [],
            'production_efficiency' => [],
            'production_productivity' => [],
            'st1' => [],
            'st1up' => [],
            'st2' => [],
            'st3_high' => [],
            'st3_low' => [],
            'st3_height' => [],
            'st3up_height' => [],
            'st3_noball' => [],
            'st3_twoball' => [],
            'st5_height' => [],
            'st5_high' => [],
            'st5_low' => [],
            'st6_high' => [],
            'st6_low' => [],
            'st8_high' => [],
            'st8_low' => [],
            'st9_interface' => [],
            'st10_high' => [],
            'st10_low' => [],
            'st10_direction' => [],
            'st10_presshigh' => [],
            'st10_presslevel' => [],
            'st11_presslow' => [],
            'st11_presslevel' => [],
        ];
        $Shifts = MrpShift::where('shift_name','SHIFT 1')
        ->orWhere('shift_name','Shift 2')
        ->get();


        $dataTrendShift = [];


        foreach ($dataTimes as  $dataTime) {
            $_dt['date'] = $dataTime;
            $_dt['data'] = [];
            $_shifts = [];


            foreach ($Shifts as $shift) {
                $timeFrom = $dataTime . ' ' . $shift->time_from . ':00';
                if ($shift->over_night == 'true') {
                    $datetime = new DateTime($dataTime);
                    $datetime->modify('+1 day');
                    $dataTime = $datetime->format('Y-m-d');
                }
                $timeTo = $dataTime . ' ' . $shift->time_to . ':00';
                $d = $this->getDataLogsOee($dataTime, $timeFrom, $timeTo, $machine, $request->type);
                // --- get data
                $dataTrend = [];
                if($d){
                    $_availability = ((($d->running_minute + $d->abnormaly_time_minute) - $d->abnormaly_time_minute) / ($d->running_minute + $d->abnormaly_time_minute) ) * 100;
                    $_performance = (($d->total_qty * $OeeMachines->cycle_time) / $d->running_second) * 100;
                    $_quality = ($d->good_qty / $d->total_qty) * 100;
                    $_oee = (($_availability / 100) * ($_performance / 100) * ($_quality / 100)) * 100;
                    $dataTrend['times'] = $d->dttime;
                    $dataTrend['running'] = $d->running_second;
                    $dataTrend['downtime'] = $d->abnormaly_time_second;
                    $dataTrend['production_output'] = $d->total_qty;
                    $dataTrend['production_plan'] = $d->running_second / $OeeMachines->cycle_time;
                    $dataTrend['production_diff'] = $d->total_qty - ($d->running_second / $OeeMachines->cycle_time);
                    $dataTrend['production_fail'] = $d->reject_qty;
                    $dataTrend['production_defect_rate_target'] = $OeeMachines->target_defect_rate;
                    $dataTrend['production_defect_rate'] = ($d->reject_qty / max($d->total_qty, 1)) * 100;
                    $dataTrend['production_efficiency_target'] = $OeeMachines->target_effeciency;
                    $dataTrend['production_efficiency'] = ($d->good_qty / max($d->total_qty, 1)) * 100;
                    $dataTrend['production_productivity'] = (($d->running_second / $OeeMachines->cycle_time) / max($d->total_qty, 1)) * 100;
                    $dataTrend['st1'] = ($d->st1);
                    $dataTrend['st1up'] = ($d->st1up);
                    $dataTrend['st2'] = ($d->st2);
                    $dataTrend['st3_high'] = ($d->st3_high);
                    $dataTrend['st3_low'] = ($d->st3_low);
                    $dataTrend['st3_height'] = ($d->st3_height);
                    $dataTrend['st3up_height'] = ($d->st3up_height);
                    $dataTrend['st3_noball'] = ($d->st3_noball);
                    $dataTrend['st3_twoball'] = ($d->st3_twoball);
                    $dataTrend['st5_height'] = ($d->st5_height);
                    $dataTrend['st5_high'] = ($d->st5_high);
                    $dataTrend['st5_low'] = ($d->st5_low);
                    $dataTrend['st6_high'] = ($d->st6_high);
                    $dataTrend['st6_low'] = ($d->st6_low);
                    $dataTrend['st8_high'] = ($d->st8_high);
                    $dataTrend['st8_low'] = ($d->st8_low);
                    $dataTrend['st9_interface'] = ($d->st9_interface);
                    $dataTrend['st10_high'] = ($d->st10_high);
                    $dataTrend['st10_low'] = ($d->st10_low);
                    $dataTrend['st10_direction'] = ($d->st10_direction);
                    $dataTrend['st10_presshigh'] = ($d->st10_presshigh);
                    $dataTrend['st10_presslevel'] = ($d->st10_presslevel);
                    $dataTrend['st11_presslow'] = ($d->st11_presslow);
                    $dataTrend['st11_presslevel'] = ($d->st11_presslevel);
                }
                
                array_push($_shifts, [
                    'shift_name' => $shift->shift_name,
                    'time_from' => $timeFrom,
                    'time_to' => $timeTo,
                    'values' => $dataTrend
                ]);
            }
            array_push($_dt['data'], $_shifts);
            $dataTrendShift[] = $_dt;
        }
        return json_encode(['datetime' => $dataTimes, 'all_values' => $dataTrendShift]);
    }

    public function dailyDetailEffeciency(Request $request)
    {
        $machine = $request->get('name');
        $date = date('Y-m-d');
        $date2 = date('Y-m-d');
        $dataTimes = [];

        if ($date) {
            $date = $request->get('date_from');
            $date2 = $request->get('date_to');
        }

        if($request->type == 'monthly'){
            $date = $request->get('date_from').'-01';
            $date2 = $request->get('date_to').'-'.date("t", strtotime($date));;
        }

        $begin = new DateTime($date);
        $end   = new DateTime($date2);

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            array_push($dataTimes, $i->format("Y-m-d"));
        }


        $OeeMachines = OeeMachine::orderBy('index')->where('name', $machine)->first();

        $dataTrend = [
            'times' => [],
            'running' => [],
            'downtime' => [],
            'production_output' => [],
            'production_good' => [],
            'production_plan' => [],
            'production_diff' => [],
            'production_fail' => [],
            'production_defect_rate_target' => [],
            'production_defect_rate' => [],
            'production_efficiency_target' => [],
            'production_efficiency' => [],
            'production_productivity' => [],
            'st1' => [],
            'st1up' => [],
            'st2' => [],
            'st3_high' => [],
            'st3_low' => [],
            'st3_height' => [],
            'st3up_height' => [],
            'st3_noball' => [],
            'st3_twoball' => [],
            'st5_height' => [],
            'st5_high' => [],
            'st5_low' => [],
            'st6_high' => [],
            'st6_low' => [],
            'st8_high' => [],
            'st8_low' => [],
            'st9_interface' => [],
            'st10_high' => [],
            'st10_low' => [],
            'st10_direction' => [],
            'st10_presshigh' => [],
            'st10_presslevel' => [],
            'st11_presslow' => [],
            'st11_presslevel' => [],
        ];
        $Shifts = MrpShift::where('shift_name','SHIFT 1')
        ->orWhere('shift_name','Shift 2')
        ->get();


        $dataTrendShift = [];


        foreach ($dataTimes as  $dataTime) {
            $_dt['date'] = $dataTime;
            $_dt['data'] = [];
            $_shifts = [];


            foreach ($Shifts as $shift) {
                $timeFrom = $dataTime . ' ' . $shift->time_from . ':00';
                if ($shift->over_night == 'true') {
                    $datetime = new DateTime($dataTime);
                    $datetime->modify('+1 day');
                    $dataTime = $datetime->format('Y-m-d');
                }
                $timeTo = $dataTime . ' ' . $shift->time_to . ':00';
                $d = $this->getDataLogsOee($dataTime, $timeFrom, $timeTo, $machine, $request->type);
                // --- get data
                $dataTrend = [];
                if($d){
                    $_availability = ((($d->running_minute + $d->abnormaly_time_minute) - $d->abnormaly_time_minute) / ($d->running_minute + $d->abnormaly_time_minute) ) * 100;
                    $_performance = (($d->total_qty * $OeeMachines->cycle_time) / $d->running_second) * 100;
                    $_quality = ($d->good_qty / $d->total_qty) * 100;
                    $_oee = (($_availability / 100) * ($_performance / 100) * ($_quality / 100)) * 100;
                    $dataTrend['times'] = $d->dttime;
                    $dataTrend['running'] = $d->running_second;
                    $dataTrend['downtime'] = $d->abnormaly_time_second;
                    $dataTrend['production_output'] = $d->total_qty;
                    $dataTrend['production_plan'] = $d->running_second / $OeeMachines->cycle_time;
                    $dataTrend['production_diff'] = $d->total_qty - ($d->running_second / $OeeMachines->cycle_time);
                    $dataTrend['production_fail'] = $d->reject_qty;
                    $dataTrend['production_defect_rate_target'] = $OeeMachines->target_defect_rate;
                    $dataTrend['production_defect_rate'] = ($d->reject_qty / max($d->total_qty, 1)) * 100;
                    $dataTrend['production_efficiency_target'] = $OeeMachines->target_effeciency;
                    $dataTrend['production_efficiency'] = ($d->good_qty / max($d->total_qty, 1)) * 100;
                    $dataTrend['production_productivity'] = (($d->running_second / $OeeMachines->cycle_time) / max($d->total_qty, 1)) * 100;
                    $dataTrend['st1'] = ($d->st1);
                    $dataTrend['st1up'] = ($d->st1up);
                    $dataTrend['st2'] = ($d->st2);
                    $dataTrend['st3_high'] = ($d->st3_high);
                    $dataTrend['st3_low'] = ($d->st3_low);
                    $dataTrend['st3_height'] = ($d->st3_height);
                    $dataTrend['st3up_height'] = ($d->st3up_height);
                    $dataTrend['st3_noball'] = ($d->st3_noball);
                    $dataTrend['st3_twoball'] = ($d->st3_twoball);
                    $dataTrend['st5_height'] = ($d->st5_height);
                    $dataTrend['st5_high'] = ($d->st5_high);
                    $dataTrend['st5_low'] = ($d->st5_low);
                    $dataTrend['st6_high'] = ($d->st6_high);
                    $dataTrend['st6_low'] = ($d->st6_low);
                    $dataTrend['st8_high'] = ($d->st8_high);
                    $dataTrend['st8_low'] = ($d->st8_low);
                    $dataTrend['st9_interface'] = ($d->st9_interface);
                    $dataTrend['st10_high'] = ($d->st10_high);
                    $dataTrend['st10_low'] = ($d->st10_low);
                    $dataTrend['st10_direction'] = ($d->st10_direction);
                    $dataTrend['st10_presshigh'] = ($d->st10_presshigh);
                    $dataTrend['st10_presslevel'] = ($d->st10_presslevel);
                    $dataTrend['st11_presslow'] = ($d->st11_presslow);
                    $dataTrend['st11_presslevel'] = ($d->st11_presslevel);
                }
                
                array_push($_shifts, [
                    'shift_name' => $shift->shift_name,
                    'time_from' => $timeFrom,
                    'time_to' => $timeTo,
                    'values' => $dataTrend
                ]);
            }
            array_push($_dt['data'], $_shifts);
            $dataTrendShift[] = $_dt;
        }
        return json_encode(['datetime' => $dataTimes, 'all_values' => $dataTrendShift]);
    }
}
