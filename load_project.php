<?php
include("db.php");

if(isSet($_COOKIE['userid']))
{
    $id=$_COOKIE['userid'];

$sql="SELECT DISTINCT project FROM task where userid='$id' ORDER BY project";
$result=mysql_query($sql);
echo "<select id='p'>";
while($row = mysql_fetch_array($result)){
echo "<option value=".$row['project'].">".$row['project']."</option>";
}
echo "</section>";
}
else{
    echo 'login first';
}
?>