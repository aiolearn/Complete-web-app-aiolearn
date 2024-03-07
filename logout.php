<?php
session_start();
$_SESSION['mobile']='';
setcookie('mobile', '', time() + (86400 * 30), "/");
echo '
    <meta http-equiv="refresh" content="0; url=index.php">
';

?>