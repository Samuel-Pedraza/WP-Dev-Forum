<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php  get_header(); ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1>Hello World</h1>
			</div>
		</div>
	</div>
	<div class="container">
	 <div class="row">
			<div class="col-md-4 offset-md-4">
				<h3>Hello World</h3>
				<p><?php echo get_template_directory_uri() . '/assets/css/bootstrap.css' ?></p>
				<a href="/testomg">Error</a>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
</body>
</html>
