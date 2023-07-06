
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
              <h6>In Patient </h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
               
              <div class="card-body">


              <form action="inpatient_details.php" method="GET">
                  <div class="form-group">
                    <label for="uname1">Patient Id</label> 
										<input class="form-control" id="uname1" name="p_id" required="" type="text">
                  </div>
                 
                  <div class="form-group">
                    <label for="uname1">Select date</label> 
										<input class="form-control" id="uname1" name="date" required="" type="date">
                  </div>
									<input class="btn btn-success btn-lg float-right" value="submit" name="submit" type="submit">
                </form>





                
               




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