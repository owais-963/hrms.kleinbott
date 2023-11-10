<x-mail::message>
    # Break-Start Notification

    Hello admin

    {{ $user->username }} Employee id ({{ $user->employee_id }}), have start break at
    {{ $break->start_time }}.


    Thank you for using our system.



    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
