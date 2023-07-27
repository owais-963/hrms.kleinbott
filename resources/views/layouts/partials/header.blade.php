<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center dark-bg">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="/"><img src="{{ frontImage('logo-gradian.png') }}"
                    alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ frontImage('logo-gradian.png') }}"
                    alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end dark-bg">

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-date dropdown">
                <a class="bg-white br-30 btn btn-outline-light text-black">
                    <h6 class="date font-weight-900 mb-0">
                        @if ($attendance && $attendance->check_out_time)
                            <!-- Calculate and display the work duration when checked in and out -->
                            Worked: {{ getWorkDuration($attendance->check_in_time, $attendance->check_out_time) }}
                        @elseif ($attendance && $attendance->check_in_time)
                            <!-- Live timer when checked in but not checked out -->
                            Checked in: <span id="liveTimer"></span>
                        @endif
                    </h6>
                </a>
            </li>
            @if ($attendance && $attendance->check_out_time === null)
            @else
                <li class="nav-item nav-date dropdown">
                    <form method="POST" action="{{ route('attendance.check-in') }}">
                        @csrf
                        <button type="submit" class="btn theme-button">Check In</button>
                    </form>
                </li>
            @endif
            @if ($attendance && $attendance->check_out_time !== null)
            @elseif ($attendance && $attendance->check_out_time === null && $attendance->check_in_time !== null)
                <li class="nav-item nav-date dropdown">
                    <form method="POST" action="{{ route('attendance.check-out') }}">
                        @csrf
                        <button type="submit" class="btn theme-button">Check Out</button>
                    </form>
                </li>
            @endif
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
