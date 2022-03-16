<?php
$server="localhost";
$user="root";
$pass="";
$bd="db_minimarket";

//instancia de la libreria para hacer conexiones

$conex=new mysqli($server,$user,$pass,$bd);

//$sql="select * from tb_usuario";
//
//
//$result=$conex->query($sql);
//
//foreach($result as $fila)
//{
//    echo"<pre>";
//    print_r($fila);
//    echo"</pre>";
//}
//$conex->close();



//////verificar la conexion
//
//if(mysqli_connect_errno())
//    die("Error de Conexión.". mysqli_connect_error());
//else
//    die("Conexión Establecida: Paico Falero Gustavo");

function toBase64($imgData) {   

 //   $file_name =$_FILES['image']['tmp_name'];

    $file_tmp= $imgData['tmp_name'];

    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    if(!empty($file_tmp)){
      $data = file_get_contents($file_tmp);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);  
    }else{
        $base64 = 'data:image/;base64,';
    }
    
   //  print_r($errors);

    return $base64;
}