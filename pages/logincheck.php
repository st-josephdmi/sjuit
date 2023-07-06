<?php
session_start();
error_reporting("0");
include("function.php");
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
   
$login=userlogin($username,$password);

 if($login=='1')
 {


    
?>


<script>
    window.location = "insurence_patient_details.php";

    </script>
    <?php
 }

 else

{

    echo "<script>alert('LOGIN FAILED')</script>";
?>

<script>
    window.location = "loginform.php";

    </script>
<?php
}
 
    }
    ?>