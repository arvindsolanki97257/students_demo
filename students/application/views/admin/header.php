<nav class="navbar navbar-static-top main-header" >
	<a href="#" class="sidebar-toggle main-header" data-toggle="push-menu" role="button">Welcome, <?php echo $_SESSION["user_session"]["username"];?></a>

	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">

			<li class="dropdown user user-menu">
				<a href="javascript:void(0);" title="Click here to Log out" onclick="javascript:logoutUser();" class="main-header"> Log out <i class="fa fa-sign-out"></i></a>
			</li>
		</ul>
	</div>
</nav>