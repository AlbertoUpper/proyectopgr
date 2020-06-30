<?php
	include 'plantillaC.php';
	require 'conexion.php';
	$con = conectar();
	$query = "call proc_mostrarCategorias ()";
	$resultado = mysqli_query($con,$query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(65);
	$pdf->Cell(30,6,'ID',1,0,'C',1);
	$pdf->Cell(60,6,'Nombre',1,1,'C',1);
	
	
	$pdf->SetFont('Arial','',10);
	
	while($row = mysqli_fetch_array($resultado))
	{
		$pdf->SetX(65);
		$pdf->Cell(30,8,$row['id_categoria'],1,0,'C');
		$pdf->Cell(60,8,ucfirst($row['nombre_categoria']),1,1,'C');
	}
	$pdf->Output();
?>