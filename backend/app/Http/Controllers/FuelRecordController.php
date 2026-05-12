<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelRecord;
use App\Models\Vehicle;


class FuelRecordController extends Controller
{

    public function store(Request $request)
    {
        $fuel = FuelRecord::create([
            'region' => $request->region,
            'plate_prefix' => $request->plate_prefix,
            'plate_letter' => $request->plate_letter,
            'plate_number' => $request->plate_number,
            'oil_type' => $request->oil_type,
            'liter' => $request->liter,
            'total_price' => $request->total_price,
            'times' => $request->times,
        ]);

        return response()->json([
            'message' => 'Fuel record added successfully',
            'data' => $fuel
        ]);
    }
    public function destroy($id)
    {
        FuelRecord::destroy($id);
        return response()->json(['message' => 'deleted']);
    }
    // FuelRecordController.php

    public function getDashboardStats()
    {
        try {
            $dailyStats = \App\Models\FuelRecord::selectRaw('
                DATE(created_at) as date, 
                COUNT(id) as total_vehicles, 
                SUM(liter) as total_liters, 
                SUM(total_price) as total_prices
            ')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();

            return response()->json($dailyStats);
        } catch (\Exception $e) {
            // ဘာမှားလဲဆိုတာ သိရအောင် log ထဲမှာ error ကို ကြည့်လို့ရပါတယ်
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // FuelRecordController.php
    public function checkStatus(Request $request)
    {
        $record = FuelRecord::where('plate_prefix', $request->prefix)
            ->where('plate_letter', $request->letter)
            ->where('plate_number', $request->number)
            ->whereDate('created_at', now()->toDateString()) // ယနေ့အတွက်ပဲစစ်မယ်
            ->first();

        if (!$record) {
            return response()->json(null); // မှတ်တမ်းမရှိရင် null ပြန်မယ်
        }

        return response()->json($record);
    }
}
