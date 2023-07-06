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
	function FormLetter($patient_idd,$datee,$serial_no)
	{ 
		global $mysqli;

    
		
	$sql2="SELECT * FROM `nhif_card_no` where `patient_id`='$patient_idd'";
		$result2=mysqli_query($mysqli,$sql2);
		$row2=mysqli_fetch_array($result2);
		
		$card=$row2['card_no'];
		$visit=$row2['visit_type'];
	
		$authenticationRequestBody ='grant_type=password&username=hbalinzigu&password=Nhif@11007';
		//Using curl to post the information to STS and get back the
	   
		$ch = curl_init();
		// set url
		curl_setopt($ch, CURLOPT_URL, 'http://test.nhif.or.tz/nhifservice/token');
		// Get the response back as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// Mark as Post request
	   
		curl_setopt($ch, CURLOPT_POST, 1);
		// Set the parameters for the request
		curl_setopt($ch, CURLOPT_POSTFIELDS, $authenticationRequestBody);
		// By default, HTTPS does not work with curl.
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// read the output from the post request
		$output = curl_exec($ch);
		// close curl resource to free up system resources
		curl_close($ch);
		// decode the response from sts using json decoder
		$tokenOutput = json_decode($output);
	   //print_r($tokenOutput);
		
	   $token=$tokenOutput->{'access_token'};
	   
	   
	   
	   $curl = curl_init();
	   
	   curl_setopt_array($curl, array(
		 CURLOPT_URL => 'http://test.nhif.or.tz/nhifservice/breeze/verification/AuthorizeCard?cardNo='.$card.'&VisitTypeID='.$visit.'&ReferralNo=null&Remarks=null',
		 CURLOPT_RETURNTRANSFER => true,
		 CURLOPT_ENCODING => '',
		 CURLOPT_MAXREDIRS => 10,
		 CURLOPT_TIMEOUT => 0,
		 CURLOPT_FOLLOWLOCATION => true,
		 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		 CURLOPT_CUSTOMREQUEST => 'GET',
		 CURLOPT_POSTFIELDS => 'grant_type=password&username=hbalinzigu&password=Nhif@11007',
		 CURLOPT_HTTPHEADER => array(
		   'Authorization: Bearer '.$token.'',
		   'Content-Type: application/x-www-form-urlencoded'
		 ),
	   ));
	   
	    $response = curl_exec($curl);
	   $tokenObj = json_decode($response);
	   //print_r($tokenOutput);
	   //print_r($tokenObj);
	    $AuthorizationID=$tokenObj->{'AuthorizationID'};
		  $CardNo=$tokenObj->{'CardNo'};
		 $MembershipNo=$tokenObj->{'MembershipNo'};
		$EmployerNo=$tokenObj->{'EmployerNo'};
		$EmployerName=$tokenObj->{'EmployerName'};
		$HasSupplementary=$tokenObj->{'HasSupplementary'};
		$SchemeID=$tokenObj->{'SchemeID'};
		$SchemeName=$tokenObj->{'SchemeName'};
		$CardExistence=$tokenObj->{'CardExistence'};
		$CardStatusID=$tokenObj->{'CardStatusID'};
		$CardStatus=$tokenObj->{'CardStatus'};
		$IsValidCard=$tokenObj->{'IsValidCard'};
		$IsActive=$tokenObj->{'IsActive'};
		$StatusDescription=$tokenObj->{'StatusDescription'};
		$FirstName=$tokenObj->{'FirstName'};
		$MiddleName=$tokenObj->{'MiddleName'};
		$LastName=$tokenObj->{'LastName'};
		$FullName=$tokenObj->{'FullName'};
		$Gender=$tokenObj->{'Gender'};
		$PFNumber=$tokenObj->{'PFNumber'}; $DateOfBirth=$tokenObj->{'DateOfBirth'};
		$YearOfBirth=$tokenObj->{'YearOfBirth'};
		$Age=$tokenObj->{'Age'};
		$ExpiryDate=$tokenObj->{'ExpiryDate'};
		$CHNationalID=$tokenObj->{'CHNationalID'};
		$AuthorizationStatus=$tokenObj->{'AuthorizationStatus'};
		$AuthorizationNo=$tokenObj->{'AuthorizationNo'};
		$Remarks=$tokenObj->{'Remarks'};
		$FacilityCode=$tokenObj->{'FacilityCode'};
		$ProductName=$tokenObj->{'ProductName'};
		$ProductCode=$tokenObj->{'ProductCode'};
		$CreatedBy=$tokenObj->{'CreatedBy'};
		$AuthorizationDate=$tokenObj->{'AuthorizationDate'};
		$DateCreated=$tokenObj->{'DateCreated'};
		$LastModifiedBy=$tokenObj->{'LastModifiedBy'};
		$LastModified=$tokenObj->{'LastModified'};
		$AuthorizationDateSerial=$tokenObj->{'AuthorizationDateSerial'};
	
	   
	   curl_close($curl);
	   $sql="SELECT * FROM `insurence` where `patient_id`='$patient_idd' and `date`='$datee'";
	   $result=mysqli_query($mysqli,$sql);
	   
	   
	  $row=mysqli_fetch_array($result);
			$serial= $row['serial_no'];   
	   

			$result=outpatient($patient_idd,$datee);


			while($row=mysqli_fetch_array($result))
		  {
		  $doctor_id=$row['doctor_id'];
		  
		  }

		  $resultmsd=doctor($doctor_id);
while($rowmsd=mysqli_fetch_array($resultmsd))
{
   $dname=$rowmsd['name'];
   $regno=$rowmsd['regno'];
   $mobile=$rowmsd['mobile'];
   $qualification=$rowmsd['Qualification'];
}


	   $sql1="SELECT * FROM `outpatient` where `patientid`='$patient_idd'";
	  $result1=mysqli_query($mysqli,$sql1);
	  $row1=mysqli_fetch_array($result1); 

	  $sql1nn="SELECT * FROM `doctors` where `doctor_id`='NHIF'";
	  $result1nn=mysqli_query($mysqli,$sql1nn);
	  $redf =mysqli_fetch_array($result1nn); 

	
 $sql3="SELECT * FROM `report` where `patientid`='$patient_idd' and `date`='$datee' and `diseasetype`!=''";
	  $result3=mysqli_query($mysqli,$sql3);
	  
	
	  while($row3=mysqli_fetch_array($result3)){
		 $diseasetype=$row3['diseasetype'];
		
		 }
		
$sql1s="SELECT * FROM `disease` where `cate`='$diseasetype'";
		 $result1s=mysqli_query($mysqli,$sql1s);
		 $row1s=mysqli_fetch_array($result1s); 
	 $diesecoe=$row1s['disease'];
		$this->SetX($this->lMargin);

		$this->SetFont('Arial','B',12);
		
		$this->Ln(10);

		$this->SetY($this->lMargin);
		
	
			$this->Image('NHIF_Official_Logo.png',10,0,30);
			$this->Ln(1);
			$this->SetY($this->lMargin);
		$this->SetFont('Arial','',10);
		$this->Cell(0,2,"CONTIFIDENTIAL",0,0,'C');
		$this->Ln(6);
		$this->Cell(0,2,"THE NHIH - HEALTH PROVIDER IN/OUT PATIENT CLAIM FORM",0,0,'C');
		
		$this->SetY($this->lMargin);
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,"Appendix X",0,0,'R');
		$this->Ln(6);
		$this->Cell(0,2,"Form NHIF @A & B",0,0,'R');
	$this->Ln(6);
		$this->Cell(0,2,"Regulation 18(1)",0,0,'R');
		$this->Ln(6);
		$this->Cell(0,2,"Authorization No:".$AuthorizationNo,0,0,'R');
	$this->Ln(6);
		$this->Cell(0,2,"Serial No:".$serial,0,0,'R');
