<?php
$db = new PDO('mysql:host=localhost;dbname=guidelin_kazifashion_house','guidelin_kazifashoin_house_website','Total@1010');
if(isset($_GET['id']))
{
	$rec_id = $_GET['id'];
}
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'bn','default_font'=>'Nikosh']);
$mpdf->WriteHTML('');
    $mpdf->image('logo.png',10, 20, 60, 30, 'png', '1');
   // $mpdf->SetFont('Arial','B',18);
    $mpdf->Cell(300,5,'Kazi Fashion',0,0,'C');
    $mpdf->Ln();
    $mpdf->Ln();
   // $mpdf->SetFont('Arial','B',12);
	$mpdf->Cell(0,5,'Address: 57, Distrilary Road, Gandaria, Dhaka',0,0,'R');
    $mpdf->Ln();
    $mpdf->Cell(0,5,'Contact: 01977868411,01977868484',0,0,'R');
    $mpdf->Ln();
    $mpdf->Cell(0,5,'Email: totalbazarbd@gmail.com',0,0,'R');
    $mpdf->Ln(10);
    
    //body
    $stmt = $db->query('SELECT orders.created, orders.id, customer_registration.full_name, customer_registration.address,customer_registration.customer_area,customer_registration.phone FROM orders JOIN customer_registration ON orders.customer_id=customer_registration.id and orders.id = '.$rec_id);
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
	      //  $mpdf->SetFont('Arial','B',10);
			$mpdf->Cell(0,5,'Shipping Info: ',1,0,'C');			
			$mpdf->Ln();
			$mpdf->Cell(22,5,'Full Name: ',0,0,'L');
            $mpdf->Cell(0,5,$data->full_name,0,0,'L');
			$mpdf->Ln();
            $mpdf->Cell(22,5,'Address: ',0,0,'L');
			$mpdf->Cell(0,5,$data->address,0,0,'L');
			$mpdf->Ln();
		    $mpdf->Cell(22,5,'Area: ',0,0,'L');
            $mpdf->Cell(0,5,$data->customer_area,0,0,'L');
			$mpdf->Ln();
			$mpdf->Cell(22,5,'Phone: ',0,0,'L');
            $mpdf->Cell(0,5,$data->phone,0,0,'L');
			$mpdf->Ln();
			$mpdf->Cell(22,5,'Order Date:',0,0,'L');
            $mpdf->Cell(0,5,$data->created,0,0,'L');
            $mpdf->Ln();
            $mpdf->Cell(22,5,'Order ID:',0,0,'L');
            $mpdf->Cell(0,5,$data->id,0,0,'L');
			$mpdf->Ln();
        }
        
       // $mpdf->SetFont('Arial','B',9);
        $mpdf->Cell(120,6,'Item Name',1,0,'C');
        $mpdf->Cell(20,6,'Rate',1,0,'C');
		$mpdf->Cell(20,6,'QTY',1,0,'C');
		$mpdf->Cell(20,6,'Price',1,0,'C');
        $mpdf->Ln();
    
        //$mpdf->SetFont('Nikosh','R',9);
        $stmt = $db->query('SELECT orders.id as ordid, products.id,products.products_name,products.quantity,order_items.product_price,order_items.quantity as qty,order_items.product_price*order_items.quantity as total FROM orders join order_items on orders.id = order_items.order_id JOIN products on order_items.product_id= products.id where order_items.order_id='.$rec_id);
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $mpdf->Cell(120,6,$data->products_name,1,0,'L');
            $mpdf->Cell(20,6,$data->product_price,1,0,'C');
			$mpdf->Cell(20,6,$data->qty,1,0,'C');
			$mpdf->Cell(20,6,$data->total,1,0,'C');
            $mpdf->Ln();
        }    
    
$mpdf->Output();
