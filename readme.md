<h1 align="center">Welcome to Full aiolearn Project! 👋</h1>
# Full aiolearn Project

In this project, we created a web application with html, css, php and javascript. This project has a registration page, a login page and a home page. On the main page, we can display users and we can store a book with details in the database and display it on the main page, and through the main page we can delete the book in the database so that it is not displayed on the main page.

## Skills

To do this project, we must be familiar with html, css, php, javascript and database. Next, we analyze the codes

## Usage

On the login page, we use Ajax to see if the entered information is available in the database and save the information in a file called Ajax. We will see the code of this part later.

```javascript
// ajax
function send() {
  document.getElementById("error1").style.display="none";
  document.getElementById("btn_send").disabled=true;
  document.getElementById("btn_send").textContent="در حال پردازش...";


    user=document.getElementById('user').value;
    pass=document.getElementById('pass').value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       console.log(this.responseText);
        let ok = this.responseText;



        document.getElementById("btn_send").disabled=false;
        document.getElementById("btn_send").textContent="ورود به اپلیکیشن";


        if (ok=='1'){
          document.getElementById("error1").style.display="none";
          document.getElementById("ok1").style.display="block";
          window.location.assign("home.php");
        }

        if (ok=='0'){
           document.getElementById("error1").style.display="block";
           document.getElementById("ok1").style.display="none";
        }

      }
    };


    xmlhttp.open("GET", "ajax.php?user=" + user + "&pass=" + pass, true);
    xmlhttp.send();
 
}
```
```php
$ok=false;
if (isset($_GET["user"])){
  $user=$_GET["user"];
  $pass=$_GET["pass"];
  $sql = mysqli_query($db , " select * from user where username='$user' and pass='$pass' " );
  if ( $row = mysqli_fetch_assoc($sql) ){
    $mobile=$row['mobile'];
    $username=$row['username'];
    $ok=true;
    setcookie('mobile', $mobile , time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('namefull', $username , time() + (86400 * 30), "/"); // 86400 = 1 day
  } 
}

if ($ok==true){
echo '1';
}else{
echo '0';
}
```

But if the information is not available, the user must save his information in the database through the registration page and then he will be transferred to the login page to log in. We will see the relevant code later.

```php
$user_db='';
$pass_db='';
$ok=false;
$error='-';
if (isset($_POST["user"])){
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  $namefull = $_POST["namefull"];
  $mobile = $_POST["mobile"];
  if (strlen($namefull)<5 || strlen($namefull)>50 ){
    $error='نام و نام خانوادگی را درست وارد کنید.';
  }
  if (strlen($mobile)<11 || strlen($mobile)>11 ){
      $error='شماره موبایل را درست وارد کنید، مثال : 09121234567'; 
  }
  if (substr($mobile,0,2) !='09'){
      $error='شماره موبایل نادرست است، مثال : 09121234567';
  }
  if ($error=='-'){
    mysqli_query($db,"insert into user (username , pass, namefull , mobile) values ('$user' , '$pass' , '$namefull' , '$mobile' ); ");
  }
}


if ($ok == true){
          echo ' 
          <div class="alert alert-success text-center">
          شما با موفقیت وارد اپلیکیشن شدید :)
          </div>  
          <meta http-equiv="refresh" content="2; url=home.html">
          ';
        }else{
          if ($error<>'-'){
            echo ' 
            <div class="alert alert-danger text-center">
              '.  $error  .'
            </div>  
            ';
          }
        }
```

After the users move to the main page, we display the information of the users and we have put a section to add the book to the database, and after adding the book to the database, we display it in a table on the main page.

```php
// Editing the title, deleting the book in the database and not displaying the book on the main page
if (isset($_GET['del'])){
  $book_del_id=$_GET['del'];
  $sql=mysqli_query($db,"update books set del='1' where id='$book_del_id'");
}

// Add book
if (isset($_GET['bookname'])){
  $bookname=$_GET['bookname'];
  $booktedad=$_GET['booktedad'];
  $booksal=$_GET['booksal'];
  $sql=mysqli_query($db," insert into books (`book_name` , `book_pages` , `book_year`) values ('$bookname','$booktedad','$booksal') ");
}


// Show user
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

// show books
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
```

On this page, we delete the cookies to set the exit operation
```php
session_start();
$_SESSION['mobile']='';
setcookie('mobile', '', time() + (86400 * 30), "/");
echo '
    <meta http-equiv="refresh" content="0; url=index.php">
';
```

We get the photo from the user on the upload page and then store it in the uploads folder

```php
if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  $uploadOk = 1;

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/img.jpg")) {
      // echo "correct";

  } else {

      echo "Error";
  }
}
```
## Result

This project was written by Majid Tajanjari and the Aiolearn team, and we need your support!❤️

# پروژه کامل آیولرن

در این پروژه یک وب اپلیکیشن با html، css، php و جاوا اسکریپت ایجاد کردیم. این پروژه دارای صفحه ثبت نام، صفحه ورود و صفحه اصلی می باشد. در صفحه اصلی می توانیم کاربران را نمایش دهیم و می توانیم کتابی را با جزئیات در دیتابیس ذخیره کرده و در صفحه اصلی نمایش دهیم و از طریق صفحه اصلی می توانیم کتاب را در پایگاه داده حذف کنیم تا در پایگاه اصلی نمایش داده نشود. صفحه

