<html>
<head>
<title>Accessing Cookies with PHP</title>
</head>
<body>
<?php
  if( isset($_COOKIE["userid"]))
    echo "Welcome " . $_COOKIE["userid"] . "<br />";
  else
    echo "Sorry... Not recognized" . "<br />";
?>
</body>
</html>