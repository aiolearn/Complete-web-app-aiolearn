<?php
session_start();

require("db.php");

date_default_timezone_set("Asia/Tehran");
$date1= date("Y/m/d h:i:s" , time() - 3600);

// Editing the title, deleting the book in the database and not displaying the book on the main page
if (isset($_GET['del'])){
  $book_del_id=$_GET['del'];
  $sql=mysqli_query($db,"update books set del='1' where id='$book_del_id'");
}





if (isset($_GET['bookname'])){
  $bookname=$_GET['bookname'];
  $booktedad=$_GET['booktedad'];
  $booksal=$_GET['booksal'];
  $sql=mysqli_query($db," insert into books (`book_name` , `book_pages` , `book_year`) values ('$bookname','$booktedad','$booksal') ");
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


<!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">اضافه کردن کتاب</h1>
        <button type="button" class="btn-close" style="margin: 0;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <form action="home.php" method="get">

      <div class="modal-body">
        
        
        <label for="bookname" class="form-label">نام کتاب</label>
        <input id="bookname" name="bookname" class="form-control">


        <br>

        <label for="booktedad" class="form-label">تعداد صفحه</label>
        <input id="booktedad" name="booktedad" class="form-control">


        <br>
<label for="booksal" class="form-label">سال چاپ</label>
        <input id="booksal" name="booksal"  class="form-control">


        <br>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
        <button type="submit" class="btn btn-success">ثبت کتاب</button>
      </div>


      

      </form>
    </div>
  </div>
</div>






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
                <a class="navbar-brand" href="aiolearn.html">خانه</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active" style="direction: ltr;" aria-current="page" href="#"><?php  echo $date1  ?></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">خانه</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="upload.php">آپلود مدارک</a>
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
    
             
            <div class="alert alert-success">
                <?php echo $_COOKIE['namefull'] ?>
              به خانه خوش آمدی
            </div>


<div>





</div>

<div class="div_table">
  
<h3>
 لیست کاربران
</h3>



<table class="table table-striped table-light table-bordered table1">
              <thead>
            <tr>
              <th>
                ردیف
              </th>
              <th>
               نام و نام خانوادگی
              </th>
              <th>
                نام کاربری
              </th>
              <th>
                موبایل
              </th>
</tr>
</thead>

<tbody>



<?php

$sql=mysqli_query($db,"Select * from user");
$i=0;
while($row=mysqli_fetch_assoc($sql)){
  $namefull=$row['namefull'];
  $username1=$row['username'];
  $mobile1=$row['mobile'];

  $i=$i+1;

    
  echo "
  <tr>
  <td>
    $i
  </td>
  <td>
    $namefull
  </td>
  <td>
    $username1
  </td>
  <td>
    $mobile1
  </td>
  </tr> "; 
}





?>






 
</tbody>
            </table>


</div>




<div class="div_table">
  
<h3>
  لیست کتاب های اپ
</h3>

            <table class="table table-striped table-light table-bordered table1">
              <thead>
            <tr>
              <th>
                ردیف
              </th>
              <th>
                نام کتاب
              </th>
              <th>
                تعداد صفحه
              </th>
              <th>
                سال چاپ
              </th>

              <th style="    width: 25%;">
                مدیریت کتاب ها
              </th>
</tr>
</thead>

<tbody>



<?php

$sql=mysqli_query($db,"Select * from books where del='0'");
$i=0;
while($row=mysqli_fetch_assoc($sql)){
  $book_name=$row['book_name'];
  $book_pages=$row['book_pages'];
  $book_year=$row['book_year'];
  $bood_id=$row['id'];
  $i=$i+1;
  echo "
  <tr>
    <td>
      $i
    </td>
    <td>
      $book_name
    </td>
    <td>
      $book_pages
    </td>
    <td>
      $book_year
    </td>

    <td>
      <a href=\"home.php?del=$bood_id\">

        <button class=\" btn btn-danger \" style=\"font-size:13px;  \" > 
        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash3-fill\" viewBox=\"0 0 16 16\">
        <path d=\"M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z\"/> 
        </svg> حذف
        </button>
      </a>

      <a href=\"home.php?del=$bood_id\">
        <button class=\" btn btn-primary \" style=\"font-size:13px;  \" > 
        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">
        <path d=\"M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z\"/>
        <path fill-rule=\"evenodd\" d=\"M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z\"/>
      </svg> ویرایش
        </button>
      </a>

      <button class=\" btn btn-success \" style=\"font-size:13px;  \"   data-bs-toggle=\"modal\" data-bs-target=\"#modal1\" > 
        اضافه کردن
      </button>
    </td>
  </tr> 
  "; 
}





?>






 
</tbody>
            </table>

         
  
</div>          
 

        </div>

 
    </body>
</html>    