$this->Ln(0);


	
$resultd=doctordetails($dname);
  
while($rowd=mysqli_fetch_array($resultd))
{

$consultprice=$rowd['UnitPrice'];

}
	$this->SetX($this->lMargin);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,"A. PARTICULARS",0,0,'L');
		
	
		$this->Ln(6);
		$this->SetX($this->lMargin);
	
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,"1.Name Of Health Facility:St.Joseph hospital",0,0,'L',);
	
		$this->Ln(6);
		$this->Cell(0,2,"4.Department:Out",0,0,'L');
	$this->Ln(6);
		$this->Cell(0,2,"7.Name Of Patient:".$row1['firstname'].$row1['lastname'],0,0,'L');
		$this->Ln(6);
		$this->Cell(0,2,"10.Vote:".$row1['vote'],0,0,'L');
	$this->Ln(6);
		$this->Cell(0,2,"13.Occupation:".$row1['occ'],0,0,'L');
	
	
$this->Ln(-22);
	$this->SetX($this->lMargin);
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,"2.Address:".$row1['city']."-".$row1['country']."-".$row1['pin'],0,0,'C');
		$this->Ln(6);
		$this->Cell(0,2,"5.Date Of Attendance:".$datee,0,0,'C');
	$this->Ln(6);
		$this->Cell(0,2,"8.DOB:".$row1['birthdate'],0,0,'C');
		$this->Ln(6);
		$this->Cell(0,2,"11.Patient Physical Address:".$row1['city']."-".$row1['country']."-".$row1['pin'],0,0,'C');
	$this->Ln(6);
		$this->Cell(0,2,"14.Preliminary Diagnosis (Code):".$diesecoe,0,0,'C');
   



   $this->Ln(-22);
	$this->SetX($this->lMargin);
		$this->SetFont('Arial','',8);
		$this->Cell(0,2,"3.Consultation Fees:".$consultprice,0,0,'R');
		$this->Ln(6);
		$this->Cell(0,2,"6.Patient File No:".$patient_idd,0,0,'R');
	$this->Ln(6);
		$this->Cell(0,2,"9.Sex M/F:".$row1['gender'],0,0,'R');
		$this->Ln(6);
		$this->Cell(0,2,"12.Card No:".$CardNo,0,0,'R');
		$this->Ln(6);
		$this->Cell(0,2,"15.Final Diagnosis(Code):".$diesecoe,0,0,'R');

	
	
	 
	$this->Ln(6);
	$this->SetX($this->lMargin);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,"B. COSTS OF SERVICES",0,0,'L');
	
	
	$this->Ln(10);
	
	
