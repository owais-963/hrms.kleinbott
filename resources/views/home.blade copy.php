@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome {{ Auth::user()->name }}</div>

                    <div class="card-body">
                        <div class="container">
                            <h2>Check-in/Check-out System</h2>

                            @if (session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if ($attendance && $attendance->check_out_time === null)
                                <p>Checked in: {{ $attendance->check_in_time }}</p>
                            @else
                                <form method="POST" action="{{ route('attendance.check-in') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Check-in</button>
                                </form>
                            @endif

                            @if ($attendance && $attendance->check_out_time !== null)
                                <p>Checked out: {{ $attendance->check_out_time }}</p>
                            @elseif ($attendance && $attendance->check_out_time === null && $attendance->check_in_time !== null)
                                <form method="POST" action="{{ route('attendance.check-out') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Check-out</button>
                                </form>
                            @endif
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $(".portfolioabc").owlCarousel({
        autoPlay: 3000,
        navigation: true,
        pagination: true,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 2],
        paginationNumbers: true,
        navigationText: [
            "<i class='fa fa-arrow-left' aria-hidden='true'></i>",
            "<i class='fa fa-arrow-right' aria-hidden='true'></i>"
        ],


        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,

                ...
            },
            // breakpoint from 480 up
            480: {
                items: 2,

                ...
            },
            // breakpoint from 768 up
            768: {
                items: 4,

                ...
            }
        }
    });


    $("li.menu-arrow div.abc").click(function() {
        $(this).find('.sub-menu').stop().slideToggle();
        $(this).toggleClass("selected");
    });



    if ($(window).width() < 800) {
        $('.box-slide').cycle({
            fx: 'scrollRight',
            speed: 0,
            pager: '.na2'
        });
    }



    $('.resp-btn .nav-btn').click(function() {
    var ths = $(this);
    if (!ths.hasClass('trgr')) {
        ths.closest('.main-menu').find('.nav-main').stop(0, 0).slideToggle('slow');
        ths.closest('.main-menu').find('.nav-main').addClass('posset');
        ths.addClass('trgr').html('<i class="fa fa-times" aria-hidden="true"></i>');
    } else {
        ths.closest('.main-menu').find('.nav-main').stop(0, 0).slideToggle('slow');
        ths.closest('.main-menu').find('.nav-main').removeClass('posset');

        ths.removeClass('trgr').html('<i class="fa fa-bars" aria-hidden="true"></i>');
    }
    });

    //        $('#horizontalTab').easyResponsiveTabs({
    //            type: 'default', //Types: default, vertical, accordion           
    //            width: 'auto', //auto or any width like 600px
    //            fit: true,   // 100% fit in a container
    //            closed: 'accordion', // Start closed if in accordion view
    //            activate: function(event) { // Callback function if tab is switched
    //                var $tab = $(this);
    //                var $name = $('span', $info);
    //
    //                $name.text($tab.text());
    //
    //                $info.show();
    //            }
    //        });

    // $('#verticalTab').easyResponsiveTabs({
    //            type: 'vertical',
    //            width: 'auto',
    //            fit: true
    //        });
    });
</script>
