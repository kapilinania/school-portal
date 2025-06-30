
<div id="sidebar-menu" class="sidebar-menu">
    <ul>
        <li class="menu-title">
            <span> Main Menu</span>
        </li>
        <li class="submenu {{ Request::is('admin') ? 'active' : '' }}">
            <a href="#"><i class="feather-grid"></i> <span> {{ __('Dashboard') }}</span> <span class="menu-arrow"></span></a>
            <ul>
                <li><a href="{{ url('admin') }}" class="{{ Request::is('admin') ? 'active' : '' }}">Admin Dashboard</a></li>
            </ul>
        </li>
        <li class="submenu {{ Request::is('admin/students*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-graduation-cap"></i> <span>Students</span> <span class="menu-arrow"></span></a>
            <ul>
                <!-- Student List -->
                <li><a href="{{ route('admin.students.index') }}" class="{{ Request::is('admin/students') || Request::is('admin/students/index') ? 'active' : '' }}">Student List</a></li>
                
                <!-- Student View (when URL contains admin/students/{id}) -->
                <li><a href="{{ route('admin.students.index') }}" class="{{ Request::is('admin/students/*') && !Request::is('admin/students/create') ? 'active' : '' }}">Student View</a></li>
        
                <!-- Student Add -->
                <li><a href="{{ route('admin.students.create') }}" class="{{ Request::is('admin/students/create') ? 'active' : '' }}">Student Add</a></li>
            </ul>
        </li>
        
        
        <li class="submenu {{ Request::is('admin/teachers*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span>Teachers</span> <span class="menu-arrow"></span></a>
            <ul>
                <!-- Teacher List -->
                <li><a href="{{ route('admin.teachers.index') }}" class="{{ Request::is('admin/teachers') || Request::is('admin/teachers/index') ? 'active' : '' }}">Teacher List</a></li>
                
                <!-- Teacher View (when URL contains admin/teachers/{id}) -->
                <li><a href="{{ route('admin.teachers.show', ['teacher' => $teacher->id ?? 1]) }}" class="{{ Request::is('admin/teachers/*') && !Request::is('admin/teachers/create') ? 'active' : '' }}">Teacher View</a></li>
                
                <!-- Teacher Add -->
                <li><a href="{{ route('admin.teachers.create') }}" class="{{ Request::is('admin/teachers/create') ? 'active' : '' }}">Teacher Add</a></li>
            </ul>
        </li>
        
        
        
        <li class="submenu {{ Request::is('admin/sections*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-building"></i> <span> Classes</span> <span class="menu-arrow"></span></a>
            <ul>
                <!-- Class List -->
                <li><a href="{{ route('admin.sections.index') }}" class="{{ Request::is('admin/sections') || Request::is('admin/sections/index') ? 'active' : '' }}">Class List</a></li>
                
                <!-- Class Add -->
                <li><a href="{{ route('admin.sections.create') }}" class="{{ Request::is('admin/sections/create') ? 'active' : '' }}">Class Add</a></li>
            </ul>
        </li>
        
        <li class="submenu {{ Request::is('admin/subjects*') ? 'active' : '' }}">
            <a href="#"><i class="fas fa-book-reader"></i> <span>Subjects</span> <span class="menu-arrow"></span></a>
            <ul>
                <!-- Subject List -->
                <li><a href="{{ route('admin.subjects.index') }}" class="{{ Request::is('admin/subjects') || Request::is('admin/subjects/index') ? 'active' : '' }}">Subject List</a></li>
        
                <!-- Subject Add -->
                <li><a href="{{ route('admin.subjects.create') }}" class="{{ Request::is('admin/subjects/create') ? 'active' : '' }}">Subject Add</a></li>
        
                {{-- Handle edit link if section ID is available --}}
                @if(isset($currentSection)) {{-- Ensure $currentSection is available --}}
                    <li><a href="{{ route('admin.subjects.edit', ['section' => $currentSection]) }}" class="{{ Request::is('admin/subjects/'.$currentSection.'/edit') ? 'active' : '' }}">Subject Edit</a></li>
                @endif
            </ul>
        </li>
        
        
        
        
    </ul>
</div>
