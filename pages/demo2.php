
<?php

include("function.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />




    <title>Patient Report | Generate Pdf</title>
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
<body style="font-size:20px;">
<div class="container py-4">
<center><button class="btn btn-success" onclick="generatePDF()" ><h2>Generate PDF</h2></button>
</center></div>
<div id="invoice">

   
<div class="container py-4">
     <div class="row">
       <div class="col-12">
         <div class="card mb-4">
           <div class="card-header pb-0">
             <h1>Patient Details  </h1>
           </div>
           <div class="card-body px-0 pt-0 pb-2">
             <div class="table-responsive p-0">
              
             <div class="card-body">


             <?php
$patient_id=$_GET['p_id'];
$p_date=$_GET['date'];
  $patient_id;
 $p_date;
 $result=select_card_no($patient_id);
 while($row=mysqli_fetch_array($result))
 {
   $card_no=$row['card_no'];
 }

 $result=outpatient($patient_id,$p_date);


 while($row=mysqli_fetch_array($result))
{
 $doctor_id=$row['doctor_id'];
$lab_type[]=$row['lab_type']."<br/>";
 $xray_type[]=$row['xray_type'];

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
   
 
 <tr>
   <td>Doctor Name</td>
   <td><?php echo $dname; ?> </td>
   
 </tr>
 <tr>
   <td>Medicine Name</td>
   <td><?php $sno="1";
   
   $result=product($patient_id,$p_date);
 
while($row=mysqli_fetch_array($result))
{

echo $sno++.".\n\n".$med_type[]=$row['productname']."=.\n\n".$quantity[]=$row['quantity']."<br/>";

}


?><input type='hidden' name='quantity' value='<?php print_r($quantity); ?>' />
<input type='hidden' name='pid' value='<?php print_r($patient_id); ?>' />
<input type='hidden' name='pdate' value='<?php print_r($p_date); ?>' />
    <div class="col-sm">




</td>


 </tr>
 <tr>
   <td>Lab Test</td>
   <td><?php 

 $result=outpatient($patient_id,$p_date);
 while($row=mysqli_fetch_array($result))
{
 if($row['lab_type']!=""){
 $doctor_id=$row['doctor_id'];
echo $lab_type[]=$row['lab_type']."<br/>";
 $xray_type[]=$row['xray_type'];

 $diseasetype[]=$row['diseasetype'];

}
}
 ?> </td>

   
 </tr>

 <tr>
   <td>X Ray Test</td>
   <td><?php 

 $result=outpatient($patient_id,$p_date);
 while($row=mysqli_fetch_array($result))
{
 if($row['xray_type']!=""){
 $doctor_id=$row['doctor_id'];
$lab_type[]=$row['lab_type']."<br/>";
 echo $xray_type[]=$row['xray_type']."<br/>";

 $diseasetype[]=$row['diseasetype'];

}
} ?> </td>
   
 </tr>

 <tr>
   <td>Disease</td>
   <td><?php if($result=outpatient($patient_id,$p_date)->num_rows>0)
{
 $result=outpatient($patient_id,$p_date);
 while($row=mysqli_fetch_array($result))
{
 if($row['diseasetype']!=""){
 $doctor_id=$row['doctor_id'];
$lab_type[]=$row['lab_type']."<br/>";
 $xray_type[]=$row['xray_type'];

echo $diseasetype[]=$row['diseasetype']."<br/>";
 }
}
}else{

 echo 'No data found!';
 
} ?> </td>
   
 </tr>
 <tr>
   <td>Patient Report</td>
   <td><?php if($result=report($patient_id,$p_date)->num_rows>0)
{
 $result=report($patient_id,$p_date);
while($row=mysqli_fetch_array($result))
{
 echo $report[]=$row['init_report'];
}

}else{

 echo 'No data found!';
 
} ?> </td>
   
 </tr>


<tr>
 <td>NHIF Card No</td>
 <td><?php if($result=select_card_no($patient_id)->num_rows>0){ echo $card_no; }else{echo "No Data Found!";}?></td>
</tr>
 
</table><br>


<?php


?>




</div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
  
 



<script>
function generatePDF() {
    var element = document.getElementById('invoice');
var opt = {
  margin:       1,
  filename:     '<?php echo $patient_id.$p_date;  ?>.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'Landscape' }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();

// Old monolithic-style usage:


}</script>


</body>
</html>