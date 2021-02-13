<?php

use App\Kernel;

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<title><?= getenv("APP_NAME") ?></title>
</head>
<body>


<div class="container">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
			<a class="navbar-brand" href="<?= Kernel::route("/") ?>">Task List</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="d-flex">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<? if (!Kernel::isLoggedIn()) : ?>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="<?= Kernel::route("/login") ?>">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= Kernel::route("/register") ?>">Register</a>
						</li>
						<? else : ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?= Kernel::user()->name?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="<?= Kernel::route("/admin") ?>">Dispatch board</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="<?= Kernel::route("/logout") ?>">Logout</a></li>
							</ul>
						</li>
						<? endif; ?>
					</ul>
			</div>
		</div>
	</div>
</nav>
