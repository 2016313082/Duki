$(document).ready(function() {
    cargar_tags();
    //$('.js-example-basic-multiple').select2();
    var cont ='';
    $.ajax({
        'url':base_url+'Tags/ver_datos',
        'datatype':'json',
        'success':function(obj){
            $('#tags').html(''); 
            //console.log(obj);
            cont+='<option disabled selected> Selecciona algún tag </option>'

            $.each(obj, function(i, elemento){
                cont+='<option value='+elemento.Tag.Id+'>'+elemento.Tag.nombre+'</option>'  
                    //console.log(elemento.Tag.nombre);
                    
                    });
                    $('#tags').append(cont);
        }
    })

    $('#tags').on('change', function (){
        var id_tag = $(this).val();

        $.ajax({
            'url':base_url+'Tags/argegaTP',
            'type' : 'post',
            'data' : {'producto_id':id_producto,
            'tag_id':id_tag},
            'datatype':'json',
            'success':function(obj){
                //console.log(obj);
                if(obj==true){
                   cargar_tags();     
                }
            }
        })
    })
});

function cargar_tags(){
    var cont ='';

    $.ajax({
        'url':base_url+'Tags/crear_tags',
        'type':'post',
        'data':{'producto_id': id_producto},
        'datatype':'json',
        'success':function(obj){
            //$('#etiquetas').html(''); 
            //console.log(obj[0].tags_productos);
            cont+='<span></span>';

            $.each(obj, function(i, elemento){
                //console.log(elemento);
                cont+='<span class="badge badge-pill badge-success"> '+elemento.tags.nombre+' <a onclick="delete_tag('+elemento.tags_productos.id+')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></span>' 
                console.log(elemento.tags_productos.id );

            });
            $('#etiquetas').html(cont);


        }
    })

}

function delete_tag(id){
    //alert(id);
    $.ajax({
        'url': base_url+'Tags/borrar_tag',
        'type': 'post',
        'data':{'id': id},
        'datatype': 'json',
        'success': function(obj){
            console.log(obj);
            cargar_tags();
        }
    })
}