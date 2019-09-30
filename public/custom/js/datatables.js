$(document).ready(function() {

    configurationDatatable = {
    dom: //'Bfrtip',
         "<'row'<'form-inline' <'col-sm-offset-5'B>>>"
        +"<'row'<'form-inline' <'col-sm-1'f>>>"
        +"<rt>"
        +"<'row'<'form-inline'"
        +"<'col-sm-6 col-md-6 col-lg-6'l>"
        +"<'col-sm-6 col-md-6 col-lg-6'p>>>",
    buttons: [
        {
            text: "<i class='glyphicon glyphicon-plus'></i> New Event",
            titleAttr: 'Create new Event',
            className: 'btn btn-primary',
            action: function ( e, dt, node, config ) {
                window.location = 'events/create';
            }
        },
        {
            extend: 'excelHtml5',
            text: "<i>XLSX</i>",
            titleAttr: 'Export Excel',
            title: 'List today events',
            exportOptions: {
                columns: [ 0, 1, 2, 3]
            }
        },
        {
            extend: 'print',
            text: "<i>Print</i>",
            titleAttr: 'Print',
            messageTop: 'We have for today.',
            title: 'List today events',
            exportOptions: {
                columns: [ 0, 1, 2, 3]
            },
        }
        ]
    } 
    
    $('#todayEvents').DataTable(configurationDatatable);
    $('#nextFiveEvents').DataTable(configurationDatatable);
    $('#allEvents').DataTable(configurationDatatable);

} );