dateCont = 0;

$('#date-picker').datepick({


    onSelect: function (dates) {

        dateCont++;

        if (dateCont == 1) {

            $('#dates-input').append(
                '<div class="row visible-md visible-lg">' +
                '<div class="col-sm-12" style="height: 20px"></div>' +
                '<div class="col-sm-2"></div>' +
                '<div class="col-sm-4">' +
                '<p class="text header-text">Days</p>' +
                '</div>' +

                '<div class="col-sm-4">' +
                '<p class="text header-text">Time</p>' +
                '</div>' +
                '</div>');

        }


        var date = new Date(dates);

        var options = {
            month: "long",
            day: "numeric", year: "numeric"
        };

        var dateToShow = date.toLocaleTimeString("en-us", options);
        dateToShow = dateToShow.split(' ').slice(0, 3).join(' ');
        dateToShow = dateToShow.replace(/,/g, '');

        var sqlDate = date.toISOString();
        var sqlDate = sqlDate.replace("T"," ");
        var sqlDate = sqlDate.substring(0, sqlDate.length - 14);

        var newInput =
        '<div class="form-group row">'+
        '<div class="col-sm-2"></div>'+
        '<div class="col-sm-4">'+
            '<p class="text" style="text-align: center">'+dateToShow+'</p>'+
        '<input name="dates['+dateCont+'][date]" type="hidden" ' +
        'value="'+sqlDate+'">'+
        '</div>'+
        '<div class="col-sm-4">'+
            '<input required name="dates['+dateCont+'][time]" type="time" class="form-control input">'+
            '</div>'+
            '</div>';

        $('#dates-input').append(newInput);

        // var formatedDate = $.datepicker.formatDate('dd-mm-yy', date);
        // var formatedToday = $.datepicker.formatDate('dd-mm-yy', today);


    }


});

