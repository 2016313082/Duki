$(document).ready(function(){
    var contUsuarios = 0;
    $.ajax({
        url : base_url + 'usuarios/traer_datos',
        datatype : 'json',
        success : function(obj){
            $.each(obj, function(i,elemento){
                contUsuarios++;
            });
            $('#contador_usuarios').text(contUsuarios);
        }
    })
})