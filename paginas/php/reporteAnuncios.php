<?php
	include 'plantillaA.php';
	require 'conexion.php';
	$con = conectar();
	$query = "call proc_mostrarAnunciosBusqueda('')";
	$resultado = mysqli_query($con,$query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,7,'ID',1,0,'C',1);
	$pdf->Cell(35,7,'Nombre',1,0,'C',1);
	$pdf->Cell(18,7,'precio',1,0,'C',1);
	$pdf->Cell(35,7,'Categoria',1,0,'C',1);
	$pdf->Cell(35,7,'Sub Cat.',1,0,'C',1);
	$pdf->Cell(20,7,'Usuario',1,0,'C',1);
	$pdf->Cell(38,7,'Publicacion',1,1,'C',1);
	
	
	$pdf->SetFont('Arial','',10);
	while($row = mysqli_fetch_array($resultado))
	{
		$pdf->Cell(10,8,$row['id_anuncio'],1,0,'C');
		$pdf->Cell(35,8,ucfirst($row['nombre_anuncio']),1,0,'C');
		$pdf->Cell(18,8,"$".$row['precio_anuncio'],1,0,'C');
		$pdf->Cell(35,8,ucfirst($row['nombre_categoria']),1,0,'C');
		$pdf->Cell(35,8,ucfirst($row['nombre_subCategoria']),1,0,'C');
		$pdf->Cell(20,8,$row['usuario'],1,0,'C');
		$pdf->Cell(38,8,$row['publicacion'],1,1,'C');
		
	}
	

	$pdf->Output();
?>