$(document).ready(function () {
    //reconocer el evento del boton:click
    $('#btn-login').on('click', function ()
    {
        var login = $('#InputLogin').val();
        if (login.length == 0)
        {
            $('#msg').html('<div class="alert alert-warning" role="alert">Ingrese el Login</div>').show(500).delay(1000).hide(500);
            $('#InputLogin').focus();//colocar el foco
            return false;
        }
        
        var pass = $('#InputPassword').val();
        if (pass.length == 0)
        {
            $('#msg').html('<div class="alert alert-warning" role="alert">Ingrese el Password</div>').show(500).delay(1000).hide(500);
            $('#InputPassword').focus();//colocar el foco
            return false;
        }       
        //envio de datos
        //definir a donde enviamos los datos
        var ruta="../php/iniciosesion.php";
        //envio de datos con ajax
        $.ajax({
            type:'POST',
            url:ruta,
            data:'InputLogin='+login+'&InputPassword='+pass,//enviando datos
            success:function(data)
            {
                //alert(data);
                //Redireccionamos
                if (data=='valid')
                {
                    //ir a la pagina principal de administrador
                    document.location.href='../admin/index.php';
                }     
                else
                {
                    $('#msg').html('<div class="alert alert-danger" role="alert">Datos Incorrectos</div>').show(500).delay(1000).hide(500);
                    $('#InputLogin').focus();//colocar el foco
                }
            }
        });  
    }
    );
}
);

