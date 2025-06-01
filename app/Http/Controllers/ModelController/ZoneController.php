<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    /**
     * get all active zones
     */
    public function getActiveZones($today_only = 'N')
    {
        $records = Zone::where('status', 'active')->orderBy("created_at", "desc")->get();

        return $this->successResponse("success", $records);
    }

    // Display a listing of the zones.
    public function index()
    {
        $zones = Zone::all();
        return view('zones.index', compact('zones'));
    }

    // Show the form for creating a new zone.
    public function create()
    {
        return view('zones.create');
    }

    // Store a newly created zone in the database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'zone_name' => 'required|max:300',
            'code' => 'required|max:10',
            // Add validation rules for other fields as needed
        ]);

        Zone::create($validatedData);
        return redirect()->route('zones.index')->with('success', 'Zone created successfully.');
    }

    // Display the specified zone.
    public function show(Zone $zone)
    {
        return view('zones.show', compact('zone'));
    }

    // Show the form for editing the specified zone.
    public function edit(Zone $zone)
    {
        return view('zones.edit', compact('zone'));
    }

    // Update the specified zone in the database.
    public function update(Request $request, Zone $zone)
    {
        $validatedData = $request->validate([
            'zone_name' => 'required|max:300',
            'code' => 'required|max:10',
            // Add validation rules for other fields as needed
        ]);

        $zone->update($validatedData);
        return redirect()->route('zones.index')->with('success', 'Zone updated successfully.');
    }

    // Remove the specified zone from the database.
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
    }
}
