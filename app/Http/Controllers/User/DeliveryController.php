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

        // 公開期間をチェック
        $now = Carbon::now();

        $canWatchByDate = DeliveryTime::where('curriculum_id', $id)
        ->where('delivery_from', '<=', $now)
        ->where('delivery_to', '>=', $now)
        ->exists();

        $canWatch = $curriculum->always_delivery_flg || $canWatchByDate;

        return view('user.delivery', compact('curriculum', 'canWatch'));
    }

    public function clear(Request $request, $id)
    {
    $now = Carbon::now();
    $curriculum = Curriculum::findOrFail($id);

    // 配信中か常時公開かチェック
    $canWatchByDate = DeliveryTime::where('curriculum_id', $id)
        ->where('delivery_from', '<=', $now)
        ->where('delivery_to', '>=', $now)
        ->exists();

    if (!$curriculum->always_delivery_flg && !$canWatchByDate) {
        return redirect()->back()->with('error', '現在この授業は受講できません');
    }

    CurriculumProgress::updateOrCreate(
        ['users_id' => auth()->id(), 'curriculums_id' => $id],
        ['clear_flg' => true]
    );

    return back()->with('success', '受講しました');
    }
}
