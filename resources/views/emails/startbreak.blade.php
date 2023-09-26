<x-mail::message>
    # Check-in Notification

    Hello admin

    {{ $user->username }} Employee id ({{ $user->employee_id }}), have successfully checked in at
    {{ $break->start_time }}.
  

    Thank you for using our system.



    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
