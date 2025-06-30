<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="menu-title">
            <span>Main Menu</span>
        </li>
        
        <li class="submenu {{ Request::is('student/dashboard') ? 'active' : '' }}">
            <a href="#"><i class="feather-grid"></i> <span>{{ __('Dashboard') }}</span> <span class="menu-arrow"></span></a>
            <ul>
                <li><a href="{{ url('student/dashboard') }}" class="{{ Request::is('student/dashboard') ? 'active' : '' }}">Student Dashboard</a></li>
            </ul>
        </li>
        
        <li class="submenu {{ Request::is('student/exams*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-graduation-cap"></i> <span>Exam</span> <span class="menu-arrow"></span></a>
            <ul>
                <li><a href="{{ url('student/examdashboard') }}" class="{{ Request::is('student/examdashboard') ? 'active' : '' }}">Exam Information</a></li>
                <li><a href="{{ url('student/exams') }}" class="{{ Request::is('student/exams') ? 'active' : '' }}">Exam Details</a></li>
            </ul>
        </li>
        
        <li class="submenu {{ Request::is('student/resultgenerate') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span>Result</span> <span class="menu-arrow"></span></a>
            <ul>
                <li><a href="{{ url('student/resultgenerate') }}" class="{{ Request::is('student/resultgenerate') ? 'active' : '' }}">Result Details</a></li>
            </ul>
        </li>
        
    </ul>
</div>
