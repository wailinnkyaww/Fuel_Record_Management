<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        return Vehicle::all();
    }

    public function store(Request $request)
    {
        return Vehicle::create($request->all());
    }

    public function show($id)
    {
        return Vehicle::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());
        return $vehicle;
    }

    public function destroy($id)
    {
        Vehicle::destroy($id);
        return response()->json(['message' => 'deleted']);
    }
}
