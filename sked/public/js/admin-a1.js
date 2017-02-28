
var guestsCont = 0;

$(document).ready(function(){

    $('#eventName').focus();

    $( '#deadline' ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $('#deadline').prop("readonly", true);

    var guests = 0;

     $('body').on('click', '#btn-new-guests', function () {
         guests++;
         guestsCont++;

         if(guests == 1){
             $('#guests-input').append(
                 '<div class="row visible-md visible-lg">'+
             '<div class="col-sm-12" style="height: 20px"></div>'+
                 '<div class="col-sm-2"></div>'+
                 '<div class="col-sm-4">'+
                 '<p class="text header-text">Name</p>'+
                 '</div>'+

                 '<div class="col-sm-4">'+
                 '<p class="text header-text">Email</p>'+
                 '</div>'+
                 '</div>');
         }

         var form =
             '<div class="row guests-form">'+
                '<div class="col-sm-2"></div>'+
              '<div class="col-sm-4">'+
             '<input required name="guests['+guestsCont+'][name]" type="text" class="form-control input input-guest input-name" ' +
              'id="guest-name" placeholder="Name">'+
             '</div>'+

             '<div class="col-sm-4">'+
             '<input required name="guests['+guestsCont+'][email]" type="text" class="form-control input input-guest input-email" ' +
             'placeholder="Email">'+
             '</div>'+

             '<div class="col-sm-2">'+
             '<button type="button" button_id="'+ guests +'" class="btn-add-guests btn text" >+ Add</button>'+
             '</div>'+
             '<div class="col-sm-12" style="height: 30px">'+
             '</div>'+
             '</div>';

         $('#guests-input').append(form);

         $('#btn-new-guests').prop("disabled",true);

     });

    $('body').on('click', '.btn-add-guests', function () {

        var id = $(this).attr('button_id');

        var inputName = $(this).parent().parent().find('.input-name');
        var inputEmail = $(this).parent().parent().find('.input-email');

        if( !inputName.val() ){
            inputName.addClass('input-warning');
        }else {
            inputName.removeClass('input-warning');
            inputName.addClass('input-success');
        }

        if( !inputEmail.val() || !isEmail(inputEmail.val()) ){
            inputEmail.addClass('input-warning');
        }else {
            inputEmail.removeClass('input-warning');
            inputEmail.addClass('input-success');
        }

        if(inputName.val() && inputEmail.val() && isEmail(inputEmail.val())){
            inputName.prop('readonly', true);
            inputEmail.prop('readonly', true);
            inputEmail.addClass('input-static');
            inputName.addClass('input-static');

            $(this).removeClass('btn-add-guests');
            $(this).removeClass('text');
            $(this).addClass('btn-danger');
            $(this).addClass('btn-remove-guest');

            $(this).text('x')


            $('#btn-new-guests').prop("disabled",false);

        }
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }


    });


    $('body').on('click', '.btn-remove-guest', function (){

        $(this).parent().parent().remove();


    });


});






