<?php include("function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
  
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
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  ​<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
width:100%;
}

td, th ,tr{
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
.navv{

display: none;

}
.open-button {
  background-color: #555;
  color: white;
  padding: 5px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 150px;
  z-index: 99;
}
.form-popup{
   
    
    z-index: 98;

}
/* The popup form - hidden by default */


/* Add styles to the form container */




/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
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


              <?php 
              
              
 $namee=$_GET['mcode'];
 

   $patient_id=$_GET['pid'];
  $p_date=$_GET['pdate'];
  $patient_id;
 
  $cur_date = date('d').date('m').date('y');
  $invoice = $cur_date;
  //echo $invoice.'</br>';
  $customer_id = rand(0000 , 9999);
  $uRefNo = $invoice.$customer_id;

  function serial($patient_id,$p_date) {
    global $mysqli;

    
    
    $sql="SELECT * FROM `insurence` where `patient_id`='$patient_id' and `date`='$p_date'";
    $result=mysqli_query($mysqli,$sql);
		while($row=mysqli_fetch_array($result))
{
  $row['serial_no'];

  if($row['serial_no']!=$uRefNo){
    $cur_date = date('d').date('m').date('y');
    $invoice = $cur_date;
    //echo $invoice.'</br>';
    $customer_id = rand(0000 , 9999);
    $uRefNo1 = $invoice.$customer_id;

}else{

  $cur_date = date('d').date('m').date('y');
  $invoice = $cur_date;
  //echo $invoice.'</br>';
  $customer_id = rand(0000 , 9999);
  $uRefNo1 = $invoice.$customer_id;

}
  
  }

  }


 
   $uRefNo1 = $invoice.$customer_id;

   
  

?>


<div class="container_fluid">
<div class="row">
<div class="col-sm-12"><form action="demo1.php" method="POST">
<input name="patient_idd"type="hidden"value="<?php  echo $patient_id; ?>"/>
<input name="p_datee"type="hidden"value="<?php  echo  $p_date; ?>"/>

<table>
<thead >

<tr >
    
    <th >

       Medicine
</TH>

</TR>

</thead>
<tbody>

<?php

$sno="1";
    $snoo="1";
    $snooo="1";
    $result=product($patient_id,$p_date);
  
while($row=mysqli_fetch_array($result))
{


    ?>
<tr>






<th>

  <?php
echo $sno++.".\n\n".$med_type[]=$row['med_type']."=.\n\n".$quantity[]=$row['med_desc']."<br/>"; ?>

<?php

}

?>
    </tr>
<?php

?>
</tbody>
</table>
</div>






</div>
</div>



<br><br>


<table>
<thead >

<tr >
    
    <th >

      NHIF Medicine
</TH>

</TR>
    <th ><?php foreach ($namee as $nam)  {
  $data_exploded = explode('..', $nam);
   $data_exploded[2];
  ?><input placeholder="enter quantity...." name="numm[]"type="number"required="true"/>
  <input placeholder="enter price...."name="nummprice[]"type="number" value="<?php echo $data_exploded[1]; ?>"readonly required="true"/>
  <input placeholder="enter quantity...." name="itemcode[]"type="hidden"value="<?php echo $data_exploded[2]; ?>"/>
  <input placeholder="enter price...."name="med[]"type="text" readonly required="true" value="<?php echo $data_exploded[0]; ?>" style="width:300px"/><br>
  <input name="patient_id[]"type="hidden"value="<?php  echo $patient_id; ?>"/>
<input name="p_date[]"type="hidden"value="<?php  echo  $p_date; ?>"/>
<input name="serial"type="hidden"value="<?php  echo  $uRefNo1; ?>"/>
  <?php  
  
}?></th>


    
</tr>           
    </tbody>
</table>
<br><br>














<br>

<input class="btn btn-success" name="submit" type="submit"  value="submit" />
</form> 


<br></br>






</div>




</div>
               
               </div>
             </div>
           </div>
         </div>
       </div>

     <?php include("footer.php"); ?>

     </div>
   </main>


   <script>
    window.onload = function () {
     document.getElementById("myForm").style.display = "none";
}
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script>
	$(document).ready(function () {
    $('#example').DataTable({
        stateSave: true,
		scrollX: true,
    });
});

</script>


 </body>
 
 </html>






