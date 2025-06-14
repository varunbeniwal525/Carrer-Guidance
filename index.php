<?php
session_start();
error_reporting(0);
include('connection.php');
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
<script>
function getCat(val) {
    $.ajax({
    type: "POST",
    url: "Admin_side/get_category_course.php",
    data:'cat_id='+val,
    success: function(data){
        $("#category").html(data);
    }
    });
}
function getSubCat(val) {
    $.ajax({
    type: "POST",
    url: "Admin_side/get_sub_category.php",
    data:'sub_id='+val,
    success: function(data){
        $("#subcategory").html(data);
    }
    });
}
</script>

</head>

<body>
	<!-- header -->
	<?php include'header_part.php'; ?>
	<!-- banner -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1" class=""></li>
			<li data-target="#myCarousel" data-slide-to="2" class=""></li>
			
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<div class="container">
					<div class="carousel-caption">
						<h3>Find Your <span> Career.</span></h3>
						<p>Choose according to your goal.</p>
						<div class="agileits-button top_ban_agile">
							<a class="btn btn-primary btn-lg" href="services.php">Read More »</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item item2">
				<div class="container">
					<div class="carousel-caption">
						<h3>Make Sure While <span>Select Your Career.</span></h3>
						<p>Find Best Four Your Future.</p>
						<div class="agileits-button top_ban_agile">
							<a class="btn btn-primary btn-lg" href="services.php">Read More »</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item item3">
				<div class="container">
					<div class="carousel-caption">
						<h3>Test Your <span>Skills.</span></h3>
						<p>Test your Qulification</p>
						<div class="agileits-button top_ban_agile">
							<a class="btn btn-primary btn-lg" href="services.php">Read More »</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="fa fa-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="fa fa-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		<!-- The Modal -->
	</div>
	<!--//banner -->

	<!--/search_form -->
	<div id="search_form">
		<div class="row">
		<h2>Start your career search here</h2>
		<form  action="search_career.php" method="post">
			
			
			  <div class="form-group">
                               
                                <div class="col-md-3">
                                    <select name="course_name" class="form-control" onChange="getCat(this.value);"  required>
                                <option value="">Select Qualification</option> 
                                <?php 
                                $query=mysqli_query($conn,"select * from  courses");
                                while($row=mysqli_fetch_array($query))
                                {?>

                                <option value="<?php echo $row['id'];?>"><?php echo $row['coursename'];?></option>
                                <?php } ?>
                                </select>
                                    
                                </div>
                            </div>    

                            <div class="form-group">
                               
                                <div class="col-md-3">
                                    <select   name="sub_course" id="category" class="form-control" onchange="getSubCat(this.value);" required >
                                </select>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                
                                <div class="col-md-3">
                                    <select   name="sub_coursecat" id="subcategory" class="form-control" required>
                                </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
								<input type="submit" value="Find Career" class="btn btn-danger btn-lg">
								</div>
		</form>
	</div>
</div>
	<!--//search_form -->
	<div class="banner-bottom">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">About Us</h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				<div class="col-md-6 banner_bottom_left">
					<h4>Online <span>Career Guidance</span></h4>
					
					<p>We provide Different types of career options like for 10th pass out or 10th fails,12th pass out or 12th fails or may some other career option which can help a student to find their suitable career.</p>
					<p>Also, we offer a different type of online test quiz for students to check their skills online and decide that they can continue to particuler a career or not.</p>
					<ul class="some_agile_facts">
						<li><span class="fa fa-briefcase" aria-hidden="true"></span><label>20-30</label> Career Options</li>
						<li><span class="fa fa-graduation-cap" aria-hidden="true"></span><label>10-20</label>Online Test Quiz</li>
						<li><span class="fa fa-user" aria-hidden="true"></span><label>30-40</label> Students find their carrer</li>
						<li><span class="fa fa-line-chart" aria-hidden="true"></span><label>30</label> Happy Users</li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-6 banner_bottom_right">
					<div class="agileits_w3layouts_banner_bottom_grid">
						<img src="images/ca2.png" alt=" " class="img-responsive" />
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>

		</div>
	</div>
	<!-- //banner-bottom -->
	<div class="team_work_agile">
		<h4>Find your career options with us.</h4>
	</div>
	<!-- services -->
	<div class="services" id="services">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">Career Guidance Process</h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				<div class="col-md-3 services-left">
					<div class="services-left-top">

						<h5>First of All Create Profile</h5>

					</div>
					<div class="services-left-top services-left-top1">

						<h5>Login to Your Account</h5>

					</div>
				</div>
				<div class="col-md-6 services-middle">
					<div class="services-middle-img">
						<img src="images/ca3.png" alt="" />
					</div>
					<div class="services-middle-grids">
						<div class="col-md-6 services-middle-left">
							<div class="services-left-top">

								<h5>Search Which career option you want to Try</h5>

							</div>
						</div>
						<div class="col-md-6 services-middle-left">
							<div class="services-left-top">

								<h5>Select Test Quiz According to your career</h5>

							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-3 services-left">
					<div class="services-left-top">

						<h5>Check Your Result</h5>

					</div>
					<div class="services-left-top services-left-top1">

						<h5>Decide final career option</h5>

					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //services -->
	
	<!-- //testimonials -->
	<div class="testimonials_section">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">Feed-Backs</h3>
			</div>
			<?php 
                       $ret=mysqli_query($conn,"select * from feedback");
                           ?>
			<div class="inner_sec_grids_info_w3ls">
				<div id="Carousel" class="carousel slide two">
					
					<ol class="carousel-indicators second">
						<?php
                     $i = 0;
                     foreach ($ret as $row) {
                         $actives = '';
                         if($i == 0){
                        $actives = 'active';
                     }
                    ?>
						<li data-target="#Carousel" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>" ></li>
						<?php $i++;  } ?>
					</ol>

					<!-- Carousel items -->
					<div class="carousel-inner">
							<?php
                     $i = 0;
                     foreach ($ret as $row) {
                         $actives = '';
                         if($i == 0){
                        $actives = 'active';
                     }
                    ?>
						<div class="item <?= $actives; ?>" style="margin-bottom: 2%!important;">
							<div class="testimonials_grid_wthree">
								<img src="images/feedback.png" alt=" " class="img-responsive" height="100" width="100" />
								<h5><?= $row['subject']; ?></h5>
								<h4><i class="fa fa-quote-left" aria-hidden="true"></i> <?= $row['message']; ?></h4>
								
								<h5><?= $row['name']; ?></h5>

							</div>

						</div>
						
						<!--.item-->
							<?php $i++;  } ?>
					</div>
					<!--.carousel-inner-->

				</div>
				<!--.Carousel-->

			</div>
		</div>
	</div>
<!-- //testimonials -->
	








	<!-- footer -->
	<?php include'footer.php'; ?>
	<!-- //footer -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>