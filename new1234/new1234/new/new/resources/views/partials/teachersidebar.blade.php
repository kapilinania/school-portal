<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="menu-title">
            <span>Main Menu</span>
        </li>
        
        <!-- Dashboard Menu -->
        <li class="submenu {{ Request::is('teacher/dashboard') ? 'active' : '' }}">
            <a href="#"><i class="feather-grid"></i> <span>{{ __('Dashboard') }}</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/dashboard') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.dashboard') }}" class="{{ Request::is('teacher/dashboard') ? 'active' : '' }}">Teacher Dashboard</a></li>
            </ul>
        </li>

        <!-- Students Menu -->
        <li class="submenu {{ Request::is('teacher/teacher-student-list', 'teacher/total-students*', 'teacher/student/search') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-user-graduate"></i> <span>Students</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/teacher-student-list', 'teacher/total-students*', 'teacher/student/search') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.teacherstudentlist') }}" class="{{ Request::is('teacher/teacher-student-list') ? 'active' : '' }}">Student List</a></li>
                {{-- <li><a href="{{ route('teacher.totalstudent.index') }}" class="{{ Request::is('teacher/total-students') ? 'active' : '' }}">Total Students</a></li> --}}
                {{-- <li><a href="{{ route('teacher.totalstudent.show', ['class' => 'ClassName']) }}" class="{{ Request::is('teacher/total-students/*') ? 'active' : '' }}">Class-wise Students</a></li> --}}
                {{-- <li><a href="{{ route('teacher.search.students') }}" class="{{ Request::is('teacher/student/search') ? 'active' : '' }}">Search Student</a></li> --}}
            </ul>
        </li>

        <!-- Manage Exams Menu -->
        <li class="submenu {{ Request::is('teacher/exams*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-calendar-check"></i> <span>Manage Exams</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/exams*') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.exams.index') }}" class="{{ Request::is('teacher/exams') ? 'active' : '' }}">Schedule New Exam</a></li>
                <li><a href="{{ route('teacher.exams.create') }}" class="{{ Request::is('teacher/exams/create') ? 'active' : '' }}">Create Exam</a></li>
                <li><a href="{{ route('teacher.exams.index') }}" class="{{ Request::is('teacher/exams') ? 'active' : '' }}">Edit Exam</a></li>
            </ul>
        </li>

        <!-- Manage Questions Menu -->
        <li class="submenu {{ Request::is('teacher/exams/*/questions*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-question-circle"></i> <span>Manage Questions</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/exams/*/questions*') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.exams.details') }}" class="{{ Request::is('teacher/questions/exam-details') ? 'active' : '' }}">Exam Details</a></li>
                <li><a href="{{ route('teacher.questions.index', ['exam' => $exam->id ?? 1]) }}" class="{{ Request::is('teacher/exams/*/questions') ? 'active' : '' }}">Question List</a></li>
                <li><a href="{{ route('teacher.questions.create', ['exam' => $exam->id ?? 1]) }}" class="{{ Request::is('teacher/exams/*/questions/create') ? 'active' : '' }}">Add Question</a></li>
                <li><a href="{{ route('teacher.questions.edit', ['exam' => $exam->id ?? 1, 'question' => $question->id ?? 1]) }}" 
                    class="{{ Request::is('teacher/exams/*/questions/*/edit') ? 'active' : '' }}">Question Edit</a></li>
             
            </ul>
        </li>

        <!-- Total Students Menu -->
        <li class="submenu {{ Request::is('teacher/total-students*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-users"></i> <span>Total Students</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/total-students*') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.totalstudent.index') }}" class="{{ Request::is('teacher/total-students') ? 'active' : '' }}">Student Count by Class</a></li>
                <li><a href="{{ route('teacher.totalstudent.show', ['class' => 'ClassName']) }}" class="{{ Request::is('teacher/total-students/*') ? 'active' : '' }}">Class-wise Student List</a></li>
            </ul>
        </li>

        <!-- Generate Results Menu -->
        <li class="submenu {{ Request::is('teacher/generate-results') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-cogs"></i> <span>Generate Results</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('teacher/generate-results') ? 'display: block;' : '' }}">
                <li><a href="{{ route('teacher.showGenerateResultsPage') }}" class="{{ Request::is('teacher/generate-results') ? 'active' : '' }}">Generate Results</a></li>
            </ul>
        </li>
    </ul>
</div>
