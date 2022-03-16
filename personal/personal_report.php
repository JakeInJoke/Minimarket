<?php
require('../fpdf/report_base.php');
include('../Conexion_BD/Conexion.php');
session_start();

$sql = "SELECT e.cod_empleado,e.nombre_empleado,e.apellidop_empleado,e.apellidom_empleado,e.telefono,e.direccion_empleado,e.dni,r.nombre_rol,c.nombre_contrato,c.descripcion
        FROM empleado e
        INNER JOIN rol r
        ON e.cod_rol_empleado = r.cod_rol_empleado
        INNER JOIN tipo_contrato c
        ON e.cod_tipo_contrato = c.cod_tipo_contrato
        ORDER BY e.cod_empleado ASC";
//ejecutar la consulta
//$result = mysqli_query($conex, $sql);
$result = $conex->query($sql);


// Creación del objeto de la clase heredada


date_default_timezone_set('America/Lima');


$pdf = new PDF('PERSONAL');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(0, 10, ' ', 0, 1);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Fecha del reporte:'), 0, 1);
$pdf->SetFont('Courier', '', 12);
$pdf->Cell(0, 10, utf8_decode(date("F j, Y, g:i a")), 0, 1);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Reporte generado por: '), 0, 1);
$pdf->SetFont('Courier', '', 12);
$pdf->Cell(0, 10, utf8_decode($_SESSION['user_data']['nombre_empleado'] . ' ' . $_SESSION['user_data']['apellidop_empleado'] . ' ' . $_SESSION['user_data']['apellidom_empleado']), 0, 1);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Rol del empleado: '), 0, 1);
$pdf->SetFont('Courier', '', 12);
$pdf->Cell(0, 10, utf8_decode($_SESSION['rol']), 0, 1);
$pdf->Cell(0, 10, ' ', 0, 1);
$pdf->SetFont('Courier', '', 12);


while ($rows = mysqli_fetch_array($result)) {
    $pdf->SetFont('Courier', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('CODIGO DE EMPLEADO: ' . $rows["cod_empleado"] . '     ROL: ' . $rows["nombre_rol"]), 1, 1);
    $pdf->Cell(0, 10, utf8_decode('TIPO DE CONTRATO: ' . $rows["nombre_contrato"] . '     DESCRIPCION CONTRATO: ' . $rows["descripcion"]), 0, 1);
    $pdf->SetFont('Courier', '', 12);
    $pdf->Cell(0, 10, utf8_decode('NOMBRE:' . $rows["nombre_empleado"]), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('APELLIDO PATERNO: ' . $rows["apellidop_empleado"] . '     APELLIDO MATERNO: ' . $rows["apellidom_empleado"]), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('DOCUMENTO DE IDENTIDAD: ' . $rows["dni"]), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('DIRECCION: ' . $rows["direccion_empleado"]), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('TELEFONO: ' . $rows["telefono"]), 0, 1);
    $pdf->Cell(0, 10, ' ', 0, 1);
}

$pdf->Output();
