<x-mail::message>
    # Break-end Notification

    Hello admin

    {{ $user->username }} Employee id ({{ $user->employee_id }}), have end break at
    {{ $break->end_time }}.

    Thank you for using our system.



    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
