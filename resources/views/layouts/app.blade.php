<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body>

    <div class="container-scroller">
        @include('layouts.partials.header')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.partials.sidebar')
            <div class="main-panel">
                @include('layouts.partials.errors')
                @yield('content')
                @include('layouts.partials.footer')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ frontVendors('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ frontVendors('chart.js/Chart.min.js') }}"></script>
    <script src="{{ frontJs('off-canvas.js') }}"></script>
    <script src="{{ frontJs('hoverable-collapse.js') }}"></script>
    <script src="{{ frontJs('template.js') }}"></script>
    <script src="{{ frontJs('settings.js') }}"></script>
    <script src="{{ frontJs('todolist.js') }}"></script>
    <script src="{{ frontJs('dashboard.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#attendanceTable').DataTable({
                responsive: true
            });
        });
    </script>
    @yield('js')
    <script>
        $(document).ready(function() {
            // Function to update the live timer
            function updateLiveTimer(checkInTime) {
                var startTime = new Date(checkInTime).getTime();
                var now = new Date().getTime();
                var duration = now - startTime;

                // Calculate hours, minutes, and seconds
                var hours = Math.floor(duration / (1000 * 60 * 60));
                var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((duration % (1000 * 60)) / 1000);

                // Format the live timer
                var timerText = hours + " : " + minutes + " : " + seconds + "";
                $(".liveTimer").text(timerText);
            }

            // Check if the user has checked in and display the live timer if needed
            @if ($attendance && $attendance->check_in_time && !$attendance->check_out_time)
                var checkInTime = "{{ ConvertTimeZone($attendance->check_in_time) }}";
                updateLiveTimer(checkInTime);

                // Update the live timer every second
                setInterval(function() {
                    updateLiveTimer(checkInTime);
                }, 1000);
            @endif
        });
    </script>
</body>

</html>
