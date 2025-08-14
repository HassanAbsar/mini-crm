<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use App\Models\User;
use App\Notifications\LeadAssignedNotification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{

     /**
     * Display a listing data of the resource.
     */

    public function data(Request $request)
{
    if ($request->ajax()) {
        $query = Lead::with('agent')
            ->select('leads.*');

        // Apply filters
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->agent) {
            $query->where('assigned_to', $request->agent);
        }

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('agent_name', function ($lead) {
                return $lead->agent?->name ?? 'Unassigned';
            })
            ->addColumn('actions', function ($lead) {
                return '
                <a href="'.route('leads.show', $lead->id).'" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="'.route('leads.edit', $lead->id).'" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                    <form action="'.route('leads.destroy', $lead->id).'" method="POST" style="display:inline;">
                        '.csrf_field().method_field('DELETE').'
                        <button onclick="return confirm(\'Delete this lead?\')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}

    /**
     * Display a listing view of the resource.
     */
    public function index(Request $request)
    {
        $agents = User::where('role', 'agent')->get();
        return view('leads.index', compact( 'agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = User::where('role', 'agent')->get();
        return view('leads.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
         $lead = Lead::create($request->validated());

        if ($request->assigned_to) {
            $lead->agent->notify(new LeadAssignedNotification($lead));
        }

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $agents = User::where('role', 'agent')->get();
        return view('leads.edit', compact('lead', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $lead->update($request->validated());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
       $this->authorize('delete', $lead);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
