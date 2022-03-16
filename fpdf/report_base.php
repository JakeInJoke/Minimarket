<?php
include('fpdf.php');

class PDF extends FPDF
{
    private string $extra;

    function __construct($extra = '')
    {
        parent::__construct();
        if (!empty($extra)) {
            $this->extra = ' DE ' . strtoupper($extra);
        }
    }

    function Header()
    {
        // Logo
        //$this->Image('', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 17);
        // Movernos a la derecha
        $this->Cell(70);
        // Título
        $this->Cell(w: 60, h: 10, txt: utf8_decode('REPORTE' . $this->extra), align: 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function ChapterBody()
    {
    }
}
