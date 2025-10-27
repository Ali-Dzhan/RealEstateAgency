<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::with('user')->paginate(5);
        return view('agents.index', compact('agents'));
    }

    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:agents,email,' . $agent->id,
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,agent,client',
        ]);

        $agent->user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $agent->update($request->only('first_name', 'last_name', 'email', 'phone'));

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        $agent->user->delete();
        $agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
