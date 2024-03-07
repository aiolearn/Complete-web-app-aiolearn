<?php
session_start();

require("db.php");

date_default_timezone_set("Asia/Tehran");
$date1= date("Y/m/d h:i:s" , time() - 3600);






// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image


if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  $uploadOk = 1;

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/img.jpg")) {
      // echo "آپلود عکس با موفقیت انجام شد.";

  } else {

      echo "آپلود با خطا مواجه شد.";
  }
}









?>



<html dir="rtl">
    <head>


      <link rel="icon" type="image/png" href="icon.png">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta charset="UTF-8">
      <link href="css/bootstrap.min.css" rel="stylesheet" >

      <link rel="stylesheet" href="css/aiolearn.css">

      <script src="js/bootstrap.min.js"  ></script>

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />


    </head>

    <body>




      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Hello</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              hi there...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>








      
       <div style="text-align: center;">
        


            <!-- <p  class="alert alert-warning" >
              سلام من یک آیولرنی هستم و تمام تمریناتمو انجام میدم.
            </p> -->


            <nav class="navbar navbar-expand-lg bg-body-tertiary">
              <div class="container-fluid">
                <a class="navbar-brand" href="upload.php">آپلود مدارک</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active" style="direction: ltr;" aria-current="page" href="#"><?php  echo $date1  ?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="home.php">خانه</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">آپلود مدارک</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">خروج</a>
                    </li>
                   
                 
                  </ul>
                  <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form> -->
                </div>
              </div>
            </nav>

            <br>
    
         


<div style="display: block;  overflow: hidden;">


<div class="row">
<div class="col-3">


</div>

<div class="col-6">

<img src="uploads/img.jpg" width="100%">

<br>
<br>


<form action="upload.php" method="post" enctype="multipart/form-data">
  تصویر خود را انتخاب کنید:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" class="btn btn-success" value="آپلود تصویر" name="submit">
</form>


</div>


<div class="col-3">


</div>

</div>


</div>



</div>

 
    </body>
</html>    