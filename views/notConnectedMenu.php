<nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-light bg-light">
	<a class="font-weight-bold navbar-brand" href="#">Pr00filer</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item"><a class="nav-link" href="<?= URL ?>">Home</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dashboard</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?= URL.'dashboard/information' ?>">Information</a>
					<a class="dropdown-item" href="<?= URL.'dashboard/top' ?>">TOP 10 viruses</a>
				</div>
			</li>
			<li class="nav-item"><a class="nav-link" href="<?= URL.'signin' ?>">Sign In</a></li>
		</ul>
	</div>
</nav>
