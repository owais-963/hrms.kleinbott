@section('css')
@endsection



@section('sxd')
<script>
    $(document).ready(function() {
        $('.note-button').click(function() {
            // Get the data from the clicked button
            var attendanceId = $(this).data('attendance-id');
            var existingNote = $(this).data('note');
            console.log(attendanceId);
            console.log(attendanceId);
            // Populate the modal form fields with the data
            $('#attendanceIdInput').val(attendanceId);
            $('#note').val(existingNote);

            // Show the modal
            $('#noteModal').modal('show');
        });

        // Handle the form submission via AJAX (similar to previous example)
        $('#noteForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function() {
                    $('#noteModal').modal('hide');
                    // Optionally, you can display a success message to the user
                },
                error: function() {
                    // Handle errors if necessary
                }
            });
        });
    });
</script>
@endsection
