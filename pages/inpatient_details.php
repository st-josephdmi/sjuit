
<?php include("function.php"); ?>
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
              <h6>Patient Details  </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
               
              <div class="card-body">


              <?php
$patient_id=$_GET['p_id'];
$p_date=$_GET['date'];
   $patient_id;
  $p_date;
  $result=inpatient($patient_id,$p_date);
  while($row=mysqli_fetch_array($result))
{
  $doctor_id=$row['doctor_id'];
  $lab_type[]=$row['lab_type'];
  $xray_type[]=$row['xray_type'];
  $med_type[]=$row['med_type'];
  $diseasetype[]=$row['diseasetype'];

}

$result=patientname($patient_id);
while($row=mysqli_fetch_array($result))
{
  $pname=$row['pname'];
  $department=$row['department'];
}
 $doctor_id;
$result=doctor($doctor_id);
while($row=mysqli_fetch_array($result))
{
    $dname=$row['name'];
}

$result=report($patient_id,$p_date);
while($row=mysqli_fetch_array($result))
{
  $report[]=$row['init_report'];
}

?>

<table>

  <tr> 
    <td>Patient Id</td>
    <td><?php echo $patient_id; ?> </td>
    
  </tr>
  <tr>
    <td>Patient Name</td>
    <td><?php if($result=patientname($patient_id)->num_rows>0)
{ echo $pname; } 
else{

  echo 'No data found!';
  
}?> </td>
    
  </tr>
  <tr>
    <td> Date</td>
    <td><?php echo $p_date; ?> </td>
    
  </tr>

  <tr>
    <td>Doctor Name</td>
    <td><?php echo $dname; ?> </td>
    
  </tr>
  <tr>
    <td>Product Name</td>
    <td><?php if($result=inpatient($patient_id,$p_date)->num_rows>0)
{
  foreach ($med_type as $food)  {
    echo $food ."<br />";
} 
}else{

  echo 'No data found!';
  
}?> </td>
    
  </tr>
  <tr>
    <td>Lab Test</td>
    <td><?php if($result=inpatient($patient_id,$p_date)->num_rows>0)
{
  foreach ($lab_type as $lab)  {
    echo $lab ."<br />";
}
}else{

  echo 'No data found!';
  
} ?> </td>
   


  </tr>

  <tr>
    <td>X Ray Test</td>
    <td><?php if($result=inpatient($patient_id,$p_date)->num_rows>0)
{
  foreach ($xray_type as $xlab)  {
    echo $xlab ."<br />";
}
}else{

  echo 'No data found!';
  
} ?> </td>
    
  </tr>

  <tr>
    <td>Disease</td>
    <td><?php if($result=inpatient($patient_id,$p_date)->num_rows>0)
{
  foreach ($diseasetype as $dis)  {
    echo $dis ."<br />";
}
}else{

  echo 'No data found!';
  
} ?> </td>
    
  </tr>
  <tr>
    <td>Patient Report</td>
    <td><?php if($result=report($patient_id,$p_date)->num_rows>0)
{
  foreach ($report as $report)  {
    echo $report ."<br />";
}
}else{

  echo 'No data found!';
  
} ?> </td>
    
  </tr>
</table>


<?php


?>




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