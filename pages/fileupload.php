
<?php
$patientid=$_POST['patientid'];
$serialno=$_POST['serialno'];
$pdate=$_POST['pdate'];

$target_dir = "uploads/";
$filename=basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size


// Allow certain file formats


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    include("function.php");
   echo $sql="INSERT INTO  claimfile (`serial_no`,`patient_id`,`date`,`filename`)
           VALUES ('$serialno','$patientid','$pdate','$filename')";
          mysqli_query($mysqli,$sql);

    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  header("location: insurence_patient_details.php");
}
?>