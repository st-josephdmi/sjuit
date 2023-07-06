
<?php





 $patient_idd=$_SESSION['patientid'];
   $date=$_SESSION['date'];
    include("PDFne.php");
	
    GeneratePDFLetter($patient_idd,$date);

	
?>

