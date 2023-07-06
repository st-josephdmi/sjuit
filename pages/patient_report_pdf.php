<?php

set_time_limit(0);

require ('fpdf/fpdf.php');



class PDF extends FPDF
{
	
	

//Page footer


	
	public function Header()
	{
	
	$this->SetFillColor(241, 232, 139, 1);
	$this->Rect(0, 0, $this->getPageWidth(), $this->getPageHeight(), 'DF', "");
	

	}
//Simple table
	function FormLetter1($patient_id,$datee,$report)
	{ 
		global $mysqli;
		
		$sql1="SELECT * FROM `nhif_card_no` where `patient_id`='$patient_id'";
		$result1=mysqli_query($mysqli,$sql1);
		 
		 $row1=mysqli_fetch_array($result1);
		
			$card_no=$row1['card_no'];
		 
		

		  $sql2="SELECT * FROM `report` where `patientid`='$patient_id' and `date`='$datee'";
		  $result2=mysqli_query($mysqli,$sql2);
		while($row2=mysqli_fetch_array($result2))
		{
		  $doctor_id=$row2['doctor_id'];
		 $lab_type=$row2['lab_type']."<br/>";
		  $xray_type=$row2['xray_type'];
		 
		  $diseasetype=$row2['diseasetype'];
		 
		}
		
		
		
		
		$sql3="SELECT * FROM `dailypatient` where `patientid`='$patient_id'";
		$result3=mysqli_query($mysqli,$sql3);
		
		$row3=mysqli_fetch_array($result3);
		
		  $pname=$row3['pname'];
		  $department=$row3['department'];
		
		$doctor_id;
		$sql4="SELECT * FROM `doctors` where `doctor_id`='$doctor_id'";
		$result4=mysqli_query($mysqli,$sql4);
		
		$row4=mysqli_fetch_array($result4);
		
		  $dname=$row4['name'];
		

		$sql5="SELECT * FROM `doctor_report` where `patientid`='$patient_id' and `date`='$datee'";
		$result5=mysqli_query($mysqli,$sql5);
		
	$row5=mysqli_fetch_array($result5);
	
		  $report=$row5['init_report'];
		

	
		  $sql6="SELECT * FROM `insurence` where `patient_id`='$patient_id' and `date`='$datee'";
		  $result6=mysqli_query($mysqli,$sql6);
		  while($row6=mysqli_fetch_array($result6))
		  {
		  
		   $med_type=$row6['Medicine'];
		  $quantity=$row6['quantity'];
		  
		  }
		

		
		$this->Ln(6);

			$this->SetFont('Arial','',12);
		$this->cell(80,10,'Patient Id.',0,0,'L');
		$this->cell(70,10,':'.$patient_id,0,0,'L');
	

		$this->Ln(10);

			$this->SetFont('Arial','',12);
		$this->cell(80,10,'Patient Name',0,0,'L');
		$this->cell(70,10,':'.$row3['pname'],0,0,'L');


		$this->Ln(10);

			$this->SetFont('Arial','',12);
		$this->cell(80,10,'Date',0,0,'L');
		$this->cell(70,10,':'.$datee,0,0,'L');

		$this->Ln(10);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',12);
		$this->cell(80,10,'Doctor Name',0,0,'L');
		$this->cell(70,10,':'.$row4['name'],0,0,'L');

		$this->Ln(10);
		$this->SetX($this->lMargin);
				$this->SetFont('Arial','',12);
			$this->cell(80,30,'Medicine',0,0,'L');

			$result6=mysqli_query($mysqli,$sql6);
			while($row6=mysqli_fetch_array($result6))
			{
		$this->Ln(3);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',12);
			
		if($row6['Medicine']!=""){
			$this->cell(80,10,'',0,0,'L');
		$this->cell(70,10,':'.$row6['Medicine'],0,0,'L');
		$this->Ln(1);
		}	

		}

		$this->Ln(10);				$this->SetFont('Arial','',12);
			$this->cell(80,30,'Xray Type',0,0,'L');

		$result2=mysqli_query($mysqli,$sql2);
		while($row2=mysqli_fetch_array($result2))
		{
		$this->Ln(3);

			$this->SetFont('Arial','',12);
			$xrayv=$row2['xray_type'];
  $checkvx=substr($xrayv,0,8);
		if($row2['xray_type']!="" && $checkvx!='Resource' ){
			$this->cell(80,10,'',0,0,'L');
		$this->cell(70,10,':'.$row2['xray_type'],0,0,'L');
		$this->Ln(1);
		}	
		}



		$this->Ln(10);
	
				$this->SetFont('Arial','',12);
			$this->cell(80,20,'Lab Test',0,0,'L');

		$result2=mysqli_query($mysqli,$sql2);
		while($row2=mysqli_fetch_array($result2))
		{
		$this->Ln(3);

			$this->SetFont('Arial','',12);
			$xrayvb=$row2['lab_type'];
			$checkvxb=substr($xrayvb,0,8);
		if($row2['lab_type']!="" && $checkvxb!='Resource'){
			$this->cell(80,10,'',0,0,'L');
		$this->cell(70,10,':'.$row2['lab_type'],0,0,'L');
		$this->Ln(1);
		}	
		}
		


		$this->Ln(10);
		
				$this->SetFont('Arial','',12);
			$this->cell(80,30,'Disease',0,0,'L');
			$sql21="SELECT * FROM `report` where `patientid`='$patient_id' and `date`='$datee' and `diseasetype`!=''";
			$result21=mysqli_query($mysqli,$sql21);
		$result21=mysqli_query($mysqli,$sql21);
		while($row21=mysqli_fetch_array($result21))
		{
		$this->Ln(10);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',12);
			$xrayvbd=$row21['diseasetype'];
			$checkvxbd=substr($xrayvbd,0,8);
		if($row21['diseasetype']!="" && $checkvxbd!='Resource'){
			$this->cell(80,10,'',0,0,'L');
		$this->cell(70,10,':'.$row21['diseasetype'],0,0,'L');
		$this->Ln(1);
		}	
		}

		$this->Ln(30);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',12);
		$this->cell(80,10,'NHIF Card No',0,0,'L');
		$this->cell(70,10,':'.$row1['card_no'],0,0,'L');

		$this->Ln(10);

			$this->SetFont('Arial','',12);
		$this->cell(80,10,'Patient Report:',0,0,'L');
		$this->MultiCell(0,5,$row5['init_report'],0,'L');
	




	}









	function FormFee1($prog) {
	
		


}

}





function  GeneratePDFLetter1($patient_id,$datee,$report){
	
echo '<a target = "_blank" href="'.$report.'.pdf" ><button class="btn btn-primary" style="background-color:green;color:white;border:green solid 1px"><h2>patient report</h2></button></a>';
	$Qpdf=new PDF();
	$Qpdf->SetFont('helvetica','',12);
	$Qpdf->AddPage('L');
	$Qpdf->Ln(10);


	$Qpdf-> FormLetter1($patient_id,$datee,$report);
	
	




	

	$Qpdf->Output("$report.pdf","F");



}
?>