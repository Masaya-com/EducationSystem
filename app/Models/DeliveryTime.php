<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryTime;

class DeliveryTime extends Model
{
    use HasFactory;

   public function scopeForMonth($query, $year, $month)
    {
        return $query->whereYear('delivery_from', $year)
            ->whereMonth('delivery_from', $month)
            ->orderBy('delivery_from');
    }
}
