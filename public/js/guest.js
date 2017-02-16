$(document).ready(function(){

    $('#datesTable button.move').click(function() {

        var row = $(this).closest('tr');

        if ($(this).hasClass('up'))
            row.prev().before(row);
        else
            row.next().after(row);
    });

    $('#datesTable button.remove').click(function() {

        var row = $(this).closest('tr');

        row.addClass('hidden');
    });

    $('#button-sked').click(function(){

        var orderedDates = [];
        var disabledDates = [];

        $('#datesTable > tbody > tr').each(function () {

            var date_id = $(this).find('.id-field').text();

            if(!$(this).hasClass('hidden')){

                orderedDates.push(date_id);

            }
            else{

                disabledDates.push(date_id);

            }

        });
        var eventId = $('#eventId').val();
        var guestId = $('#guestId').val();

        var data = {'dates': orderedDates, 'disabledDates': disabledDates, 'eventId': eventId, 'guestId' : guestId};


        $.ajax({
            type: "POST",
            url: '/guest/store',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.href = '/';
            },
        });

    });

});



