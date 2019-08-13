$(document).ready(function() {
    $('#add-to-card').bind("click", function(e) {
        //get data
        let roomId = $(this).data("roomId");
        let dateArrival = $('#datepickerarrival').val();
        let dateDeparture = $('#datepickerdeparture').val();
        let people = $('#people').val();
        if (dateArrival === '' || dateDeparture === '') {
            alertify.notify("You can enter input in form", "error", 7);
            return;
        }
        //close modal
        $('#book-room').modal('hide');
        $.ajax({
            type: "post",
            url: "http://localhost:8000/bookings/rooms/" + roomId,
            data: {
                "_token": "{{ csrf_token() }}",
                arrival_date: dateArrival,
                departure_date: dateDeparture,
                peoples: people
            },
            success: function(response) {
                alertify.notify("Book room completed", "success", 7);
                let numberBooking = parseInt($("#number-booking").text());
                $("#number-booking").text(numberBooking + 1);
            },
            error: function(err) {
                console.log(err);
                alertify.notify("An error occurred, Please contact support for notification", "error", 7);
            }
        });
    });
});
