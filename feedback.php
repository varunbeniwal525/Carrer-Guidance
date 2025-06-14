<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['user_login'])==0)
    {   
header('location:login.php');
}
else
{
		if(isset($_POST['submit']))
    {
        
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        $query=mysqli_query($conn, "INSERT INTO Feedback(name,subject,message) values ('".$_SESSION['username']."','$subject','$message')");
        if($query)
        {
echo "<script>alert('Your Feedback Submited Successfully!');</script>";
        }
    }
	?>
<!DOCTYPE html>
<html>

<head>
	<title>Online Career Guidance</title>
	<!--/tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Soft Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//tags -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //for bootstrap working -->
	<link href="//fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic'
	    rel='stylesheet' type='text/css'>
</head>

<body>
	<!-- header -->
	<?php include'header_part.php'; ?>

	<!-- banner -->
	<div class="inner_page_agile">
		<h3>Feedback</h3>
		<p>Add Feedback About us</p>

	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li><a href="index.html">Home</a><span>|</span></li>
				<li>FeedBack</li>
			</ul>
		</div>
	</div>
	<!--//w3_short-->
	<!-- /inner_content -->
	<div class="inner_content_info_agileits">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">Feed-Back Us</h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				
				
				<div class="clearfix"> </div>
				<div class="w3layouts_mail_grid">
					<form  method="post">
						<div class="col-md-6 wthree_contact_left_grid">
							
							<input type="text" name="subject" placeholder="Subject" required="">
						
							<textarea name="message" placeholder="Message..." required=""></textarea>
							
						
						<input type="submit" value="Submit" name="submit">
							</div>
						<div class="clearfix"> </div>

					</form>
				</div>


			</div>

		</div>
	</div>
	<!-- //mid-services -->
	

	<!-- //inner_content -->
	<!-- footer -->
	<?php include'footer.php'; ?>
	<!-- //footer -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>
<?php } ?>