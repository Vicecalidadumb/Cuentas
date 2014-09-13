function get_city(id1, id2) {
    $.ajax({
        data: "id1="+id1+"&id2="+id2,
        type: "POST",
        dataType: "html",
        url: base_url_js + "user/get_citys",
        success: function(data) {
            $("#space_"+id2).html(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar los municipios")
        },
        async: true
    });
}