//$(function()
//{
//    alert("Buenos Dias");
//});

/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    //reconocer el evento del boton:click
    $('#btn_add').on('click',function()
    {
        //limpiar controles de la ventana
        $('#frmEditorial')[0].reset();
        //escribir en la caja de texto
        $('#Operacion').val("insert");
        $('#InputID').val("0");
        //alert("Buenos Dias");
        $('#add_editorial').modal(
            {
                show: true,
                backdrop: 'static'
            }
        );
    }
    );
    
    //filtro de la tabla
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});

function guardarEditorial()
{
    //alert("Buen dia");
    //Validar los campos obligatorios
    var nombre=$('#InputNombre').val();
    if (nombre.length == 0)
    {
        $('#msg').html('<div class="alert alert-warning" role="alert">Ingrese el Nombre</div>').show(500).delay(1000).hide(500);
        $('#InputNombre').focus();//colocar el foco
        return false;
    }
    
    var telf=$('#InputTelefono').val();
    if (telf.length == 0)
    {
        $('#msg').html('<div class="alert alert-warning" role="alert">Ingrese el Nro Telefonico</div>').show(500).delay(1000).hide(500);
        $('#InputTelefono').focus();//colocar el foco
        return false;
    }
    //ENVIO DE DATOS DEL FORMULARIO CON AJAX JQuery
    var ruta="../php/editorialInsert.php";
    $.ajax(
        {
            type: 'POST',
            url: ruta,
            data: $('#frmEditorial').serialize(),
            success:function(data)
            {
                //mostrar mensaje de exito
                if ($('#Operacion').val()=='insert')
                {
                    $('#msg').html('<div class="alert alert-success" role="alert">Se Insertó OK</div>').show(500).delay(2000).hide(500);
                    //limpiar controles de la ventana
                    $('#frmEditorial')[0].reset();
                    //escribir en la caja de texto
                    $('#Operacion').val("insert");
                }
                else
                {
                    $('#msg').html('<div class="alert alert-success" role="alert">Actualización OK</div>').show(500).delay(2000).hide(500);
                }
                //escribir html
                $('#rowsEditorial').html(data);      
            }
        }
    );    
    return false;
}

//=========================================================================
function recuperarFilaEliminar(idEditorial)
{
    //pregunta
    var pregunta=confirm('¿Seguro de Eliminar?');
    if (pregunta==true)
    {
        // alert("hola vas a eliminar a: "+idEditorial);
        //definir a donde enviamos los datos
        var ruta="../php/editorialInsert.php";
        //definir accion
        var accion="delete";
        //envio de datos con ajax
        $.ajax({
            type:'POST',
            url:ruta,
            data:'Operacion='+accion+'&InputID='+idEditorial,//enviando datos
            success:function(data)
            {
                //alert(data);
                //escribir html
                $('#rowsEditorial').html(data);       
            }
        });  
    }
    return false;
}

//funcion que permite enviar al id de consulta e imprime los datos devueltos
//en la ventana modal
function recuperarFilaEditar(idEditorial)
{
    //alert("hola: "+idEdi);
    //definir a donde enviamos los datos
    var ruta="../php/editorialInsert.php";
    //definir accion
    var accion="selectByID";
    //envio de datos con ajax
    $.ajax({
        type:'POST',
        url:ruta,
       data:'Operacion='+accion+'&InputID='+idEditorial,//enviando datos
        success:function(data)
        {
          //  alert(data);
            //recibir los datos q estan en formato JSON
            var campos=eval(data);
//            //limpiamos los datos del formulario
            $('#frmEditorial')[0].reset();
//            //asignamos los datos de la variable campos a los controles
//            //indicar la accion
            $('#Operacion').val('update');            
            $('#InputID').val(campos[0]);
            $('#InputNombre').val(campos[1]);
            $('#InputDireccion').val(campos[2]);
            $('#InputTelefono').val(campos[3]);
            $('#InputPagina').val(campos[4]);
            //checkbox
            if (campos[5]==1)
                $('#InputEstado').prop("checked",true);
            else
                $('#InputEstado').prop("checked",false);
//            
//            //cargar el combo de categorias
//           
//            $('#inputCategoria').val(campos[5]);
// 
            //abrir la ventana modal
            $('#add_editorial').modal(
            {
                show: true,
                backdrop: 'static'
            }
            );          
        }
    });  
    return false;
}

