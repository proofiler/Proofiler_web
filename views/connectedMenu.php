<nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-light bg-light">
	<a class="font-weight-bold navbar-brand" href="#">Pr00filer</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item"><a class="nav-link" href="<?= URL ?>">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="<?= URL.'gestion' ?>">Gestion</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dashboard</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?= URL.'dashboard/information' ?>">Information</a>
					<a class="dropdown-item" href="<?= URL.'dashboard/top' ?>">TOP 10 viruses</a>
				</div>
			</li>
			<li class="nav-item dropdown">
        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CRUDs</a>
        		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
        			<a class="dropdown-item" href="<?= URL.'crud/admins' ?>">CRUD Admins</a>
					<a class="dropdown-item" href="<?= URL.'crud/extensions' ?>">CRUD Extensions</a>
					<a class="dropdown-item" href="<?= URL.'crud/employees' ?>">CRUD Employees</a>
					<a class="dropdown-item" href="<?= URL.'crud/stations' ?>">CRUD Stations</a>
					<a class="dropdown-item" href="<?= URL.'crud/usbs' ?>">CRUD USBs</a>
					<a class="dropdown-item" href="<?= URL.'crud/scans' ?>">CRUD Scans</a>
					<a class="dropdown-item" href="<?= URL.'crud/viruses' ?>">CRUD Viruses</a>
        		</div>
      		</li>
			<li class="nav-item"><a class="nav-link" href="<?= URL.'logout' ?>">Log out</a></li>
		</ul>
	</div>
</nav>
