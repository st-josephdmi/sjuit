<?php  include("function.php");  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />


  ​<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
.navv{

display: none;

}
@media screen and (max-width: 600px) {
 .navv{

  display: block;

 }
}
</style> 
</head>

<body class="g-sidenav-show  bg-gray-100">
 <?php include("menu.php"); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <div class="navv">
    <?php include ("menu1.php"); ?>
</div>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Card Details</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
               
              <div class="card-body">


<?php
$card=$_GET['card'];
$visit=$_GET['visit'];
$patient_id=$_GET['patient_id'];
 $card;
$visit;


?>







<?php
 // Construct the body for the STS request
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

echo $response = curl_exec($curl);
$tokenObj = json_decode($response);
//print_r($tokenOutput);
//print_r($tokenObj);
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
 
 if($AuthorizationNo=""){
cardstatus($patient_id,$CardNo,$visit);
 }else{
echo "<script>alert('AuthorizationNo Is Not Active!...');</script>";

}

curl_close($curl);
?>


<table>

  <tr>
    <td>CardNo</td>
    <td><?php echo $CardNo ?> </td>
    
  </tr>
  <tr>
    <td>MembershipNo</td>
    <td><?php echo $MembershipNo ?> </td>
    
  </tr>
  <tr>
    <td>EmployerNo</td>
    <td><?php echo $EmployerNo ?> </td>
    
  </tr>
  <tr>
    <td>EmployerName</td>
    <td><?php echo $EmployerName ?> </td>
   
  </tr>
  <tr>
    <td>HasSupplementary</td>
    <td><?php echo $HasSupplementary ?> </td>
   
  </tr>
  <tr>
    <td>SchemeID</td>
    <td> <?php echo $SchemeID ?></td>
     </tr>

     <tr>
    <td>SchemeName</td>
    <td> <?php echo $SchemeName ?></td>
     </tr>
     <tr>
    <td>CardExistence</td>
    <td> <?php echo $CardExistence ?></td>
     </tr>
     <tr>
    <td>CardStatusID</td>
    <td> <?php echo $CardStatusID ?></td>
     </tr>
     <tr>
    <td>CardStatus</td>
    <td> <?php echo $CardStatus ?></td>
     </tr>
     <tr>
    <td>IsValidCard</td>
    <td> <?php echo $IsValidCard ?></td>
     </tr>
     <tr>
    <td>IsActive</td>
    <td> <?php echo $IsActive ?></td>
     </tr>
     <tr>
    <td>StatusDescription</td>
    <td> <?php echo $StatusDescription ?></td>
     </tr>
     <tr>
    <td>FirstName</td>
    <td> <?php echo $FirstName ?></td>
     </tr>
     <tr>
    <td>MiddleName</td>
    <td> <?php echo $MiddleName ?></td>
     </tr>
     <tr>
    <td>LastName</td>
    <td> <?php echo $LastName ?></td>
     </tr>
     <tr>
    <td>FullName</td>
    <td> <?php echo $FullName ?></td>
     </tr>
     <tr>
    <td>Gender</td>
    <td><?php echo $Gender ?></td>
     </tr>
     <tr>
    <td>PFNumber</td>
    <td><?php echo $PFNumber ?> </td>
     </tr>
     <tr>
    <td>Year Of Birth</td>
    <td> <?php echo $YearOfBirth ?></td>
     </tr>
     <tr>
    <td>Age</td>
    <td> <?php echo $Age ?></td>
     </tr>
     <tr>
    <td>ExpiryDate</td>
    <td> <?php echo $ExpiryDate ?></td>
     </tr>
     <tr>
    <td>CHNationalID</td>
    <td> <?php echo $CHNationalID ?></td>
     </tr>
     <tr>
    <td>AuthorizationStatus</td>
    <td> <?php echo $AuthorizationStatus ?></td>
     </tr>
     <tr>
    <td>AuthorizationNo</td>
    <td> <?php echo $AuthorizationNo ?></td>
     </tr>
     <tr>
    <td>Remarks</td>
    <td> <?php echo $Remarks ?></td>
     </tr>
     <tr>
    <td>FacilityCode</td>
    <td> <?php echo $FacilityCode ?></td>
     </tr>
     <tr>
    <td>ProductName</td>
    <td> <?php echo $ProductName ?></td>
     </tr>
     <tr>
    <td>ProductCode</td>
    <td> <?php echo $ProductCode ?></td>
     </tr>
     <tr>
    <td>CreatedBy</td>
    <td> <?php echo $CreatedBy ?></td>
     </tr>
     <tr>
    <td>AuthorizationDate</td>
    <td> <?php echo $AuthorizationDate ?></td>
     </tr>
     <tr>
    <td>DateCreated</td>
    <td> <?php echo $DateCreated ?></td>
     </tr>
     <tr>
    <td>LastModifiedBy</td>
    <td> <?php echo $LastModifiedBy ?></td>
     </tr>
     <tr>
    <td>LastModified</td>
    <td> <?php echo $LastModified ?></td>
     </tr>
     <tr>
    <td>AuthorizationDateSerial</td>
    <td> <?php echo $AuthorizationDateSerial ?></td>
     </tr>
    






</table>











</div>
               
               </div>
             </div>
           </div>
         </div>
       </div>
     <?php include("footer.php"); ?>
     </div>
   </main>
  
 </body>
 
 </html>