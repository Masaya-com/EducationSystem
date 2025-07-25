<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\CurriculumProgress;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    public function showDelivery($id)
    {
    $curriculum = Curriculum::with('grade')->findOrFail($id);
    $canWatch = $curriculum->always_delivery_flg || DeliveryTime::canBeWatchedNow($id);

    return view('user.delivery', compact('curriculum', 'canWatch'));
    }

    public function clear(Request $request, $id)
    {
    $curriculum = Curriculum::findOrFail($id);

    if (!$curriculum->always_delivery_flg && !DeliveryTime::canBeWatchedNow($id)) {
    return redirect()->back()->with('error', '現在この授業は受講できません');
    }

    CurriculumProgress::markAsCleared(auth()->id(), $id);

    return back()->with('success', '受講しました');
    }
}
