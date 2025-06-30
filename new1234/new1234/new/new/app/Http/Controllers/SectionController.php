<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Log;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        // Validate with unique rule to prevent duplicate sections
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name',
        ]);

        // Create the new section
        $section = Section::create([
            'name' => $request->name,
        ]);

        // Log the creation
        Log::create([
            'message' => sprintf('Class "%s" added by Admin %s on %s',
                $section->name,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Class added successfully.');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        // Store the old name for logging
        $oldName = $section->name;

        // Validate with unique rule, but ignore the current section's name
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name,' . $section->id,
        ]);

        // Update the section
        $section->update([
            'name' => $request->name,
        ]);

        // Log the update
        Log::create([
            'message' => sprintf('Class "%s" updated to "%s" by Admin %s on %s',
                $oldName,
                $section->name,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(Section $section)
    {
        // Store the section name for logging
        $sectionName = $section->name;

        // Delete the section
        $section->delete();

        // Log the deletion
        Log::create([
            'message' => sprintf('Class "%s" deleted by Admin %s on %s',
                $sectionName,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Class deleted successfully.');
    }
}
