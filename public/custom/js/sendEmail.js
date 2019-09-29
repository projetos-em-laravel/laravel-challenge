$(document).on('click', '.eventSend', function() {
    $('#titleSend').text($(this).data('title'));
    $('#descriptionSend').text($(this).data('description'));
    $('#startDateSend').text($(this).data('startdate'));
    $('#startTimeSend').text($(this).data('starttime'));
    $('#endDateSend').text($(this).data('enddate'));
    $('#endTimeSend').text($(this).data('endtime'));
});

$('.modal-footer').on('click', '.sendEmail', function() {
    $.ajax({
        type: 'POST',
        url: "/send",
        data: { 
            '_token'        : $('input[name=_token]').val(),
            'title'         : $('#titleSend').text(),
            'description'   : $('#descriptionSend').text(),
            'start_date'    : $('#startDateSend').text(),
            'start_time'    : $('#startTimeSend').text(),
            'end_date'      : $('#endDateSend').text(),
            'end_time'      : $('#endTimeSend').text(),
            'email'         : $('input[name=email]').val(),
            'email_body'    : $('textarea[name=emailBody]').val(), 
        },
        beforeSend: function () {
            //Aqui adicionas o loader   
            $('.success').addClass('hidden');
            $( "#sendEmail" ).prop( "disabled", true ); 
            $( "#sendEmail" ).text('Loading...');                         
        },  
        success: function(data){
           //Loading button   
            $( "#sendEmail" ).prop( "disabled", false ); 
            $( "#sendEmail" ).text('Send invitation');   

            if((data.errors)) {
                $('.success').addClass('hidden');
                if (data.errors.email) {
                    $('.errorEmail').removeClass('hidden');
                    $('.errorEmail').text(data.errors.email);
                }
                if (data.errors.email_body) {
                    $('.errorBody').removeClass('hidden');
                    $('.errorBody').text(data.errors.email_body);
                }
                if (!data.errors.email) {
                    $('.errorEmail').addClass('hidden');
                }
                if (!data.errors.email_body) {
                    $('.errorBody').addClass('hidden');
                }

            }else if((data.success)){
                $('.errorEmail').addClass('hidden');
                $('.errorBody').addClass('hidden');
                $('.success').removeClass('hidden');
                $('.success').text(data.success);

            }
        }
        
    });
});   