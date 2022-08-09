<?php 
require "fpdf.php";


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
	
	
    function headerTable(){
        $this->SetFont('Arial','B',10);
        $this->Cell(17,6,'Order ID',1,0,'C');
		$this->Cell(15,6,'Item ID',1,0,'C');
        $this->Cell(100,6,'Item Name',1,0,'C');
        $this->Cell(12,6,'Unit',1,0,'C');
        $this->Cell(12,6,'Price',1,0,'C');
		$this->Cell(12,6,'QTY',1,0,'C');
		$this->Cell(18,6,'Date',1,0,'C');
		$this->Cell(12,6,'Status',1,0,'C');
        $this->Ln();
		
    }
    function viewTable($db){
	
		//global $rec_id;
	
		//$productID = $_REQUEST['id'];
		 
        $this->SetFont('Arial','',10);
        $stmt = $db->query('SELECT orders.id as ordid, products.id as prdid,products.products_name,products.quantity,order_items.product_price,order_items.quantity as qty,order_items.product_price*order_items.quantity as total,orders.created as orderdate,orders.status as ordersts FROM orders join order_items on orders.id = order_items.order_id JOIN products on order_items.product_id= products.id where orders.created >= CURDATE()-7');
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(17,6,$data->ordid,1,0,'C');
			$this->Cell(15,6,$data->prdid,1,0,'C');
            $this->Cell(100,6,$data->products_name,1,0,'L');
            $this->Cell(12,6,$data->quantity,1,0,'C');
            $this->Cell(12,6,$data->product_price,1,0,'C');
			$this->Cell(12,6,$data->qty,1,0,'C');
			$this->Cell(18,6,$data->orderdate,1,0,'C');
			$this->Cell(12,6,$data->ordersts,1,0,'C');
            $this->Ln();

        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();