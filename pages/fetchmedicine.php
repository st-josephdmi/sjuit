<?php
 // Construct the body for the STS request
 $authenticationRequestBody ='grant_type=password&username=hbalinzigu&password=Nhif@11007';
 //Using curl to post the information to STS and get back the

 $ch = curl_init();
 // set url
 curl_setopt($ch, CURLOPT_URL, 'https://verification.nhif.or.tz/claimsserver/token');
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
  CURLOPT_URL => 'https://verification.nhif.or.tz/claimsserver/api/v1/Packages/GetPricePackageWithExcludedServices?FacilityCode=01141',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);
 


$response_object = json_decode($response);

		print_r($response_object);
   //Access Data from JSON
	//	if($response_object->success == 200) {
        //Variable to be stored in Database depends on your system logics
			 $applicant_AVN = $response_object->FacilityCode;

        
   $applicant_diploma_results = $response_object->PricePackage; // This is array of objects
        //echo  $applicant_institution;
        //Loop to all Subject in $applicant_diploma_results
        



  
        
        
        	
        foreach ($applicant_diploma_results as $key=>$value){
			
         $ItemCodee = $value->ItemCode;
		 $ItemCode = str_replace("'", "", $ItemCodee);
		 $PriceCodee = $value->PriceCode;
		 $PriceCode = str_replace("'", "", $PriceCodee);
		 $LevelPriceCodee = $value->LevelPriceCode;
		 $LevelPriceCode = str_replace("'", "", $LevelPriceCodee);
         $OldItemCodee =$value->OldItemCode;
		 $OldItemCode = str_replace("'", "", $OldItemCodee);
         $ItemTypeIDe = $value->ItemTypeID;
		 $ItemTypeID = str_replace("'", "", $ItemTypeIDe);
         $ItemNamee =$value->ItemName;
		 $ItemName = str_replace("'", "", $ItemNamee);
         $Strengthe =$value->Strength;
		 $Strength = str_replace("'", "", $Strengthe);
         $Dosagee = $value->Dosage;
		 $Dosage = str_replace("'", "", $Dosagee);
         $PackageIDe = $value->PackageID;
		 $PackageID = str_replace("'", "", $PackageIDe);
          $SchemeIDe = $value->SchemeID;
		  $SchemeID = str_replace("'", "", $SchemeIDe);
         $FacilityLevelCodee =$value->FacilityLevelCode;
		 $FacilityLevelCode = str_replace("'", "", $FacilityLevelCodee);
         $UnitPricee = $value->UnitPrice;
		 $UnitPrice = str_replace("'", "", $UnitPricee);
         $IsRestrictede = $value->IsRestricted;
		 $IsRestricted = str_replace("'", "", $IsRestrictede);
         $MaximumQuantitye = $value->MaximumQuantity;
		 $MaximumQuantity = str_replace("'", "", $MaximumQuantitye);
         $AvailableInLevelse =$value->AvailableInLevels;
		 $AvailableInLevels = str_replace("'", "", $AvailableInLevelse);
         $PractitionerQualificationse = $value->PractitionerQualifications;
		 $PractitionerQualifications = str_replace("'", "", $PractitionerQualificationse);
         $IsActivee =$value->IsActive;
		 $IsActive = str_replace("'", "", $IsActivee);
       $con=new mysqli("localhost","root","","stockform");
        	echo $sql = "INSERT INTO `facility`(`ItemCode`, `PriceCode`,`LevelPriceCode`, `OldItemCode`, `ItemTypeID`, `ItemName`, `Strength`, `Dosage`, `PackageID`, `SchemeID`,`FacilityLevelCode`,`UnitPrice`, `IsRestricted`, `MaximumQuantity`, `AvailableInLevels`,`PractitionerQualifications`,`IsActive`) VALUES 
        	('$ItemCode','$PriceCode','$LevelPriceCode','$OldItemCode','$ItemTypeID','$ItemName','$Strength','$Dosage','$PackageID','$SchemeID','$FacilityLevelCode','$UnitPrice','$IsRestricted','$MaximumQuantity','$AvailableInLevels','$PractitionerQualifications','$IsActive')";
    	
     $res=$con->query($sql);
            
        }
?>