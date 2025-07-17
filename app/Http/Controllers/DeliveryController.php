<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DeliveryRequest;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    
    public function showDeliveryEdit($id) {
        $curriculums = new Curriculum();
        $curriculum = $curriculums -> getListById($id);

        $delivery_time = new DeliveryTime();
        $delivery_times = $delivery_time -> getListById($id);
        if(count($delivery_times) === 0) {
            $default = new \stdClass();
            $default -> delivery_from_date = '';
            $default -> delivery_from_time = '';
            $default -> delivery_to_date = '';
            $default -> delivery_to_time = '';
            $delivery_times = [$default];
        } else {
            foreach ($delivery_times as $delivery) {
                $delivery->delivery_from_date = Carbon::parse($delivery->delivery_from)->toDateString();
                $delivery->delivery_from_time = Carbon::parse($delivery->delivery_from)->format('H:i'); 
                $delivery->delivery_to_date = Carbon::parse($delivery->delivery_to)->toDateString();
                $delivery->delivery_to_time = Carbon::parse($delivery->delivery_to)->format('H:i');
            }
        }
        
        return view('admin/delivery',['delivery_times' => $delivery_times, 'curriculum' => $curriculum]);
    }
    
    public function showDeliveryUpdate(DeliveryRequest $request) {
        DB::beginTransaction();
        try {
            foreach ($request->id as $i => $id) {
                if (empty($request->delivery_from_date[$i]) || empty($request->delivery_from_time[$i]) || empty($request->delivery_to_date[$i]) || empty($request->delivery_to_time[$i])) {
                    continue; 
                }
                $delivery_time = DeliveryTime::find($id);

                $from = $request -> delivery_from_date[$i] . ' ' . $request -> delivery_from_time[$i];
                $to   = $request -> delivery_to_date[$i]   . ' ' . $request -> delivery_to_time[$i];

                if ($delivery_time) {
                    $delivery_time -> delivery_from = $from;
                    $delivery_time -> delivery_to = $to;
                } else {
                    $delivery_time = new DeliveryTime();
                    $delivery_time -> curriculums_id = $request -> curriculums_id;
                    $delivery_time -> delivery_from = $from;
                    $delivery_time -> delivery_to = $to;
                }
                $delivery_time -> save();
            }
            $curriculum_id = $request->input('curriculums_id');
            $delivery_id = $request->input('id', []);
            DeliveryTime::where('curriculums_id', $curriculum_id)
                ->whereNotIn('id', $delivery_id)
                ->delete();
            DB::commit();
            return redirect()->route('admin.show.curriculum.list');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
        }
    }
}
