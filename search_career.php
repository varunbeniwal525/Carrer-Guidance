<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['user_login'])==0)
    {   
header('location:login.php');
}
$find="%{$_POST['course_name']}%";
$find2="%{$_POST['sub_course']}%";
$find3="%{$_POST['sub_coursecat']}%";
if(isset($_GET['action'])){
    $id=intval($_GET['id']);
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
		<h3>Career Options</h3>
		<p>Choose one of them</p>

	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li><a href="index.html">Home</a><span>|</span></li>
				<li>Choose Course</li>
			</ul>
		</div>
	</div>
	
				
				<!-- /inner_content -->
	<div class="inner_content_info_agileits">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">Select Career option </h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				<div class="col-md-8 job_info_left">
					
				<?php
						$query=mysqli_query($conn,"select test_quiz.*,courses.coursename,sub_course.sub_course,sub_category.sub_coursecat from test_quiz join courses on courses.id=test_quiz.courseid join sub_course on sub_course.id=test_quiz.categoryid join sub_category on sub_category.id=test_quiz.sub_courseid where test_quiz.courseid like '$find' and test_quiz.categoryid like '$find2' and test_quiz.sub_courseid like '$find3'");

while($row=mysqli_fetch_array($query))
{
		$coursename = $row['coursename'];
		$sub_course = $row['sub_course'];
		$sub_coursecat = $row['sub_coursecat'];
	 	$title   = $row['title'];
        $total   = $row['total'];
        $correct = $row['correct'];
        $wrong   = $row['wrong'];
        $time    = $row['ctime'];
        $eid     = $row['eid'];



	$q12 = mysqli_query($conn, "SELECT score FROM history WHERE eid='$eid' AND username='".$_SESSION['username']."'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        if ($rowcount == 0) {
        echo '
				<div class="tab_grid_prof">
						<div class="col-sm-3 loc_1">
							<a href="#"><img src="images/test.png" alt=""></a>
						</div>
						
						<div class="col-sm-9">
							<div class="location_box1">
								<h6>'. $title.'</h6>
								<span class="m_2_prof">'.$coursename.' | '. $sub_course .' | '. $sub_coursecat .'</span>
								<div class="person-info">
									<ul>
										<p>Test Details</p>

										<li><span>Total question</span>: '. $total.'</li>
										<li><span>Correct Answer</span>: + '. $correct.'</li>
										<li><span>Wrong Answer</span>: - '. $wrong.'</li>
										<li><span>Time limit</span>:'. $ctime.' min</li>
										<li><span>Total Marks</span>: '.$total * $correct.'</li>
									</ul>
								</div>
								<div class="read"><a href="test.php?q=quiz&step=2&eid=' . $eid. '&n=1&t=' . $total . '&start=start" class="read-more"> Start Test  </a></div>
								<ul class="top-btns">
									<li><a href="#" class="fa fa-plus toggle"></a></li>
									<li><a href="#" class="fa fa-star"></a></li>
									<li><a href="#" class="fa fa-link"></a></li>
								</ul>

							</div>
						</div>
					
						<div class="clearfix"> </div>
					</div> ';
					
					} else {
            $q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $timec  = $row['timestamp'];
                $status = $row['status'];
            }
            $q = mysqli_query($conn, "select test_quiz.*,courses.coursename,sub_course.sub_course,sub_category.sub_coursecat from test_quiz join courses on courses.id=test_quiz.courseid join sub_course on sub_course.id=test_quiz.categoryid join sub_category on sub_category.id=test_quiz.sub_courseid WHERE test_quiz.eid='$eid' and test_quiz.courseid like '$find' and test_quiz.categoryid like '$find2' and test_quiz.sub_courseid like '$find3' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $ttimec  = $row['ctime'];
                $qstatus = $row['status'];
            }
            $remaining = (($ttimec * 60) - ((time() - $timec)));
            if ($remaining > 0 && $qstatus == "0" && $status == "ongoing") {
                echo '
				<div class="tab_grid_prof">
						<div class="col-sm-3 loc_1">
							<a href="#"><img src="images/test.png" alt=""></a>
						</div>
						
						<div class="col-sm-9">
							<div class="location_box1">
								<h6>'. $title.'</h6>
								<span class="m_2_prof">'.$coursename.' | '. $sub_course .' | '. $sub_coursecat .'</span>
								<div class="person-info">
									<ul>
										<p>Test Details</p>

										<li><span>Total question</span>: '. $total.'</li>
										<li><span>Correct Answer</span>: + '. $correct.'</li>
										<li><span>Wrong Answer</span>: - '. $wrong.'</li>
										<li><span>Time limit</span>:'. $ctime.' min</li>
										<li><span>Total Marks</span>: '.$total * $correct.'</li>
									</ul>
								</div>
								<div class="read"><a href="test.php?q=quiz&step=2&eid=' . $eid. '&n=1&t=' . $total . '&start=start" class="read-more"> Continue Test  </a></div>
								<ul class="top-btns">
									<li><a href="#" class="fa fa-plus toggle"></a></li>
									<li><a href="#" class="fa fa-star"></a></li>
									<li><a href="#" class="fa fa-link"></a></li>
								</ul>

							</div>
						</div>
					
						<div class="clearfix"> </div>
					</div> ';

					} else {

						echo '
				<div class="tab_grid_prof">
						<div class="col-sm-3 loc_1">
							<a href="#"><img src="images/test.png" alt=""></a>
						</div>
						
						<div class="col-sm-9">
							<div class="location_box1">
								<h6>'. $title.'</h6>
								<span class="m_2_prof">'.$coursename.' | '. $sub_course .' | '. $sub_coursecat .'</span>
								<div class="person-info">
									<ul>
										<p>Test Details</p>

										<li><span>Total question</span>: '. $total.'</li>
										<li><span>Correct Answer</span>: + '. $correct.'</li>
										<li><span>Wrong Answer</span>: - '. $wrong.'</li>
										<li><span>Time limit</span>:'. $ctime.' min</li>
										<li><span>Total Marks</span>: '.$total * $correct.'</li>
									</ul>
								</div>
								<div class="read"><a href="test.php?q=result&eid=' .$eid . '"  class="read-more"> View Result  </a></div>
								<ul class="top-btns">
									<li><a href="#" class="fa fa-plus toggle"></a></li>
									<li><a href="#" class="fa fa-star"></a></li>
									<li><a href="#" class="fa fa-link"></a></li>
								</ul>

							</div>
						</div>
					
						<div class="clearfix"> </div>
					</div> ';
					} } }?>
				
				</div>
				<div class="clearfix"></div>
			
			</div>
		</div>
	</div>
	<!-- //inner_content -->
		
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