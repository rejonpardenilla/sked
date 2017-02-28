

$('#btn-donddde').click(function () {


    var eventName = $('#eventName').val();
    var userName = $('#userName').val();
    var email  = $('#email').val();

    var guests = [];

    $('.guests-form').each(function(index, guest){

        var name = guest.find('.input-name').val();
        console.log(name);

    });

    console.log(eventName + userName + email)

    $.ajax({
        type: "POST",
        url: '/store',
        data: data,
        success: success,
        dataType: dataType
    });

});


