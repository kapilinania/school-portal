@extends('layouts.exam')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@section('content')
    

    {{-- ----new exam dashbaord is here--  --}}
        <div class="container-fluid pt-2 light-mode">
            <!-- Confirmation Modal -->
            <div class="modal fade" id="startExamModal" tabindex="-1" role="dialog" aria-labelledby="startExamModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="startExamModalLabel">Start Exam</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            Are you sure you want to start the exam?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelStartExam">No</button>
                            <button type="button" class="btn btn-primary" id="confirmStartExam">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Modal -->
            <div class="modal fade" id="exitFullscreenModal" tabindex="-1" role="dialog"
                aria-labelledby="exitFullscreenModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exitFullscreenModalLabel">Exit Full-Screen Mode</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            If you exit full-screen mode, your test will be submitted. Are you sure you want to exit full-screen
                            mode?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelExitFullscreen">No</button>
                            <button type="button" class="btn btn-danger" id="confirmExitFullscreen">Yes</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-between">
                <div class="flex-item">
                    <div class="row">
                        <div class="head_con">Exam Name : {{ $exam->exam_name }} - <td>{{ $exam->section->name }}</td></div>
                    </div>
                </div>
                <div class="flex-item time_left">
                    Time Left : <span id="countdown"></span>
                </div>
                <div class="flex-item">
                    <!-- Toggle Dark Mode Button with Icon -->
                    <button class="btn btn-dark" id="darkModeButton" style="display: none">
                        <i class="bi bi-brightness-high-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    <!-- -------------main top section is over now --------------- -->
    <div class="container-fluid mt-2 examinfo_middle">
        <div class="d-flex">
            <div class="flex-item">Class :</div>
            <div class="flex-item "><td>{{ $exam->section->name }}</td></div>
        </div>
    </div>
    <!-- ------top second section is over now ---------  -->

    <section>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 font-weight-bold question_border">
                    <p class="questin_number">Teacher Name : {{ $teacher }} </p>
                </div>
                <div class="col-3 border borde-danger pt-2">
                    <div class="d-flex justify-content-between">
                        <div class="flex-item">
                            <div>Exam Date </div>
                            <div class="mark_point pt-1 mb-1">{{ $exam->exam_date }}</div>
                        </div>
                        <div class="flex-item ">
                            <div> Exam Time </div>
                            <div id="time_start">{{ $exam->exam_time }}</div>
                        </div>
                        {{-- <div class="flex-item ">
                            <div>View In</div>
                            <div class="pt-1">
                                <select id="languageSelect">
                                    <option value="english">English</option>
                                    <option value="Hindi">Hindi</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-3 main_question_section pt-2">
                    <div class="row">
                        <div class="d-flex">
                            <div class="flex-item"><img src="https://cdn-icons-png.flaticon.com/256/149/149071.png"
                                    alt="" class="img-fluid person_main_img"> </div>
                            <div class="flex-item person_text"> {{ $username }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- question section is here------ -->
    <section id="examContent" style="display: none;">
        <div class="container-fluid main_question_container">
            <div class="row">
                <div class="col-9">
                    <div class="row pt-4">
                        <div class="col-12 main_question">
                        </div>
                        <div class="col-12 radio-container">
                            <form id="examForm" action="{{ route('student.exams.submit', $exam->id) }}" method="POST">
                                @csrf
                                <div class="">
                                    <div class="card-body">
                                        {{-- <div id="questionIndices" class="mb-3">
                                            @foreach ($questions as $index => $question)
                                                <button type="button" class="btn btn-outline-primary question-index"
                                                    data-index="{{ $index }}" style="margin-right: 5px;">
                                                    {{ $index + 1 }}
                                                </button>
                                            @endforeach
                                        </div> --}}
                                        @foreach ($questions as $index => $question)
                                            <div class="form-group question" data-index="{{ $index }}"
                                                style="{{ $index != 0 ? 'display:none;' : '' }}">
                                                <label>{{ $question->question }}</label>
                                                <div>
                                                    @if ($question->question_image)
                                                        <a href="{{ asset('storage/' . $question->question_image) }}" data-lightbox="question-image">
                                                            <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image" class="img-fluid" width="250" height="250">
                                                        </a>
                                                    @endif
                                                </div>
                                                
                                                @if ($question->question_type == 'objective')
                                                    <div class="options">
                                                        @foreach (['option_a', 'option_b', 'option_c', 'option_d'] as $option)
                                                            <div class="form-check">
                                                                <input type="radio" name="answers[{{ $question->id }}]"
                                                                    value="{{ $option }}" class="form-check-input"
                                                                    data-question-id="{{ $index }}">
                                                                <label
                                                                    class="form-check-label">{{ $question->$option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button type="button" class="btn btn-danger mt-2 clear-option d-none"
                                                        data-question-id="{{ $index }}">Clear Option</button>
                                                @else
                                                    <div class="form-group">
                                                        <label for="subjective_answer_{{ $question->id }}">Your
                                                            Answer</label>
                                                        <textarea name="answers[{{ $question->id }}]" id="subjective_answer_{{ $question->id }}" class="form-control"
                                                            rows="4"></textarea>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="navigation-buttons mt-3">
                                    <button type="button" id="prevButton" class="btn btn-secondary"
                                        style="display:none;">Back</button>
                                    <button type="button" id="nextButton" class="btn btn-primary">Next</button>
                                    <button type="submit" id="submitButton" class="btn btn-success"
                                        style="display:none;">Submit
                                        Exam</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar: Exam Info & Grid -->
                <div class="col-3 middle_question">
                    <div class="row examinfo_middle_sec">
                        <div class="d-flex">
                            <div class="flex-item">Class:</div>
                            <div class="flex-item ">{{ $exam->module }}</div>
                        </div>
                    </div>
                    <div class="row answer_sec pt-2">
                        <div class="d-flex justify-content-between">
                            <div class="flex-item">
                                <div class="mark_point1 pt-1 mb-1"></div>
                                <div>Answered</div>
                            </div>
                            <div class="flex-item ">
                                <div class="mark_point2 pt-1 mb-1"></div>
                                <div>Skipped</div>
                            </div>
                            <div class="flex-item ">
                                <div class="mark_point3 pt-1 mb-1"></div>
                                <div>Not Answered</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="grid-container">
                            @foreach ($questions as $index => $question)
                                <div class="grid-item {{ $question->status }}"><button type="button" class="btn question-index"
                                    data-index="{{ $index }}" style="margin-right: 5px; width:100%">
                                    {{ $index + 1 }}
                                </button></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- -----exam dashbaord is over now --  --}}

    <script>
        document.getElementById("darkModeButton").addEventListener("click", function() {
            var icon = document.querySelector("#darkModeButton i");
            var body = document.body;

            if (body.classList.contains("light-mode")) {
                body.classList.remove("light-mode");
                body.classList.add("dark-mode");
                icon.classList.remove("bi-brightness-high-fill");
                icon.classList.add("bi-moon-fill"); // Moon icon for dark mode
            } else {
                body.classList.remove("dark-mode");
                body.classList.add("light-mode");
                icon.classList.remove("bi-moon-fill");
                icon.classList.add("bi-brightness-high-fill"); // Sun icon for light mode
            }
        });



        document.addEventListener('DOMContentLoaded', function() {
            let exitAttempted = false;

            // Show the modal on page load
            $('#startExamModal').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');

            // Event listener for the confirmation button
            document.getElementById('confirmStartExam').addEventListener('click', function() {
                $('#startExamModal').modal('hide'); // Hide the modal
                document.getElementById('examContent').style.display = 'block'; // Show the exam content

                // Enter full-screen mode
                enterFullScreen();

                // Initialize the countdown and other functionalities
                initializeExam();
            });

            // Event listener for the cancel button
            document.getElementById('cancelStartExam').addEventListener('click', function() {
                window.location.href =
                    "{{ route('student.dashboard') }}"; // Redirect to the student dashboard
            });

            function enterFullScreen() {
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                    document.documentElement.msRequestFullscreen();
                }
            }

            document.addEventListener('fullscreenchange', function() {
                if (!document.fullscreenElement && !exitAttempted) {
                    exitAttempted = true;
                    $('#exitFullscreenModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');
                }
            });

            document.getElementById('cancelExitFullscreen').addEventListener('click', function() {
                $('#exitFullscreenModal').modal('hide');
                exitAttempted = false;
                enterFullScreen();
            });

            document.getElementById('confirmExitFullscreen').addEventListener('click', function() {
                goToLastQuestionAndSubmit();
            });

            function goToLastQuestionAndSubmit() {
                const questions = document.querySelectorAll('.question');
                const lastQuestionIndex = questions.length - 1;

                // Show the last question
                questions.forEach((question, index) => {
                    question.style.display = index === lastQuestionIndex ? 'block' : 'none';
                });

                // Update the navigation buttons
                document.getElementById('prevButton').style.display = 'inline-block';
                document.getElementById('nextButton').style.display = 'none';
                document.getElementById('submitButton').style.display = 'inline-block';

                // Submit the form
                document.getElementById('examForm').submit();
            }

            function initializeExam() {
                let currentQuestionIndex = 0;
                const questions = document.querySelectorAll('.question');
                const prevButton = document.getElementById('prevButton');
                const nextButton = document.getElementById('nextButton');
                const submitButton = document.getElementById('submitButton');
                const questionIndices = document.querySelectorAll('.question-index');
                const countdownElement = document.getElementById('countdown');

                // Object to store answers
                const answers = JSON.parse(localStorage.getItem('answers')) || {};

                // Initialize remaining time from local storage or default to exam duration
                const examDuration = "{{ $exam->duration }}"; // Assuming this is in "HH:MM:SS" format
                const [hours, minutes, seconds] = examDuration.split(':').map(Number);
                let remainingTime = localStorage.getItem('remainingTime') || (hours * 3600 + minutes * 60 +
                    seconds);

                function shuffleOptions(optionsContainer) {
                    const options = Array.from(optionsContainer.children);
                    for (let i = options.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        optionsContainer.appendChild(options[j]);
                    }
                }

                function showQuestion(index) {
                    questions.forEach((question, i) => {
                        question.style.display = i === index ? 'block' : 'none';
                        if (i === index) {
                            const optionsContainer = question.querySelector('.options');
                            if (optionsContainer) {
                                shuffleOptions(optionsContainer);
                            }
                        }
                    });
                    prevButton.style.display = index === 0 ? 'none' : 'inline-block';
                    nextButton.style.display = index === questions.length - 1 ? 'none' : 'inline-block';
                    submitButton.style.display = index === questions.length - 1 ? 'inline-block' : 'none';

                    // Pre-select saved answer
                    const questionId = questions[index].getAttribute('data-index');
                    const selectedAnswer = answers[questionId];
                    if (selectedAnswer) {
                        document.querySelector(`input[name="answers[${questionId}]"][value="${selectedAnswer}"]`)
                            .checked = true;
                        updateQuestionIndexColor(index);
                    }
                }

                function saveAnswer(index) {
                    const questionId = questions[index].getAttribute('data-index');
                    const selectedOption = document.querySelector(`input[name="answers[${questionId}]"]:checked`);
                    const subjectiveAnswer = document.querySelector(`#subjective_answer_${questionId}`);
                    if (selectedOption) {
                        answers[questionId] = selectedOption.value;
                    } else if (subjectiveAnswer) {
                        answers[questionId] = subjectiveAnswer.value;
                    }
                    localStorage.setItem('answers', JSON.stringify(answers));
                }

                function updateQuestionIndexColor(index) {
                    const questionId = questions[index].getAttribute('data-index');
                    const selectedOption = document.querySelector(`input[name="answers[${questionId}]"]:checked`);
                    const subjectiveAnswer = document.querySelector(`#subjective_answer_${questionId}`);
                    if (selectedOption || (subjectiveAnswer && subjectiveAnswer.value.trim() !== '')) {
                        document.querySelector(`.question-index[data-index="${index}"]`).style.backgroundColor =
                            'orange'; // Change index color to orange
                    } else {
                        document.querySelector(`.question-index[data-index="${index}"]`).style.backgroundColor =
                            ''; // Reset index color
                    }
                }

                questionIndices.forEach(button => {
                    button.addEventListener('click', (event) => {
                        const index = parseInt(event.target.getAttribute('data-index'));
                        saveAnswer(currentQuestionIndex);
                        updateQuestionIndexColor(currentQuestionIndex);
                        currentQuestionIndex = index;
                        showQuestion(currentQuestionIndex);
                    });
                });

                document.querySelectorAll('.form-check-input').forEach(input => {
                    input.addEventListener('change', (event) => {
                        const questionId = event.target.getAttribute('data-question-id');
                        document.querySelector(`.question-index[data-index="${questionId}"]`).style
                            .backgroundColor = 'orange'; // Change index color to orange
                        saveAnswer(currentQuestionIndex);
                    });
                });

                document.querySelectorAll('.clear-option').forEach(button => {
                    button.addEventListener('click', (event) => {
                        const questionId = event.target.getAttribute('data-question-id');
                        document.querySelectorAll(`input[name="answers[${questionId}]"]`).forEach(
                            input => {
                                input.checked = false;
                            });
                        document.querySelector(`.question-index[data-index="${questionId}"]`).style
                            .backgroundColor = ''; // Reset index color
                        delete answers[questionId];
                        localStorage.setItem('answers', JSON.stringify(answers));
                    });
                });

                prevButton.addEventListener('click', () => {
                    saveAnswer(currentQuestionIndex);
                    updateQuestionIndexColor(currentQuestionIndex);
                    if (currentQuestionIndex > 0) {
                        currentQuestionIndex--;
                        showQuestion(currentQuestionIndex);
                    }
                });

                nextButton.addEventListener('click', () => {
                    saveAnswer(currentQuestionIndex);
                    updateQuestionIndexColor(currentQuestionIndex);
                    if (currentQuestionIndex < questions.length - 1) {
                        currentQuestionIndex++;
                        showQuestion(currentQuestionIndex);
                    }
                });

                // Set initial colors for already answered questions and preselect answers
                questions.forEach((question, index) => {
                    updateQuestionIndexColor(index);
                    const questionId = question.getAttribute('data-index');
                    const selectedAnswer = answers[questionId];
                    if (selectedAnswer) {
                        const radioInput = document.querySelector(
                            `input[name="answers[${questionId}]"][value="${selectedAnswer}"]`);
                        if (radioInput) {
                            radioInput.checked = true;
                        } else {
                            const textInput = document.querySelector(`#subjective_answer_${questionId}`);
                            if (textInput) {
                                textInput.value = selectedAnswer;
                            }
                        }
                    }
                });

                showQuestion(currentQuestionIndex);

                // Countdown Timer
                function updateCountdown() {
                    const hrs = Math.floor(remainingTime / 3600);
                    const mins = Math.floor((remainingTime % 3600) / 60);
                    const secs = remainingTime % 60;

                    countdownElement.textContent =
                        `${String(hrs).padStart(2, '0')}:${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;

                    if (remainingTime > 0) {
                        remainingTime--;
                        localStorage.setItem('remainingTime', remainingTime);
                    } else {
                        clearInterval(countdownInterval);
                        localStorage.removeItem('remainingTime');
                        localStorage.removeItem('answers');
                        document.getElementById('examForm').submit(); // Auto-submit the form when time is up
                    }
                }

                const countdownInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Initial call to display the countdown immediately

                // Clear localStorage on form submit
                document.getElementById('examForm').addEventListener('submit', function() {
                    localStorage.removeItem('remainingTime');
                    localStorage.removeItem('answers');
                });
            }

            // Disable right-click
            document.addEventListener('contextmenu', function(event) {
                event.preventDefault();
            });

            // Disable text selection and copying
            document.addEventListener('selectstart', function(event) {
                event.preventDefault();
            });

            document.addEventListener('copy', function(event) {
                event.preventDefault();
            });

            // Disable keyboard shortcuts
            document.addEventListener('keydown', function(event) {
                const forbiddenKeys = ['a', 'c', 'x', 'v', 'u', 's', 'p'];
                if (event.ctrlKey || event.metaKey) {
                    if (forbiddenKeys.includes(event.key.toLowerCase()) || event.shiftKey && forbiddenKeys
                        .includes(event.key.toLowerCase())) {
                        event.preventDefault();
                    }
                }

                // Disable F12 (Developer Tools) and other F keys
                if (event.keyCode >= 112 && event.keyCode <= 123) {
                    event.preventDefault();
                }

                // Disable Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+Shift+C
                if (event.ctrlKey && event.shiftKey && ['I', 'J', 'C'].includes(event.key.toUpperCase())) {
                    event.preventDefault();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalQuestions = {{ count($questions) }};
            let answeredQuestions = new Set();
            let skippedQuestions = new Set();
            let viewedQuestions = new Set();
            let currentQuestionIndex = 0;

            const answeredElement = document.querySelector('.mark_point1');
            const skippedElement = document.querySelector('.mark_point2');
            const notAnsweredElement = document.querySelector('.mark_point3');
            const questionElements = document.querySelectorAll('.question');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const submitButton = document.getElementById('submitButton');

            function updateCounts() {
                answeredElement.textContent = answeredQuestions.size;
                skippedElement.textContent = skippedQuestions.size;
                notAnsweredElement.textContent = totalQuestions - answeredQuestions.size - skippedQuestions.size;
            }

            function checkAnswerStatus() {
                let currentQuestion = questionElements[currentQuestionIndex];
                let selectedAnswer = document.querySelector(
                    `input[name="answers[${currentQuestion.dataset.index}]"]:checked`);
                let textAreaAnswer = document.querySelector(
                    `textarea[name="answers[${currentQuestion.dataset.index}]"]`);

                // Add to viewed questions
                viewedQuestions.add(currentQuestionIndex);

                // If the user selected an answer or wrote something in the textarea, it's considered answered
                if (selectedAnswer || (textAreaAnswer && textAreaAnswer.value.trim() !== "")) {
                    answeredQuestions.add(currentQuestionIndex);
                    skippedQuestions.delete(currentQuestionIndex);
                } else {
                    // If no answer is selected, it's considered skipped
                    skippedQuestions.add(currentQuestionIndex);
                    answeredQuestions.delete(currentQuestionIndex);
                }
            }

            function showQuestion(index) {
                questionElements.forEach((question, i) => {
                    question.style.display = i === index ? 'block' : 'none';
                });

                prevButton.style.display = index === 0 ? 'none' : 'inline-block';
                nextButton.style.display = index === totalQuestions - 1 ? 'none' : 'inline-block';
                submitButton.style.display = index === totalQuestions - 1 ? 'inline-block' : 'none';

                updateCounts();
            }

            nextButton.addEventListener('click', function() {
                checkAnswerStatus();

                if (currentQuestionIndex < totalQuestions - 1) {
                    currentQuestionIndex++;
                    showQuestion(currentQuestionIndex);
                }
            });

            prevButton.addEventListener('click', function() {
                checkAnswerStatus();

                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    showQuestion(currentQuestionIndex);
                }
            });

            document.querySelectorAll('.question-index').forEach(button => {
                button.addEventListener('click', function() {
                    checkAnswerStatus();

                    let targetIndex = parseInt(button.dataset.index);

                    // If the target index is different from the current one
                    if (currentQuestionIndex !== targetIndex) {
                        currentQuestionIndex = targetIndex;
                        showQuestion(currentQuestionIndex);
                    }
                });
            });

            // Initial display
            showQuestion(currentQuestionIndex);
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': false
    });
</script>

@endsection
