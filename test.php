<?php
    session_start();
    require ('config/fpdf/fpdf.php');
    require ('config/config.php');

    $orders = $_SESSION['order'];
    $items = $_SESSION['items'];
    $headerOrder = array('Invoice #', 'Name', 'Phone No.', 'Total Price');
    $headerItem = array('Name', 'Rate', 'Quantity', 'Total');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Order Details:');
    $pdf->Ln();
    // Header
    foreach($headerOrder as $col)
        $pdf->Cell(40,7,$col,1);
    $pdf->Ln();
    // Data
    foreach($orders as $row)
    {
        $pdf->Cell(40,6,$row,1);
    }
    $pdf->Ln();
    // Items Details
    $pdf->Cell(40,10,'Items Details:');
    $pdf->Ln();
    foreach($headerItem as $col)
        $pdf->Cell(40,7,$col,1);
    $pdf->Ln();
    // Data
    foreach($items as $row)
    {
        foreach($row as $col)
            $pdf->Cell(40,6,$col,1);
        $pdf->Ln();
    }
    $pdf->Output();
?>