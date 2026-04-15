<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutomationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $automations = Automation::where('user_id', Auth::id())->latest()->get();

        return view('automations.index', compact('automations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('automations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Automation::create([
            'name' => $request->name,
            'description' => $request->description,
            'trigger_type' => $request->trigger_type,
            'active' => 1,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('automations.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Automation $automation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Automation $automation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Automation $automation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Automation $automation)
    {
        //
    }
}
