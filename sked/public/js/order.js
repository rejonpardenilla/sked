$(document).ready(function(){

    $('#datesTable button.move').click(function() {

        var row = $(this).closest('tr');

        if ($(this).hasClass('up'))
            row.prev().before(row);
        else
            row.next().after(row);
    });

    $('#button-sked').click(function(){

        var requiredGuests = [];
        var orderedDates = [];


        $('#datesTable > tbody > tr').each(function () {

            var date_id = $(this).find('.id-field').text();
            orderedDates.push(date_id);

        });

        $('#guestsTable > tbody > tr').each(function () {

            var date_id = $(this).find('.id-field').text();
            var isRequired = $(this).find('.check').is(':checked')

            var guest = {'id' : date_id, 'isRequired' : isRequired};

            requiredGuests.push(guest);

        });

        var eventId = $('#eventId').val();

        var data = {'guests': requiredGuests, 'dates': orderedDates, 'eventId': eventId};

        $.ajax({
            type: "POST",
            url: '/order/store',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                $.loadingBlockHide
                window.location.href = '/feedback/'+eventId;
            },
        });
        $.loadingBlockShow({
            text: '',
            imgPath: 'img/default.svg',
            imgStyle: {
                width: 'auto',
                textAlign: 'center',
                marginTop: '20%'
            },
        });


    });

});



