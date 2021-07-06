<header>
	<div class="header">
		<h1 class="logo"><a href="index.php">NewGallery</a></h1>
		<nav>
			<a href="index.php">
				<h2 class="navButton">Main</h2>
			</a>
			<?php
				if ($_SESSION['user']) {
					$navs = ['Upload', 'Profile', 'Logout'];
					$navLinks = ['upload.php', 'profile.php', 'php/logout.php'];
				} else {
					$navs = ['Sign in', 'Join us'];
					$navLinks = ['login.php', 'register.php'];
				}
				for ($i=0; $i <= count($navs); $i++) { 
					echo "<a href='" . $navLinks[$i] . "'>";
					echo " <h2 class='navButton'>" . $navs[$i] . "</h2> </a>";
				}
			?>
		</nav>
	</div>
</header> 