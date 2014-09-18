function get_city(id1, id2) {
    $.ajax({
        data: "id1=" + id1 + "&id2=" + id2,
        type: "POST",
        dataType: "html",
        url: base_url_js + "user/get_citys",
        success: function(data) {
            $("#space_" + id2).html(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar los municipios")
        },
        async: true
    });
}


$(document).ready(function() {
    $('#calendar_umb').fullCalendar({
        theme: true,
        startParam: 'start',
        endParam: 'end',
        defaultView: 'month',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        events: {
            url: base_url_js + "/contract/get_schedule_json",
            cache: true
        },
        loading: function(bool) {
            if (bool)
                $('#loading').show();
            else
                $('#loading').hide();
        }
    });
})
