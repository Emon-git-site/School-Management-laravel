<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link" style="text-align: center">
        <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 20px;">School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.admin.list') }}"
                            class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.teacher.list') }}"
                            class="nav-link @if (Request::segment(2) == 'teacher') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Teacher
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.student.list') }}"
                            class="nav-link @if (Request::segment(2) == 'student') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Student
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.parent.list') }}"
                            class="nav-link @if (Request::segment(2) == 'parent') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Parent
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ in_array(Request::segment(2), ['class', 'subject', 'assign-subject',
                     'assign_class_teacher', 'class_timetable']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Request::segment(2), ['class', 'subject', 
                        'assign-subject', 'assign_class_teacher', 'class_timetable']) ? 'active' : '' }}">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                            Academics
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{ route('admin.class.list') }}" class="nav-link @if (Request::segment(2) == 'class') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Class</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('admin.subject.list') }}" class="nav-link @if (Request::segment(2) == 'subject') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Subject</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('admin.assign-subject.list') }}" class="nav-link @if (Request::segment(2) == 'assign-subject') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Assign Subject</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('admin.class_timetable.list') }}" class="nav-link @if (Request::segment(2) == 'class_timetable') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Class Timetable</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('admin.assign_class_teacher.list') }}" class="nav-link @if (Request::segment(2) == 'assign_class_teacher') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Assign Class Teacher</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                    <li class="nav-item {{ in_array(Request::segment(3), ['exam', 'exam_schedule', 'assign-subject',
                     'assign_class_teacher', 'class_timetable']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Request::segment(3), ['exam', 'exam_schedule', 
                        'assign-subject', 'assign_class_teacher', 'class_timetable']) ? 'active' : '' }}">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                            Examinations
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{ route('admin.examinations.exam.list') }}" class="nav-link @if (Request::segment(3) == 'exam') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Exam</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('admin.examinations.exam_schedule') }}" class="nav-link @if (Request::segment(3) == 'exam_schedule') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Exam Schedule</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.account.edit') }}"
                            class="nav-link @if (Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Account
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.change_password.show') }}"
                            class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_student') }}"
                            class="nav-link @if (Request::segment(2) == 'my_student') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Student
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_class_subject') }}"
                            class="nav-link @if (Request::segment(2) == 'my_class_subject') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Class & Subject
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_exam_timetable') }}"
                            class="nav-link @if (Request::segment(2) == 'my_exam_timetable') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Exam Timetable
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.change_password.show') }}"
                            class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_calendar') }}"
                            class="nav-link @if (Request::segment(2) == 'my_calendar') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Calendar
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.account.edit') }}"
                            class="nav-link @if (Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Account
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.account.edit') }}"
                            class="nav-link @if (Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Account
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_calendar') }}"
                            class="nav-link @if (Request::segment(2) == 'my_calendar') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Calendar
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_subject') }}"
                            class="nav-link @if (Request::segment(2) == 'my_subject') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Subject
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_timetable') }}"
                            class="nav-link @if (Request::segment(2) == 'my_timetable') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Timetable
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_exam_timetable') }}"
                            class="nav-link @if (Request::segment(2) == 'my_exam_timetable') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Exam Timetable
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.change_password.show') }}"
                            class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a href="{{ route('parent.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parent.my_student') }}"
                            class="nav-link @if (Request::segment(2) == 'my_student') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Student
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parent.account.edit') }}"
                            class="nav-link @if (Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Account
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parent.change_password.show') }}"
                            class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
