<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon d-none" alt="logo icon" style="width: 160px;">
            <h5 class="text-center text-light">TSM</h5>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/employeetasks') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">My Task</div>
            </a>
        </li>
        <li>
            <a href="{{ url('emscore') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">EM Score Details</div>
            </a>
        </li>
        <li>
            <a href="{{ url('/') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Messages</div>
            </a>
        </li>
        @if(auth()->user()->role < 3) <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user-circle'></i>
                </div>
                <div class="menu-title">Task</div>
            </a>
            <ul>
                <li> <a href="{{ route('mastertasks.create') }}"><i class="bx bx-right-arrow-alt"></i>Create Task</a>
                </li>
            </ul>
            </li>
            <li>
            <a href="{{ route('checkreal') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Real Time View</div>
            </a>
        </li>
        <li>
            <a href="{{ route('rev_date-modify') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Delegation Revision Date</div>
            </a>
        </li>
            @endif
    </ul>
    <!--end navigation-->
</div>