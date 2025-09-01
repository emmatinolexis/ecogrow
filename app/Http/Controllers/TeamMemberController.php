<?php
namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('created_at', 'desc')->get();
        return view('admin.team_members.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team_members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'linkedin_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team_members', 'public');
        }
        TeamMember::create($data);
        return redirect()->route('admin.team_members.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'linkedin_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team_members', 'public');
        }
        $teamMember->update($data);
        return redirect()->route('admin.team_members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image) {
            \Storage::disk('public')->delete($teamMember->image);
        }
        $teamMember->delete();
        return redirect()->route('admin.team_members.index')->with('success', 'Team member deleted successfully.');
    }
}
