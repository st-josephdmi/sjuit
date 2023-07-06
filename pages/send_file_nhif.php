<?php

echo "hi";
include("function.php");
$patient_id=$_GET['id'];
$p_date=$_GET['date'];
$serial_no=$_GET['n_no'];
$report=$_GET['r_no'];



 $sql2="SELECT * FROM `nhif_card_no` where `patient_id`='$patient_id'";
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




       $sql1="SELECT * FROM `outpatient` where `patientid`='$patient_id'";
       $result1=mysqli_query($mysqli,$sql1);
       $row1=mysqli_fetch_array($result1); 
       $f_name=$row1['firstname'];
       $l_name=$row1['lastname'];
       $dob=$row1['birthdate'];
       $gender=$row1['gender'];
       $m_number=$row1['contactno'];

$result=outpatient($patient_id,$p_date);
while($row=mysqli_fetch_array($result))
{

$doctor_id=$row['doctor_id'];
 $lab_type[]=$row['lab_type']."<br/>";
$xray_type[]=$row['xray_type'];

 $diseasetype[]=$row['diseasetype']."<br/>";

}

$resultmsd=doctor($doctor_id);
while($rowmsd=mysqli_fetch_array($resultmsd))
{
   $pno=$rowmsd['pno'];
   
}

$sql2m="SELECT * FROM `claimfile` where `patient_id`='$patient_id' and `date`='$p_date'";;
$result2m=mysqli_query($mysqli,$sql2m);
while($row2m=mysqli_fetch_array($result2m))
{
 $ssno=$row2m['filename'];

}


  $b64Doc1 = chunk_split(base64_encode(file_get_contents("uploads/$ssno")));
 $b64Doc2 = chunk_split(base64_encode(file_get_contents($report.'.pdf.')));

 $authenticationRequestBody ='grant_type=password&username=integrationuser&password=nhif@2018';
 //Using curl to post the information to STS and get back the

 $ch = curl_init();
 // set url
 curl_setopt($ch, CURLOPT_URL, 'http://test.nhif.or.tz/claimsserver/token');
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

$result=outpatient($patient_id,$p_date);
while($row=mysqli_fetch_array($result))
{



  $diseasetype[]=$row['diseasetype']."<br/>";

}

//$today=date("Y-m-d");
$today="2023-05-12";

$movies_id = array();
$result=outpatientd($patient_id,$p_date);
while($roww=mysqli_fetch_array($result)) {
	$dis=$roww['diseasetype'];
	$resultcode=discode($dis);
	$rowwc=mysqli_fetch_array($resultcode);
	$disesn=$rowwc['disease'];
    if($roww['diseasetype']!=""){
        $movies_id[] = array ( "DiseaseCode" => "$disesn" , "Status" => "Provisional", "Remarks"=> null,
        "CreatedBy"=> "Administrator",
        "DateCreated"=> "$today",
        "LastModifiedBy"=> "Administrator",
        "LastModified"=> "$today");
    }
}

  $json1 = json_encode($movies_id);

 $string1 = trim($json1, "[");
 $string2 = trim($string1, "]");
 
 $sql="SELECT * FROM `insurence` where `patient_id`='$patient_id' and `date`='$p_date'";
 $result=mysqli_query($mysqli,$sql);

 $movies_id1 = array();

while($row=mysqli_fetch_array($result)) {
    if($row['Medicine']!=""){
        $movies_id1[] = array (  "ItemCode" => $row['itemcode'],
        "OtherDetails"=> "",
        "ItemQuantity"=>  $row['quantity'],
        "UnitPrice"=> $row['price'],
        "AmountClaimed"=> $row['amount'],
        "ApprovalRefNo"=> "null",
        "CreatedBy"=> "Administrator",
        "DateCreated"=> "$today");
    }
}
$json11 = json_encode($movies_id1);







if($gender=="F" || $gender=="f")
{
	$genderr="Female";
}

if($genderr=="M" || $gender=="m")
{
	$genderr="Male";
}
$cyear=date('Y');
$cmonth=date('m');
$sql2m="SELECT * FROM `claimfile`  where `patient_id`='$patient_id' and `date`='$p_date'";
$result2m=mysqli_query($mysqli,$sql2m);
while($row2m=mysqli_fetch_array($result2m))
{
 $foilono=$row2m['id'];

}

 $myArray=array( "entities" =>[
    array(
        "FacilityCode"=>"01141",
        "ClaimYear"=> "$cyear",
        "ClaimMonth"=> "$cmonth",
        "FolioNo"=> "$foilono",
        "CardNo"=> "$CardNo",
        "FirstName"=> "$f_name;",
        "LastName"=> "$l_name",
        "Gender"=> "$genderr",
        "DateOfBirth"=> "$dob",
        "TelephoneNo"=> "$m_number",
        "PatientFileNo"=> "$report",
        "ClaimFile"=> "$b64Doc1",
        "PatientFile"=> "$b64Doc2",
        "ClinicalNotes"=> "",
        "AuthorizationNo"=> "$AuthorizationNo",
        "AttendanceDate"=> "$today",
        "PatientTypeCode"=> "OUT",
        "DateAdmitted"=> "",
        "DateDischarged"=> "",
        "PractitionerNo"=> "$pno",
        "DelayReason"=> "Waiting for investigation results",
        "CreatedBy"=> "Administrator",
        "DateCreated"=> "$today",
        "LastModifiedBy"=> "Administrator",
        "LastModified"=> "$today",
        "FolioDiseases" =>$json1,
            "FolioItems"=>$json11

   
    
                
                

    )

 
]
    
);
  $json = json_encode($myArray);
   $json2=stripslashes($json);
  $pos1=strpos($json2,"FolioDiseases");
 $fpos=15+$pos1;
 $va1='"[';
 $va2='[';
$tt=str_replace("$va1","$va2","$json2");
 
 $va3=']"';
 $va4=']';
  $tt3=str_replace("$va3","$va4","$tt");

  //print_r($tt3);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://test.nhif.or.tz/claimsserver/api/v1/claims/SubmitFolios',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>''.$tt3.'',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token.'',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


# Define the Base64 string of the PDF file
# Decode the Base64 string, making sure that it contains only valid characters
$bin = base64_decode($b64Doc1, true);

# Perform a basic validation to make sure that the result is a valid PDF file
# Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
# Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
if (strpos($bin, '%PDF') !== 0) {
  throw new Exception('Missing the PDF file signature');
}

# Write the PDF contents to a local file
file_put_contents('file.pdf', $bin);

?>