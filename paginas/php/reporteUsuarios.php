<?php
	include 'plantillaU.php';
	require 'conexion.php';
	$con = conectar();
	$query = "call proc_mostrarUsuarios()";
	$resultado = mysqli_query($con,$query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,6,'ID',1,0,'C',1);
	$pdf->Cell(25,6,'Nombre',1,0,'C',1);
	$pdf->Cell(25,6,'Apellido',1,0,'C',1);
	$pdf->Cell(20,6,'Usuario',1,0,'C',1);
	$pdf->Cell(30,6,'Departamento',1,0,'C',1);
	$pdf->Cell(20,6,'Telefono',1,0,'C',1);
	$pdf->Cell(45,6,'Correo',1,0,'C',1);
	$pdf->Cell(13,6,'Tipo',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = mysqli_fetch_array($resultado))
	{
		$pdf->Cell(10,8,$row['id_usuario'],1,0,'C');
		$pdf->Cell(25,8,ucfirst($row['nombre_usuario']),1,0,'C');
		$pdf->Cell(25,8,ucfirst($row['apellido_usuario']),1,0,'C');
		$pdf->Cell(20,8,$row['usuario'],1,0,'C');
		$pdf->Cell(30,8,ucfirst($row['departamento']),1,0,'C');
		$pdf->Cell(20,8,$row['telefono'],1,0,'C');
		$pdf->Cell(45,8,$row['correo'],1,0,'C');
		$pdf->Cell(13,8,$row['tipo'],1,1,'C');
	}
	$pdf->Output();
?>