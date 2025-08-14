<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Lead::query();

    if (auth()->user()->role === 'agent') {
        $query->where('assigned_to', auth()->id());
    }

    if ($request->status) {
        $query->where('status', $request->status);
    }

    $leads = $query->paginate(10);

    return response()->json($leads);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
        $lead = Lead::create($request->validated());
        return response()->json($lead, 201);
    }

    public function show(LeadRequest $request)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $lead->update($request->validated());
        return response()->json($lead);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json(['message' => 'Lead deleted successfully']);
    }
}
