<?php
include("function.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    SJHMS NHIF
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


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
 <?php include ("menu.php"); ?>
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
              <h6>Out Patient </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
               
              <div class="card-body">


             
              <table id="example" class="display" style="width:100%">
<thead >

<tr >
<th>
 Sno
</th>
<th>
Patient ID
</th>
<th>
Date
</th>
<th>
Patient Name
</th>

<th>
Insurence Type
</TH>



<TH>
Create Claim File

</TH>
<TH>
Download Claim File

</TH>
<TH>
Download Patient File

</TH>
<TH>
Upload Claim File

</TH>
<TH>
Send File

</TH>
</TR>

</thead>
<tbody>
<?php



$result=followup($user);


$sno="1";
while($row=mysqli_fetch_array($result))
{
	$id=$row['id'];
    
	$insu_type=$row['insurancetype'];
    $serial_noo=$row['nhif_serial_no'];
    $patient_serial_noo=$row['report_file_no'];
	if($insu_type!=""){
    ?>


<tr>

<th>
    <?php echo $sno; ?>

</th>	
		
	
<th>
    <?php echo $pid=$row['patientid'] ?>

</th>
<th>
    <?php echo $datee=$row['date'] ?>

</th>


<th>
    <?php echo $row['patientname'] ?>

</th>

<th>
    <?php echo $row['insurancetype'] ?>

</th>
<th>
<?php  if($serial_noo!="" && $patient_serial_noo!=""){
    ?>


Done

<?php
}else{
    ?>

<a href="patient.php?id=<?php echo $row['patientid'] ?>&date=<?php echo $row['date'] ?>" style="color:#82E0AA  ">CLAIM</a>


<?php }
?>
</th>
<th>
<?php  if($serial_noo!="" && $patient_serial_noo!=""){
    ?>


<a href="<?php echo $serial_noo?>.pdf">DOWNLOAD</A>

<?php
}
?>
</th>
<th>
<?php  if($patient_serial_noo!=""){
    ?>
<a href="<?php echo $patient_serial_noo?>.pdf">DOWNLOAD</A>

<?php
}
?>
</th>
<th>
  <?php
  $filename="0";
  $sql2m="SELECT * FROM `claimfile` where `patient_id`='$pid' and `date`='$datee' and `serial_no`='$serial_noo'";
  $result2m=mysqli_query($mysqli,$sql2m);
while($row2m=mysqli_fetch_array($result2m))
{
   $filename=$row2m['filename'];

}

if($filename=='0' || $filename=='')
{
  ?>

<form action="fileupload.php" method="POST" enctype="multipart/form-data">
         <input type="file" name="fileToUpload" />
         <input type="hidden" name="patientid" value="<?php echo $row['patientid']?>">
         <input type="hidden" name="pdate" value="<?php echo $row['date']?>">
         <input type="hidden" name="serialno" value="<?php echo $serial_noo?>">
         <input type="submit" value="UPLOAD CLAIM FILE" name="submit"/>
      </form>
      <?php
}
else
  {
    ?>
    <a href="uploads/<?php echo $filename?>">DOWNLOAD</a>
    <?php
  }
  ?>
</th>
<th>
<?php  if($serial_noo!="" && $patient_serial_noo!=""){
    ?>


<a href="send_file_nhif.php?id=<?php echo $row['patientid'] ?>&date=<?php echo $row['date'] ?>&n_no=<?php echo $row['nhif_serial_no'] ?>&r_no=<?php echo $row['report_file_no'] ?>" style="color:#82E0AA  ">SEND</a>


<?php
}else{
    ?>

NOT CLAIM

<?php }
?>

</th>
<?php
$sno++;
}
}
?>

</tr>
</tbody>
</table>
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>




                
               




</div>
               
               </div>
             </div>
           </div>
         </div>
       </div>

     <?php include("footer.php"); ?>

     </div>
   </main>

   <script src="js/app.js"></script>
<script>$(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});</script>

 </body>
 
 </html>