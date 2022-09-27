function cargar_datos() {
    var cont='';
    $('#tabla_tags').html(''); 

    $.ajax({
        'url':base_url+'Tags/ver_datos',
        'datatype':'json',
        'success':function(obj){ 
            console.log(obj);
            $.each(obj, function(i, elemento){
            cont+='<tr>'+
            '<td>'+elemento.Tag.Id+'</td>'+
            '<td>'+elemento.Tag.nombre+'</td>'+
            '<td><button onclick="edit_row('+elemento.Tag.Id+')" class="btn btn-primary fa fa-pencil-square-o" aria-hidden="true" data-togle="modal"></button>'+
            //'<button class="btn btn-danger" onclick="Delete(<?=$tag["Tag"]["Id"]?>)" >eliminar</button>'

            '<button onclick="deleteT('+elemento.Tag.Id+')" class="btn btn-danger fa fa-trash-o" aria-hidden="true"></button></td>'+
            '<tr>';
            console.log(elemento.Tag.Id);
            });
            $('#tabla_tags').append(cont);
        }
    })
}

var tabla;
var columnas = [];
$(document).ready(function(){

    cargar_datos();
    //edit_row();
    $('#agregar').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            'url': base_url+'Tags/add_tag',
            'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype':'json',
            'success':function(obj){
                console.log(obj);
                if(obj==true){
                    
                    swal.fire({
                        'icon':'success',
                        'title':'agregado correctamente',
                        //$('#ModalAgregar').modal('close');
                    })
                    
                }
                
                $('#tabla_tags').html(''); 
                cargar_datos();              
                $('#nombre').val('');
            

            }
        })

    })

        $('#editar').on('submit', function(e){
            e.preventDefault();
            
        $.ajax({
            'url':base_url+'Tags/edit',
            'type' : 'post',
            'data' : new FormData(this),
            'contentType': false,
            'cache': false,
            'processData': false,
            'datatype':'json',
            'success':function(obj){
                console.log(obj);
                if(obj==true){
                    swal.fire({
                        'icon':'success',
                        'title':'actualizado correctamente',
                    })
                    
                    
            }
            $('#modalEdit').modal('hide');
                    $('#tabla_tags').html('');
                    cargar_datos();
            }
        })

    })

});

function deleteT(Id){
    $.ajax({
        'url': base_url+'Tags/delete',
        'type': 'post',
        'data':{'Id':Id},
        'datatype': 'json',
        'success': function(obj){
            console.log(obj);
            if(obj==true){
                swal.fire({
                    'icon':'success',
                    'title':'Borrado correctamente',
                })
                
            }
            $('#tabla_tags').html('');
                cargar_datos();
        }
    })
}

function edit_row(Id){
    $('#modalEdit').modal('show');
    $.ajax({
        'url': base_url+'Tags/ver_datos2',
        'type': 'post',
        'data':{'Id':Id},
        'datatype': 'json',
        'success': function(obj){
            //console.log(obj);
                $('#IdEdit').val(obj[0].Tag.Id); 
                console.log(obj[0].Tag.nombre);  
                $('#nombreEdit').val(obj[0].Tag.nombre);       

        }
        
    })
}

//inicializacion de datatable para una tabla con el id tabla_tags
   /*  tabla = $('#tabla_tags').DataTable({

        "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         true,
        responsive: true,
        order: [[1,"asc"]],
        "language" : {
            "url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        }
    });

    $('#tabla_tags thead tr th').each(function(){
        columnas.push($(this).html());
    }); */