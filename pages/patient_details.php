
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
  <link href="dist/css/component-chosen.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
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
<form action="out_patient_medicine.php" method="GET">
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
    <td>Consultation Type</td>
    <td><?php 
    $resultd=doctordetails($dname);
  
while($rowd=mysqli_fetch_array($resultd))
{

echo $rowd['ItemName'];

}


?>



</td>

  <tr>
      <tr>
    <td>Consultation Item Code</td>
    <td><?php 
    $resultd=doctordetails($dname);
  
while($rowd=mysqli_fetch_array($resultd))
{

echo $rowd['ItemCode'];

}


?>



</td>

  <tr>
    <tr>
      <tr>
    <td>Consultation Price</td>
    <td><?php 
    $resultd=doctordetails($dname);
  
while($rowd=mysqli_fetch_array($resultd))
{

echo $rowd['UnitPrice'];

}


?>



</td>

  <tr>
    <td>Medicine Name</td>
    <td><?php $sno="1";
    $result=product($patient_id,$p_date);
  
while($row=mysqli_fetch_array($result))
{

echo $sno++.".\n\n".$med_type[]=$row['med_type']."=.\n\n".$quantity[]=$row['med_desc']."<br/>";

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

  $xrayvb=$row['lab_type'];
  $checkvxb=substr($xrayvb,0,8);

  if($row['lab_type']!="" && $checkvxb!='Resource'){
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
  $xrayv=$row['xray_type'];
  $checkvx=substr($xrayv,0,8);
  if($row['xray_type']!="" && $checkvx!='Resource' ){
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
  $xrayvbd=$row['diseasetype'];
  $checkvxbd=substr($xrayvbd,0,8);

  if($row['diseasetype']!="" && $checkvxbd!='Resource'){
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
<td>NHIF Item</td>
<td>
<select id="optgroup_clickable" class="form-control form-control-chosen-optgroup" title="clickable_optgroup" data-placeholder="Selet NHIF Name....." multiple name="mcode[]" >
<?php

$result=nhif();
while($row=mysqli_fetch_array($result))
{
$ItemName[]=$row['ItemName'];





?>


<option value="<?php echo $row['ItemName']."..".$row['UnitPrice']."..".$row['ItemCode']?>"><?php echo $row['ItemName'].".\n\n".$row['UnitPrice']?></option>

  



<?php

}
?>


  </optgroup>
                </select>
</div></td>


</tr>

<tr>
  <td>NHIF Card No</td>
  <td><?php if($result=select_card_no($patient_id)->num_rows>0){ echo $card_no; }else{echo "No Data Found!";}?></td>
</tr>
  
</table><br>
<center><input class="btn btn-success btn-lg " value="submit" name="submit" type="submit" >

</form>
<?php


?>




</div>
               
               </div>
             </div>
           </div>
         </div>
       </div>
     <?php 
    
     include("footer.php"); ?>
     </div>
   </main>
   <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>
  <script type="text/javascript">
$('.form-control-chosen').chosen({
  allow_single_deselect: true,
  width: '100%'
});
$('.form-control-chosen-required').chosen({
  allow_single_deselect: false,
  width: '100%'
});
$('.form-control-chosen-search-threshold-100').chosen({
  allow_single_deselect: true,
  disable_search_threshold: 100,
  width: '100%'
});
$('.form-control-chosen-optgroup').chosen({
  width: '100%'
});

$(function() {
  $('[title="clickable_optgroup"]').addClass('chosen-container-optgroup-clickable');
});
$(document).on('click', '[title="clickable_optgroup"] .group-result', function() {
  var unselected = $(this).nextUntil('.group-result').not('.result-selected');
  if(unselected.length) {
    unselected.trigger('mouseup');
  } else {
    $(this).nextUntil('.group-result').each(function() {
      $('a.search-choice-close[data-option-array-index="' + $(this).data('option-array-index') + '"]').trigger('click');
    });
  }
});
  </script>
  <script>
    //Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1

//- Using an anonymous function:
document.getElementById("Array_name").onclick = function () {};
  
 //When user click on add input button
 $(add_button).click(function(e){
        e.preventDefault();
 //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
 //add input field
            $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Consultation type... " /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
 
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); //remove inout field
 x--; //inout field decrement
    })
});
  </script>
 </body>
 
 </html>
