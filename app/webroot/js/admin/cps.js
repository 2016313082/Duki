function cargar_datos(){
    var cont='';
    $('#tabla_cps').html('');

    $.ajax({
        'url':base_url+'Cps/ver_datos',
        'datatype':'json',
        'success':function(obj){
            console.log(obj);
            tabla.clear().draw();
            $.each(obj, function(i, elemento){

                var nuevaFila = tabla.row.add([
                    elemento.Cp.id,
                    elemento.Cp.cp,
                    elemento.Cp.colonia,
                    elemento.Cp.municipio,
                    elemento.Cp.estado,
                    '<button onclick="edit_row('+elemento.Cp.id+')"class="btn btn-primary fa fa-pencil-square-o" aria-hidden="true" data-togle="modal"></button>'+
                    '<button onclick="deleteC('+elemento.Cp.id+')"class="btn btn-danger fa fa-trash-o" aria-hidden="true"></button>'
                ]).draw().node();
                $('td',nuevaFila).each(function(index,td){
                    $(td).attr('data-label',columnas[index]);
                });
            });
            $('#tabla_cps').append(cont);
        }
    })
}

var columnas = [];
var tabla;

$(document).ready(function(){

    tabla = $('#tabla_cps_data').DataTable({
		responsive: true,
		order: [[1, "asc"]],
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		},
        "scrollY":"300px",
        "scrollCollapse": true
	});
    
    cargar_datos();

    $('#agregar').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            'url':base_url+'Cps/add_cp',
            'type':'post',
            'data': new FormData(this),
            'contentType': false,
            'cache':false,
            'processData': false,
            'datatype':'json',
            'success': function(obj){
                console.log(obj);
                if(obj == true){
                    swal.fire({
                        'icon':'success',
                        'title':'agregado correctamente',
                    })
                }
                $('#tabla_cps').html('');
                $('#agregar').trigger("reset");
                cargar_datos();
            }
        })
    })

    $('#editar').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            'url':base_url+'Cps/edit',
            'type':'post',
            'data':new FormData(this),
            'contentType':false,
            'cache':false,
            'processData':false,
            'datatype':'json',
            'success': function(obj){
                console.log(obj);
                if(obj==true){
                    swal.fire({
                        'icon':'success',
                        'title':'actualizado correctamente',
                    })
                }
                $('#modalEdit').modal('hide');
                $('#tabla_cp').html('');
                cargar_datos();
            }
        })
    })
    
});

function deleteC(id){
    $.ajax({
        'url':base_url+'Cps/delete',
        'type':'post',
        'data':{'id':id},
        'datatype':'json',
        'success': function(obj){
            console.log(obj);
            if(obj == true){
                swal.fire({
                    'icon':'success',
                    'title':'Borrado correctamente',
                })
            }
            $('#tabla_cps').html('');
            cargar_datos();
        }
    })
}

function  edit_row(id){
    $('#modalEdit').modal('show');
    $.ajax({
        'url':base_url+'Cps/ver_datos_2',
        'type':'post',
        'data':{'id':id},
        'datatyppe':'json',
        success: function(obj){
            console.log(obj);
            $('#idEdit').val(obj[0].Cp.id);
            console.log(obj[0].Cp.id)
            $('#cpEdit').val(obj[0].Cp.cp);
            console.log(obj[0].Cp.cp);
            $('#coloniaEdit').val(obj[0].Cp.colonia);
            console.log(obj[0].Cp.colonia);
            $('#municipioEdit').val(obj[0].Cp.municipio);
            console.log(obj[0].Cp.municipio);
            $('#estadoEdit').val(obj[0].Cp.estado);
            console.log(obj[0].Cp.estado);
        }
    })
}