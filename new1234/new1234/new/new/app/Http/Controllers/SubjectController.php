<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Log;

class SubjectController extends Controller
{
    public function index()
    {
        // Retrieve all subjects with their associated sections
        $subjects = Subject::with('section')->get()->groupBy('section_id');

        // Retrieve all sections to access their names
        $sections = Section::all()->keyBy('id'); // Creates a key-value array with section ID as key

        return view('admin.subjects.index', compact('subjects', 'sections'));
    }

    public function create()
    {
        $sections = Section::all(); // Fetch sections from the database
        return view('admin.subjects.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|integer|exists:sections,id', // Validate section as integer and ensure it exists
            'subjects' => 'required|array',
            'subjects.*' => 'required|string|max:255|distinct',
        ]);

        $existingSubjects = Subject::where('section_id', $request->section)->pluck('name')->toArray();

        foreach ($request->subjects as $subjectName) {
            if (in_array($subjectName, $existingSubjects)) {
                return redirect()->back()->withErrors(['subjects' => "Subject '$subjectName' already exists in section $request->section"]);
            }
        }

        foreach ($request->subjects as $subjectName) {
            Subject::create([
                'name' => $subjectName,
                'section_id' => $request->section,
            ]);
        }
         // Log the creation
        Log::create([
            'message' => sprintf('Subjects %s added to Section ID %d by Admin %s on %s',
                implode(', ', $request->subjects),
                $request->section,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subjects added successfully.');
    }

    public function edit($sectionId)
    {
        // Fetch the section by ID
        $section = Section::findOrFail($sectionId);
        // Fetch subjects associated with the section
        $subjects = $section->subjects;

        return view('admin.subjects.edit', compact('subjects', 'section'));
    }

    public function update(Request $request, $sectionId)
    {
        // Validate the incoming request
        $request->validate([
            'subjects.*' => 'required|string|max:255', // Validate each subject name
            'delete_subjects' => 'array',// Validate deletion array
        ]);

        // Retrieve all subjects for the given section
        $subjects = Subject::where('section_id', $sectionId)->get();

        // Update subjects and collect updated subject names
        foreach ($subjects as $subject) {
            $newName = $request->input('subjects.' . $subject->id);

            // Update subject if it has a new name
            if ($newName && $subject->name !== $newName) {
                $subject->name = $newName;
                $subject->save();
            }
        }

        // Check for subjects to delete
        $deleteIds = $request->input('delete_subjects', []);
        Subject::whereIn('id', $deleteIds)->delete();

        // Log the update
        Log::create([
            'message' => sprintf('Subjects updated in Section ID %d by Admin %s on %s.',
                $sectionId,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subjects updated successfully.');
    }

    public function destroy($sectionId, Request $request)
    {
        // Validate request
        $request->validate([
            'subject_id' => 'required|integer|exists:subjects,id', // Ensure the subject exists
        ]);

        // Retrieve subject
        $subject = Subject::findOrFail($request->subject_id);

        // Log the deletion
        Log::create([
            'message' => sprintf('Subject "%s" deleted from Section ID %d by Admin %s on %s.',
                $subject->name,
                $sectionId,
                auth()->user()->name,
                now()->toDateTimeString()
            ),
        ]);

        // Delete subject
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }

    public function getSubjectsBySection(Request $request)
    {
        $section = $request->query('section_id');
        $subjects = Subject::where('section_id', $section)->get();

        if ($subjects->isEmpty()) {
            return response()->json(['message' => 'No subjects available for this section. Please register subjects first.'], 404);
        }

        return response()->json($subjects);
    }
}
