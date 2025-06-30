<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\StudentExam;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    
    public function index(Exam $exam)
    {
        $questions = $exam->questions->map(function($question, $index) {
            $question->index = $index + 1; // Set index starting from 1
            return $question;
        });

        return view('teacher.questions.index', compact('exam', 'questions'));
    }


    public function create(Exam $exam)
    {
        return view('teacher.questions.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
{
    $request->validate([
        'questions.*.question' => 'required|string',
        'questions.*.question_type' => 'required|string|in:objective,subjective',
        'questions.*.question_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'questions.*.option_a' => 'required_if:questions.*.question_type,objective|string|nullable',
        'questions.*.option_b' => 'required_if:questions.*.question_type,objective|string|nullable',
        'questions.*.option_c' => 'required_if:questions.*.question_type,objective|string|nullable',
        'questions.*.option_d' => 'required_if:questions.*.question_type,objective|string|nullable',
        'questions.*.correct_option' => 'required_if:questions.*.question_type,objective|string|nullable|in:option_a,option_b,option_c,option_d',
        'questions.*.points' => 'required|integer',
    ]);

    foreach ($request->questions as $questionData) {
        $path = null;
        if (isset($questionData['question_image'])) {
            $path = $questionData['question_image']->store('question_images', 'public');
        }

        // Determine question status based on question type
        $questionStatus = $questionData['question_type'] === 'objective' ? true : false;

        $exam->questions()->create([
            'question' => $questionData['question'],
            'question_image' => $path,
            'question_type' => $questionData['question_type'],
            'option_a' => $questionData['question_type'] === 'objective' ? $questionData['option_a'] : null,
            'option_b' => $questionData['question_type'] === 'objective' ? $questionData['option_b'] : null,
            'option_c' => $questionData['question_type'] === 'objective' ? $questionData['option_c'] : null,
            'option_d' => $questionData['question_type'] === 'objective' ? $questionData['option_d'] : null,
            'correct_option' => $questionData['question_type'] === 'objective' ? $questionData['correct_option'] : null,
            'points' => $questionData['points'],
            'question_status' => $questionStatus, // Store 1 (true) or 0 (false) here
        ]);
    }

    return redirect()->route('teacher.exams.index')->with('success', 'Questions added successfully.');
}




    public function edit(Exam $exam, $id)
    {
        $question = $exam->questions()->findOrFail($id);
        return view('teacher.questions.edit', compact('exam', 'question'));
    }

    public function update(Request $request, Exam $exam, $id)
    {
        // Validation rules
        $request->validate([
            'question' => 'nullable|string',
            'question_type' => 'nullable|string',
            'option_a' => 'nullable|string',
            'option_b' => 'nullable|string',
            'option_c' => 'nullable|string',
            'option_d' => 'nullable|string',
            'correct_option' => 'nullable|string',
            'subjective_answer' => 'nullable|string',
            'points' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'exam_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_time' => 'required|date_format:H:i',
            'duration' => 'required|integer',
        ]);

        // Find the question associated with the exam
        $question = $exam->questions()->findOrFail($id);

        // Update question properties
        $question->question = $request->input('question', $question->question);
        $question->question_type = $request->input('question_type', $question->question_type);
        $question->option_a = $request->input('option_a', $question->option_a);
        $question->option_b = $request->input('option_b', $question->option_b);
        $question->option_c = $request->input('option_c', $question->option_c);
        $question->option_d = $request->input('option_d', $question->option_d);
        $question->correct_option = $request->input('correct_option', $question->correct_option);
        $question->subjective_answer = $request->input('subjective_answer', $question->subjective_answer);
        $question->points = $request->input('points', $question->points);
        $question->question_status = $question->question_type === 'objective';
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image (if necessary)
            if ($question->image) {
                Storage::delete('public/' . $question->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('questions', 'public');
            $question->image = $imagePath;
        }

        // Update question_status based on question_type
        $question->question_status = ($question->question_type === 'objective');

        $question->save();

        // Update exam properties
        $exam->exam_name = $request->input('exam_name', $exam->exam_name);
        $exam->section = $request->input('section', $exam->section);
        $exam->exam_date = $request->input('exam_date', $exam->exam_date);
        $exam->exam_time = $request->input('exam_time', $exam->exam_time);
        $exam->duration = $request->input('duration', $exam->duration);

        $exam->save();

        return redirect()->route('teacher.questions.index', $exam->id)
            ->with('success', 'Question and exam updated successfully!');
    }

    

    public function destroy(Exam $exam, Question $question)
    {
        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }
        $question->delete();

        return redirect()->route('teacher.questions.index', $exam->id)->with('success', 'Question deleted successfully.');
    }

    public function showStudentAnswers($examId, $studentId)
    {
        $exam = Exam::findOrFail($examId);
        $student = Student::findOrFail($studentId);
        $studentExam = StudentExam::where('exam_id', $examId)->where('student_id', $studentId)->first();
        $questions = $exam->questions;

        // Debugging information
        Log::info('Exam:', ['exam' => $exam]);
        Log::info('Student:', ['student' => $student]);
        Log::info('StudentExam:', ['studentExam' => $studentExam]);
        Log::info('Questions:', ['questions' => $questions]);

        return view('teacher.questions.student_answers', compact('exam', 'student', 'studentExam', 'questions'));
    }

    // Update scores for subjective questions
    public function updateScores(Request $request, StudentExam $studentExam)
    {
        $scores = $request->input('scores', []);
        $totalScore = 0; // Initialize total score
        $maxPoints = $studentExam->exam->total_points;
        $updatedPoints = [];

        foreach ($studentExam->answers as $questionId => $answer) {
            $question = Question::find($questionId);
            if ($question && $question->question_type == 'objective') {
                if ($question->correct_option == $answer) {
                    $totalScore += $question->points;
                }
            }
        }

        foreach ($scores as $questionId => $score) {
            $question = Question::find($questionId);
            if ($question && $question->question_type == 'subjective') {
                $maxQuestionPoints = $question->points;
                if ($score > $maxQuestionPoints) {
                    return redirect()->back()->with('error', 'Score cannot be greater than the maximum points.');
                }
                $updatedPoints[$questionId] = $score;
                $totalScore += $score;
            }
        }

        if ($totalScore > $maxPoints) {
            return redirect()->back()->with('error', 'Total score cannot exceed the maximum points for the exam.');
        }

        // Update question_status for all questions in the exam
        $examQuestions = $studentExam->exam->questions; // Fetch all questions for the exam
        foreach ($examQuestions as $question) {
            $question->question_status = 1; // Set question_status to 1
            $question->save(); // Save changes
        }

        $studentExam->score = $totalScore;
        $studentExam->updated_points = $updatedPoints;
        $studentExam->save();

        return redirect()->back()->with('success', 'Scores updated successfully.');
    }


}
