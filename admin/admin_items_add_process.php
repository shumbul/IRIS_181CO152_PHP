<?php 
session_start();
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}
include("./admin_image_resize.php");
require("../conf.php");

$upload_folder = "../uploads/";

$itemname = $_POST['itemname'];
$description = $_POST['description'];

$itemclose = $_POST['itemclose'];
$itemincrement = $_POST['itemincrement'];
$imagepath = $upload_folder.$_FILES["file"]["name"];
$itemincrement = floatval(str_replace("S$","",$itemincrement));
  if ($_FILES["file"]["error"] > 0)
    {
	$error = 0;
    }
  else
    {

    if (file_exists($upload_folder . $_FILES["file"]["name"]))
      {
	  $error = 1;
      }
    else
      {
	  $error = 3; 
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $upload_folder . $_FILES["file"]["name"]);
	  $image = new SimpleImage();
	  $image->load($upload_folder. $_FILES["file"]["name"]);
	  $image->resize(195, 167);
	  $image->save($upload_folder. $_FILES["file"]["name"]);
	  $admin = $_SESSION['admin'];
	  $id_find = "SELECT * FROM admin WHERE admin_Name = '$admin'";
	  $result = mysqli_query($connect, $id_find);
	  $row = mysqli_fetch_array($result);
	  $adminid = $row['admin_ID'];
	  $sql = "INSERT INTO items(item_Name, item_Description, item_Close_Date, item_Increment_Price, item_Path, admin_ID) VALUES ('$itemname', '$description', '$itemclose', $itemincrement, '$imagepath', '$adminid')";
	  mysqli_query($connect, $sql);
	  mysqli_close($connect);
	  
      }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Items Management</title>
    
    <!-- Include CSS -->
    <link href="../css/reset.css" rel="stylesheet" type="text/css" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="./css/ajax.css" rel="stylesheet" type="text/css" />
    <link href="../css/slimbox2.css" rel="stylesheet" type="text/css" />
    <link href="../css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Oswald|Droid+Sans:400,700' rel='stylesheet' type='text/css' />

    <!-- Include Scripts -->
  	<script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.cycle.lite.min.js"></script>
    <script type="text/javascript" src="../js/jquery.pngFix.pack.js"></script>
    <script type="text/javascript" src="../js/jquery.color.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../js/hoverIntent.js"></script>
    <script type="text/javascript" src="../js/superfish.js"></script>
    <script type="text/javascript" src="../js/slimbox2.js"></script>
    <script type="text/javascript" src="../js/slides.min.js"></script>
    <script type="text/javascript" src="../js/custom.js"></script>	
    <script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="../js/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript">
		function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
} 
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
	
	</script>
    <meta charset="UTF-8"></meta>
	

</head>

<body>

<!-- START HEADER -->
<div id="header">

	<div class="container">
    
    	<div id="primary-nav" class="header-right">
        
            <ul class="sf-menu">
                <li class="current"><a href="./index.php">Home</a></li>
                <li><a href="./admin_members.php">Member Management</a></li>
                <li><a href="./admin_items.php">Items Management</a></li>
          	</ul>
        </div>
        
        <!-- LOGO -->        
    	<a href="../index.php"><img src="../images/logo.png" border="0" alt="SimpleAuction" /></a>
        
        
        
    </div>
    
</div><!-- END HEADER -->


<!-- HEADER DIVIDER -->
<div id="head-break">
<div class="outer">
<div class="announcement">
<h1>Items Management</h1>
<h1>Add / Edit / Delete Auction Items</h1>
</div>
</div>

</div><!-- END HEADER -->


<div class="centerBox">
<!-- START MAIN CONTAINER -->
<div class="container">
<div class="admin_info">
<br />
<h4>Items Add Message</h4>
<?
if ($error == 0) {
	echo "<h1>Error: " . $_FILES["file"]["error"] . "</h1>";
}
else if ($error == 1) {
	echo "<h1>Error: " . $_FILES["file"]["name"] . " already exists. </h1>";
}
else if ($error == 2) {
	echo "<h1>Error:  Invalid File</h1>";
}
else if ($error == 3) {
	echo "<h1>Item Adding Succeeded !!!</h1>";
?>
	<a href="./admin_items.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('back_button','','../images/buttons/back_hover.png',1)"><img src="../images/buttons/back.png" alt="Back" name="back_button" width="100" height="34" border="0" id="back_button" /></a>
<?	
}
?>
    </div>
</div>

</div><!-- END MAIN CONTAINER --><br class="clear" />
</div>

<!-- START FOOTER -->
<div id="footer">

  <div class="container">
    
      <div id="footer-right">
        
          Created for IRIS Code - 105<br />
            <strong>Shumbul Arifa</strong><br />
            
        </div>
        
        <br class="clear" />
    
  </div>
    
</div><!-- END FOOTER -->

</body>
</html>