ob_start();





$this->SetFillColor(172,172,160);
$this->SetFont('Arial','B',11);
$this->cell(180,10,'Description',1,0,'L',true);
$this->cell(25,10,'Item Code',1,0,'C',true);
$this->cell(25,10,'Qty',1,0,'C',true);
$this->cell(25,10,'Unit Price',1,0,'C',true);
$this->cell(25,10,'Amount',1,1,'C',true);

$this->SetFont('Arial','B',11);
$this->SetFillColor(172,172,160);
$this->cell(280,10,'Consultation',1,1,'L',true);




$sum_camount="0";
$resultd=doctordetails($dname);

while($rowd=mysqli_fetch_array($resultd))

	
		{
			$sum_camount=$rowd['UnitPrice'];
			
			if($rowd['UnitPrice']!="" ){
			
			$this->cell(180,6,"".$rowd['ItemName'],1,0,'C');
	$this->cell(25,6,"".$rowd['ItemCode'],1,0,'C');
	$this->cell(25,6,"1.0",1,0,);
	$this->cell(25,6,"".$rowd['UnitPrice'],1,0,);
	$this->cell(25,6,"".$rowd['UnitPrice'],1,1,);
	
	
			
			
		}
	
	
	}


$this->SetFont('Arial','B',11);
$this->SetFillColor(172,172,160);
$this->cell(255,10,'SUB TOTAL',1,0,'L');
$this->cell(25,10,"".$sum_camount,1,1,'L',true);






 
   
$this->SetFont('Arial','B',11);
$this->SetFillColor(172,172,160);
$this->cell(280,10,'Medicine',1,1,'L',true);




$result=mysqli_query($mysqli,$sql);
$sum_mamount="0";
while($row=mysqli_fetch_array($result))
		
