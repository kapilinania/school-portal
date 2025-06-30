@extends('layouts.teacher')

@section('title', 'Exam -  Add')

@section('content')       

<!-- -----side content goes here ---  -->

<div class="mt-4">
    <div class="content container-fluid">

    <div class="container">
    <h2>Add Questions to {{ $exam->exam_name }}</h2>
    <form id="examForm" action="{{ route('teacher.questions.store', $exam->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="questions-container">
            <div class="question-form">
                <h4>Question 1</h4>
                <div class="form-group">
                    <label for="question_0">Question</label>
                    <textarea id="question_0" name="questions[0][question]" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="question_image_0">Question Image</label>
                    <input id="question_image_0" type="file" name="questions[0][question_image]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="question_type_0">Question Type</label>
                    <select id="question_type_0" name="questions[0][question_type]" class="form-control question-type" required>
                        <option value="objective">Objective</option>
                        <option value="subjective">Subjective</option>
                    </select>
                </div>
                <div class="form-group option-fields">
                    <label for="option_a_0">Option A</label>
                    <input id="option_a_0" type="text" name="questions[0][option_a]" class="form-control" required>
                    <label for="option_b_0">Option B</label>
                    <input id="option_b_0" type="text" name="questions[0][option_b]" class="form-control" required>
                    <label for="option_c_0">Option C</label>
                    <input id="option_c_0" type="text" name="questions[0][option_c]" class="form-control" required>
                    <label for="option_d_0">Option D</label>
                    <input id="option_d_0" type="text" name="questions[0][option_d]" class="form-control" required>
                    <label for="correct_option_0">Correct Option</label>
                    <select id="correct_option_0" name="questions[0][correct_option]" class="form-control" required>
                        <option value="option_a">Option A</option>
                        <option value="option_b">Option B</option>
                        <option value="option_c">Option C</option>
                        <option value="option_d">Option D</option>
                    </select>
                </div>
                <div class="form-group subjective-fields" style="display: none;">
                    <label for="subjective_answer_0">Subjective Answer</label>
                    <input id="subjective_answer_0" type="text" name="questions[0][subjective_answer]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="points_0">Points</label>
                    <input id="points_0" type="number" name="questions[0][points]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger remove-question">Remove Question</button>
            </div>
        </div>
        <button type="button" id="add-question" class="btn btn-secondary mb-2 mt-2">Add Another Question</button>
        <button type="submit" class="btn btn-primary mb-2">Save Exam</button>
    </form>
</div>

      
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionCount = 1;

        document.getElementById('add-question').addEventListener('click', function () {
            let questionForm = `
                <div class="question-form">
                    <h4>Question ${questionCount + 1}</h4>
                    <div class="form-group">
                        <label for="question_${questionCount}">Question</label>
                        <textarea id="question_${questionCount}" name="questions[${questionCount}][question]" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_image_${questionCount}">Question Image</label>
                        <input id="question_image_${questionCount}" type="file" name="questions[${questionCount}][question_image]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="question_type_${questionCount}">Question Type</label>
                        <select id="question_type_${questionCount}" name="questions[${questionCount}][question_type]" class="form-control question-type" required>
                            <option value="objective">Objective</option>
                            <option value="subjective">Subjective</option>
                        </select>
                    </div>
                    <div class="form-group option-fields">
                        <label for="option_a_${questionCount}">Option A</label>
                        <input id="option_a_${questionCount}" type="text" name="questions[${questionCount}][option_a]" class="form-control" required>
                        <label for="option_b_${questionCount}">Option B</label>
                        <input id="option_b_${questionCount}" type="text" name="questions[${questionCount}][option_b]" class="form-control" required>
                        <label for="option_c_${questionCount}">Option C</label>
                        <input id="option_c_${questionCount}" type="text" name="questions[${questionCount}][option_c]" class="form-control" required>
                        <label for="option_d_${questionCount}">Option D</label>
                        <input id="option_d_${questionCount}" type="text" name="questions[${questionCount}][option_d]" class="form-control" required>
                        <label for="correct_option_${questionCount}">Correct Option</label>
                        <select id="correct_option_${questionCount}" name="questions[${questionCount}][correct_option]" class="form-control" required>
                            <option value="option_a">Option A</option>
                            <option value="option_b">Option B</option>
                            <option value="option_c">Option C</option>
                            <option value="option_d">Option D</option>
                        </select>
                    </div>
                    <div class="form-group subjective-fields" style="display: none;">
                        <label for="subjective_answer_${questionCount}">Subjective Answer</label>
                        <input id="subjective_answer_${questionCount}" type="text" name="questions[${questionCount}][subjective_answer]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="points_${questionCount}">Points</label>
                        <input id="points_${questionCount}" type="number" name="questions[${questionCount}][points]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger remove-question">Remove Question</button>
                </div>
            `;
            document.getElementById('questions-container').insertAdjacentHTML('beforeend', questionForm);
            questionCount++;
        });

        document.addEventListener('change', function (event) {
            if (event.target.matches('.question-type')) {
                const selectedType = event.target.value;
                const questionForm = event.target.closest('.question-form');

                if (selectedType === 'objective') {
                    questionForm.querySelector('.option-fields').style.display = 'block';
                    questionForm.querySelector('.subjective-fields').style.display = 'none';
                    questionForm.querySelectorAll('.option-fields input').forEach(input => input.required = true);
                    questionForm.querySelectorAll('.subjective-fields input').forEach(input => input.required = false);
                } else {
                    questionForm.querySelector('.option-fields').style.display = 'none';
                    questionForm.querySelector('.subjective-fields').style.display = 'block';
                    questionForm.querySelectorAll('.option-fields input').forEach(input => input.required = false);
                    questionForm.querySelectorAll('.subjective-fields input').forEach(input => input.required = true);
                }
            }
        });

        document.addEventListener('click', function (event) {
            if (event.target.matches('.remove-question')) {
                event.target.closest('.question-form').remove();
                updateQuestionTitles();
            }
        });

        function updateQuestionTitles() {
            document.querySelectorAll('.question-form h4').forEach((title, index) => {
                title.textContent = 'Question ' + (index + 1);
            });
        }
    });
</script>
@endsection
