<html>
<body>
<?php
error_reporting (E_ALL ^ E_NOTICE);
$con = mysql_connect("mysql-user.cse.msu.edu","siddiq39","CSE476");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("siddiq39", $con);
$result = mysql_query("SELECT * FROM Filedata");
$row= mysql_fetch_array($result,MYSQL_ASSOC);


if(!empty($_POST))
{

	if(isset($_POST['backbutton'] ))
	{
		$pr= mysql_query("SELECT * FROM Filedata WHERE ID =" .$_POST['count1']);
		$row =mysql_fetch_array($pr,MYSQL_ASSOC);
	}
	elseif(isset($_POST['nextbutton'] ))
	{
		$pr= mysql_query("SELECT * FROM Filedata WHERE ID =" .$_POST['count2']);
		$row =mysql_fetch_array($pr,MYSQL_ASSOC);
	}
}




echo "Title: ". $row['Title'];
echo "<br />";
echo "Comment: ". $row['Comment'];
echo "<br />";

echo "<html><img src=" . ("Upload/".$row['Path']) . " /></html>";

echo "<br />";
echo "<br />";

if(!($row['ID']==mysql_num_rows($result)))
	$nextcount= $row['ID'] +1;
else
	$nextcount=1;

if($row['ID']!=1)
	$backcount= $row['ID'] -1;
else
	$backcount=mysql_num_rows($result);


echo'<form action="new.php" method="post" enctype="multipart/form-data">';
echo '<input type="hidden" value= "'.$backcount.'" name="count1">';
echo'<input type="submit" value= "<-- BACK" NAME= "backbutton">';
echo '<input type="hidden" value= "'.$nextcount.'" name="count2">';
echo'<input type="submit" value="NEXT-->" name= "nextbutton">';
echo'</form>';

	
mysql_close($con);

?>

<html>
<body>