<?php 
require "fpdf.php";

$rec_id = 0;
if(isset($_GET['id']))
{
	$rec_id = $_GET['id'];
}

$db = new PDO('mysql:host=localhost;dbname=guidelin_kazifashion_house','guidelin_kazifashoin_house_website','Total@1010');

class myPDF extends FPDF{
    function header(){
       $this->image('logo.png',10,6);
        $this->SetFont('Arial','B',18);
        $this->Cell(300,5,'Kazi Fashion',0,0,'C');
        $this->Ln();
        $this->Ln();
        $this->SetFont('Arial','B',12);
		$this->Cell(0,5,'Address: 57, Distrilary Road, Gandaria, Dhaka',0,0,'R');
        $this->Ln();
        $this->Cell(0,5,'Contact: 01977868411,01977868484',0,0,'R');
        $this->Ln();
        $this->Cell(0,5,'Email: totalbazarbd@gmail.com',0,0,'R');
        $this->Ln(10);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
	
function customerviewAddress($db){
		global $rec_id;
        $this->SetFont('Arial','',10);
        $stmt = $db->query('SELECT orders.created, orders.id, customer_registration.full_name, customer_registration.address,customer_registration.customer_area,customer_registration.phone FROM orders JOIN customer_registration ON orders.customer_id=customer_registration.id and orders.id = '.$rec_id);
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
		$this->SetFont('Arial','B',10);
			$this->Cell(0,5,'Shipping Info: ',1,0,'C');			
			$this->Ln();
			$this->Cell(22,5,'Full Name: ',0,0,'L');
            $this->Cell(0,5,$data->full_name,0,0,'L');
			$this->Ln();
            $this->Cell(22,5,'Address: ',0,0,'L');
			$this->Cell(0,5,$data->address,0,0,'L');
			$this->Ln();
		    $this->Cell(22,5,'Area: ',0,0,'L');
            $this->Cell(0,5,$data->customer_area,0,0,'L');
			$this->Ln();
			$this->Cell(22,5,'Phone: ',0,0,'L');
            $this->Cell(0,5,$data->phone,0,0,'L');
			$this->Ln();
			$this->Cell(22,5,'Order Date:',0,0,'L');
            $this->Cell(0,5,$data->created,0,0,'L');
            $this->Ln();
            $this->Cell(22,5,'Order ID:',0,0,'L');
            $this->Cell(0,5,$data->id,0,0,'L');
			$this->Ln();
        }
    }
	
    function headerTable(){
        $this->SetFont('Arial','B',9);
        // $this->Cell(20,8,'Order ID',1,0,'C');
        $this->Cell(135,6,'Item Name',1,0,'C');
        //$this->Cell(20,8,'Unit',1,0,'C');
        $this->Cell(20,6,'Rate',1,0,'C');
		$this->Cell(20,6,'QTY',1,0,'C');
		$this->Cell(20,6,'Price',1,0,'C');
        $this->Ln();
		
    }
    function viewTable($db){
	
		global $rec_id;
	
		//$productID = $_REQUEST['id'];
		 
        $this->SetFont('Arial','',9);
        $stmt = $db->query('SELECT orders.id as ordid, products.id,products.products_name,products.quantity,order_items.product_price,order_items.quantity as qty,order_items.product_price*order_items.quantity as total FROM orders join order_items on orders.id = order_items.order_id JOIN products on order_items.product_id= products.id where order_items.order_id='.$rec_id);
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            //$this->Cell(20,8,$data->ordid,1,0,'C');
            $this->Cell(135,6,$data->products_name,1,0,'L');
            //$this->Cell(20,8,$data->quantity,1,0,'C');
            $this->Cell(20,6,$data->product_price,1,0,'C');
			$this->Cell(20,6,$data->qty,1,0,'C');
			$this->Cell(20,6,$data->total,1,0,'C');
            $this->Ln();

        }
    }
	
function customerviewProductPrice($db){
		global $rec_id;
		
        $this->SetFont('Arial','',9);
        $stmt = $db->query('SELECT orders.sub_total_price,orders.shipping_cost,orders.discount_amount, orders.total_price,orders.payment_method FROM `orders` WHERE id='.$rec_id);
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
					$this->Ln();
			$this->SetFont('Arial','B',9);
			$this->Cell(175,6,'Subtotal: ',0,0,'R');
            $this->Cell(0,6,$data->sub_total_price.' TK',0,0,'R');
			$this->Ln();
            $this->Cell(175,6,'Shipping Cost: ',0,0,'R');
			$this->Cell(0,6,$data->shipping_cost.' TK',0,0,'R');
			$this->Ln();
			$this->Cell(175,6,'Discount: ',0,0,'R');
            $this->Cell(0,6,$data->discount_amount.' TK',0,0,'R');
			$this->Ln();
			$this->Cell(175,6,'Grand Total: ',0,0,'R');
            $this->Cell(0,6,$data->total_price,0,0,'R');
			$this->Ln();
			//$this->Cell(150,9,'Payment method: Cash On Delivery',0,0,'L');
			//$this->Cell(80,10,$data->phone,0,0,'L');
			$this->Ln();
			$this->Cell(80,10,'Authorized by',0,0,'L');
			$this->Cell(80,10,'Received by',80,0,'L');
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