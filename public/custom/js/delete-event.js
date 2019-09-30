var id;
$(document).on('click', '.deleteEventForModal', function() { 
   
       $('#eventId').text($(this).data('id'));
       $('#title').text($(this).data('title'));
       id = $(this).data('id');
       
});

$('.modal-footer').on('click', '.deleteEventInModal', function() {
       
       
       $.ajax({
           type: 'DELETE',
           url: '/events/' + id,
           data: {
               '_token': $('input[name=_token]').val(),
           },
           success: function(data) {
               $('.itemEvent' + id).remove();
           }
       });
   });