
<?php
session_start();
error_reporting(0);
include('connection.php');
if(strlen($_SESSION['user_login'])==0)
    {   
header('location:index.php');
}
else{
	if(isset($_POST['update']))
	{
		$fname=$_POST['fname'];
		$contactno=$_POST['mobile'];
		$address=$_POST['address'];
		$query=mysqli_query($conn,"update users set fullname='$fname',mobile='$contactno',address='$address' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your Profile info has been updated');</script>";
		}
	}


//password change

if(isset($_POST['submit']))
{
$sql=mysqli_query($conn,"SELECT password FROM users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($conn,"update users set password='".md5($_POST['newpass'])."' where id='".$_SESSION['id']."'");
echo "<script>alert('Password Changed Successfully !!');</script>";
}
else
{
	echo "<script>alert('Current Password not match !!');</script>";
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
		<h3>User Dashboard</h3>
		<p>User details</p>

	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li><a href="index.html">Home</a><span>|</span></li>
				<li>Single Page</li>
			</ul>
		</div>
	</div>
	<!--//w3_short-->
	<!-- /inner_content -->
	<div class="inner_content_info_agileits">
		<div class="container">
			<div class="tittle_head_w3ls">
				<h3 class="tittle">User Account Details </h3>
			</div>
			<div class="inner_sec_grids_info_w3ls">
				<div class="col-md-8 job_info_left">
					<div class="single-left1">
						<img src="images/career-guidance.jpg" alt=" " class="img-responsive" style="box-shadow: 0 0px 40px -10px rgba(0, 0, 0, 0.7)!important;padding: 8px!important;" />
						<h3>Find your career options with us.</h3>
						
					</div>
				<?php
						$query=mysqli_query($conn,"select test_quiz.*,courses.coursename,sub_course.sub_course,sub_category.sub_coursecat from test_quiz join courses on courses.id=test_quiz.courseid join sub_course on sub_course.id=test_quiz.categoryid join sub_category on sub_category.id=test_quiz.sub_courseid where test_quiz.status= 'enabled' and test_quiz.sub_courseid ='".$_SESSION['sub_courseid']."'");

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
										<li><span>Time limit</span>:'. $time.' min</li>
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
            $q = mysqli_query($conn, "select test_quiz.*,courses.coursename,sub_course.sub_course,sub_category.sub_coursecat from test_quiz join courses on courses.id=test_quiz.courseid join sub_course on sub_course.id=test_quiz.categoryid join sub_category on sub_category.id=test_quiz.sub_courseid WHERE test_quiz.eid='$eid' and test_quiz.sub_courseid ='".$_SESSION['sub_courseid']."' ") or die('Error197');
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
										<li><span>Time limit</span>:'. $time.' min</li>
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
										<li><span>Time limit</span>:'. $time.' min</li>
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

						<h3><center>General Instruction for Test.</center></h3>

					<div class="admin">
						<p><i class="fa fa-quote-left" aria-hidden="true"></i> You are allowed to start the test whenever you want to. The timer would start only when you start the test. However remember that admin has full rights to disable the test at any time. So it is recommended to start the test at the prescribed time.
You can see the history of test taken and scores in the 'History' section.
To start the test, click on 'Start'.
Once the test is started the timer would run irrespective of your logged in or logged our status. So it is recommended not to logout before test completion.
To mark an answer you need to select it and press the <span style="color:yellow!important;font-size:16px!important;" class="fa fa-lock"></span> 'Lock' button. Upon locking, the selected answer would be displayed and the question will be marked "green"
To delete an answer press  <span style="color:red!important;font-size:16px!important;" class="fa fa-remove"></span>.
					<i class="fa fa-quote-right" aria-hidden="true"></i>	</p>
						
					</div>

				</div>
				<div class="col-md-4 job_info_right">
					<?php
$query=mysqli_query($conn,"select * from users where id ='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>
					<div class="widget_search">
						<img src="userimages/<?php echo $row['userimage'];?>" alt="" style="margin-bottom: 5%;">
						<div class="person-info">
									<ul>

										<li><span>Full Name</span>: <?php echo $row['fullname'];?></li>
										<li><span>Email Id</span>: <?php echo $row['email'];?></li>
										<li><span>Conatct No</span>: <?php echo $row['mobile'];?></li>
										<li><span>Address</span>: <?php echo $row['address'];?></li>
										
									</ul>
								</div>
					</div>
					<div class="widget_search">

						<h5 class="widget-title">Update Profile</h5>
						<div class="widget-content">
							<span>Enter Detail You want to update</span>
						<form method="post">
							<span>Full name</span>
							<input type="text" class="form-control jb_2" placeholder="Enter FullName" name="fname" value="<?php echo $row['fullname'] ?>" required=""  >
							<span>Mobile No</span>
							<input type="number" class="form-control jb_2" placeholder="Mobile no" name="mobile" value="<?php echo $row['mobile'] ?>" required="" >
							<span>Address</span>
							<input type="text" class="form-control jb_2" placeholder="Mobile no" name="address" value="<?php echo $row['address'] ?>" required="" >
							<input type="submit" value="Update" name="update">
							</form>
						</div>
					</div>
					
					<div class="widget_search">

						<h5 class="widget-title">Password Change</h5>
						<div class="widget-content">
							
						<form method="post">
							<span>Current Password</span>
							<input type="text" class="form-control jb_2" placeholder="Enter Current Password" name="cpass"  required=""  >
							<span>Enter New Password</span>
							<input type="number" class="form-control jb_2" placeholder="Enter New Password" name="newpass"  required="" >
							<span>Confirm Password</span>
							<input type="text" class="form-control jb_2" placeholder="Enetr Confirm Password" name="cnfpass" required="" >
							<input type="submit" value="Change" name="submit">
							</form>
						</div>
					</div>
				<!--	<div class="col_3 experience">
						<h3>Work Experiance</h3>
						<table class="table">
							<tbody>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Senior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Middle
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
								<tr class="unread checked">
									<td class="hidden-xs">
										<input type="checkbox" class="checkbox">
									</td>
									<td class="hidden-xs">
										Junior
									</td>
									<td>
										(56)
									</td>
								</tr>
							</tbody>
						</table>
					</div> -->
					
<?php } ?>
				</div>
				<div class="clearfix"></div>
			
			</div>
		</div>
	</div>
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