{

	$medd[]=$row['Medicine'];	
	$mamount[]=$row['amount'];
 $sum_mamount=array_sum($mamount);
	
	if($row['Medicine']!="" && $row['quantity']!="" && $row['amount']!=""){
			$this->cell(180,6,"".$row['Medicine'],1,0,'C');
	$this->cell(25,6,"".$row['itemcode'],1,0,'C');
	$this->cell(25,6,"".$row['quantity'],1,0,);
	$this->cell(25,6,"".$row['price'],1,0,);
	$this->cell(25,6,"".$row['amount'],1,1,);

	
			
	}
}




 $total_amount=$sum_camount+$sum_mamount;

$this->SetFont('Arial','B',11);
$this->SetFillColor(172,172,160);
$this->cell(255,10,'SUB TOTAL',1,0,'L');
$this->cell(25,10,"".$sum_mamount,1,1,'L',true);


$this->SetFont('Arial','B',11);
$this->SetFillColor(172,172,160);
$this->cell(255,10,'GRAND TOTAL',1,0,'L');
$this->cell(25,10,"".$total_amount,1,1,'L',true);


$resultmsd=doctor($doctor_id);
while($rowmsd=mysqli_fetch_array($resultmsd))
{
  $dname=$rowmsd['name'];
}

	$this->Ln(6);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','',8);
	$this->cell(120,10,'C.Name of attending Clinician:'.$dname,0,0,'L');
	$this->cell(70,10,'Qualification:'.$qualification,0,0,'L');
$this->cell(60,10,'Reg.No:'.$regno,0,0,'L');
	$this->cell(60,10,'Signature:',0,0,'L');
	$this->cell(60,10,'Mob No:'.$mobile,0,0,'L');
	
	
		$this->Ln(6);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','B',8);
	$this->cell(40,10,'D.Patient Certifiction:',0,0,'L');
	
		$this->Ln(6);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','',8);
	$this->cell(80,10,'I certify that I received the above named services.',0,0,'L');
	$this->cell(70,10,'Name:'.$row1['firstname'].$row1['lastname'],0,0,'L');
$this->cell(70,10,'Mob No:'.$row1['contactno'],0,0,'L');
	$this->cell(70,10,'Signature:',0,0,'L');
	
	
	$this->Ln(6);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','B',8);
	$this->cell(40,10,'E.Descriptionof Out/In-patient Management/Any other additional information:',0,0,'L');
	
	
	$this->Ln(10);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',8);
		
		$this->cell(280,1,'',1,1,'L');




		$this->Ln(2);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','B',8);
	$this->cell(40,10,'F.Claimant Certification:',0,0,'L');



	$this->Ln(6);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','',8);
		$this->cell(80,10,'I certify that I provide the above names services.',0,0,'L');
		$this->cell(70,10,'Name:'.$redf['name'],0,0,'L');
	$this->cell(70,10,'Signature:',0,0,'L');


	$this->Ln(6);
$this->SetX($this->lMargin);
		$this->SetFont('Arial','B',8);
	$this->cell(40,10,'Patient should sign the form after completion of service',0,0,'L');
	
	$this->Ln(4);
	$this->SetX($this->lMargin);
			$this->SetFont('Arial','B',8);
		$this->cell(40,10,'Before referring patient to other facility, referring facility should be satisfied for the missing item and its alternative within',0,0,'L');
	
		$this->Ln(4);
		$this->SetX($this->lMargin);
				$this->SetFont('Arial','B',8);
			$this->cell(40,10,'the facility.',0,0,'L');
	
			$this->Ln(4);
			$this->SetX($this->lMargin);
					$this->SetFont('Arial','B',8);
				$this->cell(40,10,'Any falsified information may subject you to prosecutionin accordancewith NHIF Act No.8 of 1999.',0,0,'L');
				

		
	}









	function FormFee1($prog) {
	
		


}

}





function  GeneratePDFLetter($patient_idd,$datee,$serial_no){
	
echo '<a target = "_blank" href="'.$serial_no.'.pdf" ><button class="btn btn-primary" style="background-color:green;color:white;border:green solid 1px"><h2>NHIF FORM</h2></button></a>';
	$Qpdf=new PDF();
	$Qpdf->SetFont('helvetica','',12);
	$Qpdf->AddPage('L');
	$Qpdf->Ln(10);


	$Qpdf-> FormLetter($patient_idd,$datee,$serial_no);
	
	




	

	$Qpdf->Output("$serial_no.pdf","F");



}
?>