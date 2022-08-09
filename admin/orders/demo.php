<?php 
require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=totalbazarbd','root','');

class myPDF extends FPDF{
 //   function header(){
 //       $this->image('logo.png',10,6);
 //       $this->SetFont('Arial','B',14);
 //       $this->Cell(276,5,'Invoice Customer Copy',0,0,'C');
 //       $this->Ln();
	//	$this->Ln();
 //       $this->SetFont('Times','',18);
 //       $this->Cell(276,10,'Moshla Bazar',0,0,'C');
 //       $this->Ln(20);
 //   }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
	
    function customerviewAddress($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('SELECT orders.created, Orders.id, customer_registration.full_name, customer_registration.address,customer_registration.customer_area,customer_registration.phone FROM Orders INNER JOIN customer_registration ON Orders.customer_id=customer_registration.id and customer_registration.id=1 and orders.id = 25');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->SetFont('Times','B',10);
			$this->Cell(120,10,'Ship To: ',1,0,'C');			
			$this->Ln();
			$this->Cell(40,10,'Full Name: ',0,0,'L');
            $this->Cell(80,10,$data->full_name,0,0,'L');
			$this->Ln();
            $this->Cell(40,10,'Address: ',0,0,'L');
			$this->Cell(600,10,$data->address,0,0,'L');
			$this->Ln();
			$this->Cell(40,10,'Area: ',0,0,'L');
            $this->Cell(80,10,$data->customer_area,0,0,'L');
			$this->Ln();
			$this->Cell(40,10,'Phone: ',0,0,'L');
            $this->Cell(80,10,$data->phone,0,0,'L');
			$this->Ln();
			$this->Cell(40,10,'Order Date',0,0,'L');
            $this->Cell(80,10,$data->created,0,0,'L');
            $this->Ln();
			//$this->Ln();
        }
    }
	
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'ID',1,0,'C');
        $this->Cell(60,10,'Item Name',1,0,'C');
        $this->Cell(30,10,'Unit',1,0,'C');
        $this->Cell(35,10,'Item Qty',1,0,'C');
        $this->Cell(35,10,'Item Price',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('SELECT Orders.id, products.products_name, products.quantity as qty, order_items.quantity, products.price, orders.total_price FROM Orders INNER JOIN customer_registration ON Orders.customer_id=customer_registration.id and customer_registration.id=1 and orders.id =25 INNER JOIN order_items ON orders.id = order_items.id INNER JOIN products ON products.id = order_items.product_id');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->id,1,0,'C');
            $this->Cell(60,10,$data->products_name,1,0,'C');
            $this->Cell(30,10,$data->qty,1,0,'C');
			$this->Cell(35,10,$data->quantity,1,0,'C');
            $this->Cell(35,10,$data->price.' TK',1,0,'C');
            $this->Ln();
			//$this->Ln();
        }
    }
	
	function customerviewProductPrice($db){
        $this->SetFont('Times','',10);
        $stmt = $db->query('SELECT orders.created, Orders.id, customer_registration.full_name, customer_registration.address,customer_registration.customer_area,customer_registration.phone FROM Orders INNER JOIN customer_registration ON Orders.customer_id=customer_registration.id and customer_registration.id=1 and orders.id = 25');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->SetFont('Times','B',10);
			$this->Cell(25,10,'Product Price: ',0,0,'L');
            $this->Cell(80,10,$data->full_name,0,0,'L');
			$this->Ln();
            $this->Cell(25,10,'Shipping: ',0,0,'L');
			$this->Cell(80,10,$data->address,0,0,'L');
			$this->Ln();
			$this->Cell(25,10,'Coupon: ',0,0,'L');
            $this->Cell(80,10,$data->customer_area,0,0,'L');
			$this->Ln();
			$this->Cell(25,10,'Total: ',0,0,'L');
            $this->Cell(80,10,$data->phone,0,0,'L');
			$this->Ln();
			$this->Cell(150,10,'Payment method: Cash On Delivery',0,0,'L');
			$this->Ln();

			$this->Cell(450,10,'I certify that i have recieved the item mentioned above in good condition',0,0,'L');
			$this->Ln();
			$this->Ln();
			$this->Cell(100,10,'Customer Signature',0,0,'L');
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->customerviewAddress($db);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->customerviewProductPrice($db);
$pdf->Output();