## مهارت ها

برای انجام این پروژه باید با html, css, php, javascript و database آشنا باشیم. در مرحله بعد، کدها را تجزیه و تحلیل می کنیم

## نحوه استفاده

در صفحه ورود از Ajax استفاده می کنیم تا ببینیم اطلاعات وارد شده در پایگاه داده موجود است یا خیر و اطلاعات را در فایلی به نام Ajax ذخیره می کنیم. در ادامه کد این قسمت را خواهیم دید.

```javascript
// ajax
function send() {
  document.getElementById("error1").style.display="none";
  document.getElementById("btn_send").disabled=true;
  document.getElementById("btn_send").textContent="در حال پردازش...";


    user=document.getElementById('user').value;
    pass=document.getElementById('pass').value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       console.log(this.responseText);
        let ok = this.responseText;



        document.getElementById("btn_send").disabled=false;
        document.getElementById("btn_send").textContent="ورود به اپلیکیشن";


        if (ok=='1'){
          document.getElementById("error1").style.display="none";
          document.getElementById("ok1").style.display="block";
          window.location.assign("home.php");
        }

        if (ok=='0'){
           document.getElementById("error1").style.display="block";
           document.getElementById("ok1").style.display="none";
        }

      }
    };


    xmlhttp.open("GET", "ajax.php?user=" + user + "&pass=" + pass, true);
    xmlhttp.send();
 
}
```

```php
$ok=false;
if (isset($_GET["user"])){
  $user=$_GET["user"];
  $pass=$_GET["pass"];
  $sql = mysqli_query($db , " select * from user where username='$user' and pass='$pass' " );
  if ( $row = mysqli_fetch_assoc($sql) ){
    $mobile=$row['mobile'];
    $username=$row['username'];
    $ok=true;
    setcookie('mobile', $mobile , time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('namefull', $username , time() + (86400 * 30), "/"); // 86400 = 1 day
  } 
}

if ($ok==true){
echo '1';
}else{
echo '0';
}
```

اما در صورت در دسترس نبودن اطلاعات کاربر باید از طریق صفحه ثبت نام اطلاعات خود را در دیتابیس ذخیره کند و سپس برای ورود به صفحه ورود منتقل می شود که در ادامه کد مربوطه را مشاهده خواهیم کرد.

```php
$user_db='';
$pass_db='';
$ok=false;
$error='-';
if (isset($_POST["user"])){
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  $namefull = $_POST["namefull"];
  $mobile = $_POST["mobile"];
  if (strlen($namefull)<5 || strlen($namefull)>50 ){
    $error='نام و نام خانوادگی را درست وارد کنید.';
  }
  if (strlen($mobile)<11 || strlen($mobile)>11 ){
      $error='شماره موبایل را درست وارد کنید، مثال : 09121234567'; 
  }
  if (substr($mobile,0,2) !='09'){
      $error='شماره موبایل نادرست است، مثال : 09121234567';
  }
  if ($error=='-'){
    mysqli_query($db,"insert into user (username , pass, namefull , mobile) values ('$user' , '$pass' , '$namefull' , '$mobile' ); ");
  }
}


if ($ok == true){
          echo ' 
          <div class="alert alert-success text-center">
          شما با موفقیت وارد اپلیکیشن شدید :)
          </div>  
          <meta http-equiv="refresh" content="2; url=home.html">
          ';
        }else{
          if ($error<>'-'){
            echo ' 
            <div class="alert alert-danger text-center">
              '.  $error  .'
            </div>  
            ';
          }
        }
```

پس از اینکه کاربران به صفحه اصلی رفتند، اطلاعات کاربران را نمایش می دهیم و بخشی برای افزودن کتاب به پایگاه داده قرار داده ایم و پس از افزودن کتاب به پایگاه، آن را در جدولی در صفحه اصلی نمایش می دهیم.

```php
// Editing the title, deleting the book in the database and not displaying the book on the main page
if (isset($_GET['del'])){
  $book_del_id=$_GET['del'];
  $sql=mysqli_query($db,"update books set del='1' where id='$book_del_id'");
}

// Add book
if (isset($_GET['bookname'])){
  $bookname=$_GET['bookname'];
  $booktedad=$_GET['booktedad'];
  $booksal=$_GET['booksal'];
  $sql=mysqli_query($db," insert into books (`book_name` , `book_pages` , `book_year`) values ('$bookname','$booktedad','$booksal') ");
}


// Show user
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

// show books
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
```

در این صفحه کوکی ها را برای تنظیم عملیات خروج حذف می کنیم

```php
session_start();
$_SESSION['mobile']='';
setcookie('mobile', '', time() + (86400 * 30), "/");
echo '
    <meta http-equiv="refresh" content="0; url=index.php">
';
```

We get the photo from the user on the upload page and then store it in the uploads folder

```php
if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

  $uploadOk = 1;

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/img.jpg")) {
      // echo "correct";

  } else {

      echo "Error";
  }
}
```

## نتیجه

این پروژه توسط مجید تجن جاری و تیم Aiolearn نوشته شده است و ما به حمایت شما نیازمندیم!❤️