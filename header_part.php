<?php if(strlen($_SESSION['user_login']))
    {   ?>

<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li>Welcome :<a href="index.html"> <?php echo ($_SESSION['username']);?></a><span>|</span></li>
				<li><a href="user_dash.php">Your Account</a> <span>|</span></li>
				<li><a href="user_history.php"> Your History </a> <span>|</span></li>
				<li><a href="logout.php">Log Out</a> </li>
			</ul>

		</div>
	</div>

		<?php } ?>
<div class="header" id="home">
		<div class="content white agile-info">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
						<a class="navbar-brand" href="index.php">
							<h1></span> Online <img src="images/c.png" height="60px" width="60px"> Guidance</h1>
						</a>
					</div>
					<!--/.navbar-header-->

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-2" id="link-effect-2">
							<ul class="nav navbar-nav">
								<li><a href="index.php" class="effect-3">Home</a></li>
							<!--	<li class="dropdown">
									<a href="services.php" class="dropdown-toggle effect-3" data-toggle="dropdown">Services <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="services.php">Services 2</a></li>
										<li class="divider"></li>
										<li><a href="services.php">Services 3</a></li>
										<li class="divider"></li>
										<li><a href="codes.php">Codes</a></li>
										<li class="divider"></li>
										<li><a href="icons.php">Icons</a></li>
										<li class="divider"></li>
										<li><a href="services.php">One more separated link</a></li>
									</ul>
								</li> -->
								<li><a href="services.php" class="effect-3">Services</a></li>

								<li><a href="login.php" class="effect-3">Log In</a></li>

								<li><a href="feedback.php" class="effect-3">FeedBack</a></li>

								<li><a href="contact.php" class="effect-3">Contact</a></li>
							</ul>
						</nav>
					</div>
					<!--/.navbar-collapse-->
					<!--/.navbar-->
				</div>
			</nav>
		</div>
	</div>