<header>
	<div class="nav">
		<div class="nav-logo">
			<div>
				<img src="img/logo.png">
			</div>
			<div>
				<a href="index.php"><h2>WriteBlog</h2></a>
			</div>
		</div>
		
		<div class="nav-login">
			<?php if($PROFILE) { ?>
				<div class="active">
					<div class="profile-h">
						<img src="<?php echo $PROFILE[3]; ?>">
					</div>
					<div class="menu">
						<h3><?php echo $PROFILE[2] ?><br>
						<span>Web Developer Fullstack</span>
						</h3>
						<ul>
							<li>
							<img src="img/profile.png">
							<a href="#">Profile</a>
							</li>
							<li>
							<img src="img/logout.png">
							<a href="logout.php">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			<?php } else { ?>
				<div>
					<a href="login.php">Sign in</a>
				</div>
			<?php } ?>	
		</div>
	</div>
</header>