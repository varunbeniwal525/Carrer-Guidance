<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['user_login'])==0)
    {   
header('location:index.php');
}?>
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
		<h3>Your Results History</h3>
		<p>Check Result</p>

	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li><a href="index.html">Home</a><span>|</span></li>
				<li>Your Results History</li>
			</ul>
		</div>
	</div>
	<!--//w3_short-->
	<!-- /inner_content -->
	<div class="inner_content_info_agileits">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">Your History </h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				<div class="col-lg-12">
					<?php
$q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND status='finished' ORDER BY date DESC ") or die('Error197');
while ($row = mysqli_fetch_array($q)) {
        $eid = $row['eid'];
        $s   = $row['score'];
        $w   = $row['wrong'];
        $r   = $row['correct'];
        $q23 = mysqli_query($conn, "SELECT * FROM test_quiz WHERE  eid='$eid' ") or die('Error208');
        while ($row = mysqli_fetch_array($q23)) {
            $title = $row['title'];
            $total = $row['total'];

            $grade = $r / $total * 100;

            if ($grade >= 100) {
       $re =  'Cograts You are pass this exam. Grade : A';
     
      } else if (100 > $grade && $grade >= 60) {
       $re =  'Cograts You are pass this exam. Grade : B';
      
      } else if (60 > $grade && $grade >= 40) {
      $re =  'Cograts You are pass this exam. Grade : C';
      } else if (40 > $grade && $grade >= 20) {
      $re = 'You are pass this exam. Grade : D';
      } else if (20 > $grade && $grade >= 0) {
      $re =  'You Are Fail in this exam';
      }
            

}

				echo '	<div class="tab_grid_prof">
						<div class="col-md-3 loc_1">
							<a href="single.html"><img src="images/result.png" alt=""></a>
						</div>
						<div class="col-md-9">
							<div class="location_box1">
								<h6>
								<span class="m_2_prof">' . $title . '</span></h6>
								<div class="person-info">
									<ul>

										<li><span>Total Marks</span>:' . $total .'</li>
										<li><span>Correct Answer</span>: ' . $r . '</li>
										<li><span>Wrong Answer</span>: ' . $w . '</li>
										<li><span>Unattempted Questions</span>: ' . ($total - $r - $w) . '</li>

										<li><span>Total Score</span>: ' . $s . '</li>
										<li><span>Mark in percentage</span>: '.($r / $total * 100 ).' %
                        </li>
                        <li><span>Exam Result </span><b>: '.$re.' </b> </li>



									</ul>
								</div>
								<div class="read"><a href="test.php?q=result&eid=' . $eid . '" class="read-more"> View Result</a></div>
								

							</div>
						</div>
						<div class="clearfix"> </div>
					</div> ';
					

							    
					} ?>	
					

				</div>
				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //inner_content -->
	<!-- footer -->
	<div class="footer_top_agileits">
		<div class="container">
			<div class="col-md-4 footer_grid">
				<h3>About Us</h3>
				<p>Nam libero tempore cum vulputate id est id, pretium semper enim. Morbi viverra congue nisi vel pulvinar posuere sapien
					eros.
				</p>
			</div>
			<div class="col-md-4 footer_grid">
				<h3>Latest News</h3>
				<ul class="footer_grid_list">
					<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<a href="single.html" >Lorem ipsum neque vulputate </a>
					</li>
					<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<a href="single.html" >Dolor amet sed quam vitae</a>
					</li>
					<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<a href="single.html" >Lorem ipsum neque, vulputate </a>
					</li>
					<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<a href="single.html" >Dolor amet sed quam vitae</a>
					</li>
					<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<a href="single.html" >Lorem ipsum neque, vulputate </a>
					</li>
				</ul>
			</div>
			<div class="col-md-4 footer_grid">
				<h3>Contact Info</h3>
				<ul class="address">
					<li><i class="fa fa-map-marker" aria-hidden="true"></i>8088 USA, Honey block, <span>New York City.</span></li>
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>+09187 8088 9436</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<div class="footer_grids">
				<div class="col-md-4 footer_grid_left">
					<h3>Sign up for our Newsletter</h3>
				</div>
				<div class="col-md-8 footer_grid_right">

					<form action="#" method="post">
						<input type="email" name="Email" placeholder="Enter Email Address..." required="">
						<input type="submit" value="Submit">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="footer_w3ls">
		<div class="container">
			<div class="footer_bottom">
				<div class="col-md-9 footer_bottom_grid">
					<div class="footer_bottom1">
						<a href="index.html">
							<h2><span class="fa fa-signal" aria-hidden="true"></span> Soft <label>Hr Agency</label></h2>
						</a>
						<p>© 2017 Soft. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
					</div>
				</div>
				<div class="col-md-3 footer_bottom_grid">
					<h6>Follow Us</h6>
					<div class="social">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>

		</div>
	</div>
	<!-- //footer -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>