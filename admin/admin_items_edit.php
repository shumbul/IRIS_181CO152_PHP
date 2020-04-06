<?
session_start();
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}
require('../conf.php');

$itemid = $_GET['id'];

$sql = "SELECT * FROM items WHERE item_ID = '$itemid'";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Items Edit</title>
    
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
	$(document).ready(function() {
		$('#items-add-form').validate({
				rules: {
					itemname: {
						required: true
					},
					description: {
						required:true
					},
					itemstart: {
						required: true
					},
					itemclose: {
						required: true
					}
				},
				messages: {
					itemname: {
						required: "Enter an item name"
					},
					description: {
						required: "Give some description for this item"
					},
					itemstart: { 
                		required: "Choose an item start date"
            		},
					itemclose: { 
                		required: "Choose an item close date"
            		}
				},
	
				errorPlacement: function(error, element) {
					if (element.is(":checkbox")) {
						error.appendTo(element.next().next());
					}
					else {
						error.appendTo(element.parent().next());
					}
				},
						
				success: function(label) {
					label.addClass("valid");
				} 					
			});
		$("#itemclose").datetimepicker({
				dateFormat: 'yy/mm/dd',
				showSecond: true,
				timeFormat: 'hh:mm:ss',
				minDate: 0
		});
		$("#slider-range").slider({
			min: 0,
			max: 1,
			step: 0.1,
			slide: function(event, ui) {
				$("#itemincrement").val("S$" + ui.value);
			}
		});
		$('textarea.tinymce').tinymce({
			script_url : '../js/tiny_mce/tiny_mce.js',
			
			theme : 'advanced',
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			content_css : "../css/content.css",
			
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
			
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
    });
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
<h1>Edit Items Info</h1>
<form id="items-add-form" method="post" class="common-form" action="admin_items_edit_process.php?id=<? echo $itemid; ?>" enctype="multipart/form-data">
	
    <table>
    	<tr style="display:none">
    		<td class="label"><h4>Item ID</h4></td>
    		<td class="field"><input class="input" id="itemid" name="itemid" type="text" readonly="readonly" value="<? echo $row['item_ID']; ?>" /></td>
        	<td class="status"></td>
    	</tr>
        <tr style="display:none">
    		<td class="label"><h4>Item Path</h4></td>
    		<td class="field"><input class="input" id="itempath" name="itempath" type="text" readonly="readonly" value="<? echo $row['item_Path']; ?>" /></td>
        	<td class="status"></td>
    	</tr>
    	<tr>
    		<td class="label"><h4>Item Name</h4></td>
    		<td class="field"><input class="input" id="itemname" autofocus="autofocus" name="itemname" type="text" value="<? echo $row['item_Name']; ?>" /></td>
        	<td class="status"></td>
    	</tr>
        
    	<tr>
        	<td class="label"><h4>Item Description</h4></td>
    		<td class="field"><textarea id="description" required="required" name="description" rows="20" cols="60"  class="tinymce" style="-webkit-box-shadow: 0px 0px 5px 1px #dddddd;
	-moz-box-shadow: 0px 0px 5px 1px #dddddd; box-shadow: 0px 0px 5px 1px #dddddd;"><? echo $row['item_Description']; ?></textarea></td>
            <td class="status"></td>
        </tr>
        <tr>
    		<td class="label"><h4>Item Close Date</h4></td>
    		<td class="field"><input class="input" id="itemclose" name="itemclose" type="text" value="<? echo $row['item_Close_Date']; ?>" /></td>
        	<td class="status"></td>
    	</tr> 	
        <tr>
    		<td class="label"><h4>Item Increment</h4></td>
    		<td class="field"><input class="input" id="itemincrement" name="itemincrement" type="text" readonly="readonly" value="S$<? echo $row['item_Increment_Price']; ?>"/>
            <div id="slider-range" style="margin-top: 10px; width: 240px; margin-left: 0px;"></div></td>
        	<td class="status"></td>
    	</tr> 	
        <tr>
    		<td class="label"><h4>Image Upload</h4></td>
    		<td class="field"><input class="input" id="file" name="file" type="file" /></td>
        	<td class="status"></td>
    	</tr> 
      </table>
      <p class="button">
    <input type="image" src="../images/submit.png"  value="Submit" name="submit" id="submit" />
    </p>
    </form>
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
<?
mysqli_close($connect);
?>