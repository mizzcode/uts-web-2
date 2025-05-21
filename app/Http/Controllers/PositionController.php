<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Position::create($request->only(['name', 'description']));

        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $position->update($request->only(['name', 'description']));

        return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy(Position $position)
    {
        if ($position->employees()->exists()) {
            return redirect()->route('positions.index')->with('error', 'Cannot delete position with assigned employees.');
        }
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Position deleted successfully.');
    }
}