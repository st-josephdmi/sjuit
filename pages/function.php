<?php

 include("db_connect.php"); 

 function userlogin($username,$password)
{

    global $mysqli;



  $sql= "SELECT * FROM `doctors` WHERE `doctor_id` = '$username' AND `password` = '$password'";
$result = mysqli_query($mysqli,$sql);

$row=mysqli_fetch_array($result);
$resultcheck=mysqli_num_rows($result);
if($resultcheck>0){
$_SESSION['login']=true;
 $_SESSION['name']=$row['name'];
 $_SESSION['role']=$row['desig'];

return true;
}
else

{
return false;
}


}

function outpatient($patient_id,$p_date)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `report` where `patientid`='$patient_id' and `date`='$p_date'";
    $result=mysqli_query($mysqli,$sql);
   
    
    return $result;
}


function discode($dis)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `disease` where `cate`='$dis' ";
    $result=mysqli_query($mysqli,$sql);
   
    
    return $result;
}

function doctordetails($dname)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `doctors` where `name`='$dname' ";
    $result=mysqli_query($mysqli,$sql);
    while($rowd=mysqli_fetch_array($result))
    {
    
   $backg=$rowd['background'];
       
   $datedd=$rowd['date_employed'];
    }
    
    $sql="SELECT * FROM `facility` where `ItemName`='$backg' and `PackageID`='$datedd'";
    $results=mysqli_query($mysqli,$sql);
    return $results;
}

function outpatientd($patient_id,$p_date)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `report` where `patientid`='$patient_id' and `date`='$p_date' and `disease`='on'";
    $result=mysqli_query($mysqli,$sql);
   
    
    return $result;
}

function patientname($patient_id)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `dailypatient` where `patientid`='$patient_id'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}
function doctor($doctor_id)
{
    global $mysqli;

    
    
$sql="SELECT * FROM `doctors` where `doctor_id`='$doctor_id'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}
function report($patient_id,$p_date)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `doctor_report` where `patientid`='$patient_id' and `date`='$p_date'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}
function inpatient($patient_id,$p_date)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `inpatient_report` where `patientid`='$patient_id' and `date`='$p_date'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}


function product($patient_id,$p_date)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `report` where `patientid`='$patient_id' and `date`='$p_date'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}
function nhif()
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `facility`";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}


function insurence($serial,$p_id,$p_date,$itemcode,$med,$qunti,$price,$totall)
         {
           global $mysqli;
         
           $sql="INSERT INTO  insurence(`serial_no`,`patient_id`,`date`,`itemcode`,`Medicine`,`quantity`,`price`,`amount`)
           VALUES ('$serial','$p_id','$p_date','$itemcode','$med','$qunti','$price','$totall')";
          mysqli_query($mysqli,$sql);
         
         
         }
         function select($patient_idd,$datee)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `insurence` where `patient_id`='$patient_idd' and `date`='$datee'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}


function cardstatus($patient_id,$CardNo,$visit)
{
    global $mysqli;
   
    
    $sql="INSERT INTO  nhif_card_no(`patient_id`,`card_no`,`visit_type`)
      VALUES ('$patient_id','$CardNo','$visit')";
     mysqli_query($mysqli,$sql);



}
function select_card_no($patient_id)
{
    global $mysqli;

    
    
    $sql="SELECT * FROM `nhif_card_no` where `patient_id`='$patient_id'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;
}
function followup($user){
    global $mysqli;

    
    
    $sql="SELECT * FROM `consultamount` WHERE `insurancetype`='NHIF'";
    $result=mysqli_query($mysqli,$sql);
   
   
    return $result;



}
function serial1($patient_idd,$datee,$serial_no){

    global $mysqli;
    $sql="UPDATE consultamount SET `nhif_serial_no`= '$serial_no' WHERE `patientid`='$patient_idd' and `date`='$datee'";
    
  
     mysqli_query($mysqli,$sql);

}
function serial2($patient_id,$datee,$report){

    global $mysqli;
    $sql="UPDATE consultamount SET `report_file_no`= '$report' WHERE `patientid`='$patient_id' and `date`='$datee'";
    
  
     mysqli_query($mysqli,$sql);

}

?>