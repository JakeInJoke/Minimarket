$(function()
{
    $('#btn_add').on('click',function()
        {
//            alert("Holaaa");
           //limpiar controles de la ventana
//            $('#add_project')[0].reset();            
           
            //indicar la accion
//            $('#Accion').val('insertar');//campo oculto
//            $('#InputID').val('0');
           //abrir la ventana modal
            $('#add_project').modal(
            {
                show: true,
                backdrop: 'static'
            }
            );
        });
}
);