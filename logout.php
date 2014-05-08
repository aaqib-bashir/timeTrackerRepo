<?php
//$username=$_COOKIE["name"];
setcookie("name","",  time()-3600,"/","",0);
setcookie("userid","",  time()-3600,"/","",0);
    echo "logout successfully";
?>
