<!DOCTYPE html>
<html lang="en">
  <head>
    <!--- Unicode -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('bootstrap/ico/favicon.ico'); ?>">

    <title><?php echo $this->lang->line('system_system_name'); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
	<!-- public css: exists at root folder  --->


	<!-- jquery script -->	
    <script src="<?php echo base_url('jquery/jquery-1.11.3.js'); ?>"></script>	
    <script src="<?php echo base_url('jquery/jquery.validate.js'); ?>"></script>		
	<!-- Bottstrap script -->
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('js/site.js'); ?>"></script>				
  </head> 
  <body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="mynavbar-content">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url(); ?>">Home
					<span class="glyphicon glyphicon-home">	</span></a></li>
					<li><a href="<?php echo base_url('index.php/Movie'); ?>">Movie</a></li>
					<li><a href="<?php echo base_url('index.php/Nhac'); ?>">Music</a></li>
					<li><a href="<?php echo base_url('index.php/Forum/board'); ?>">Forum</a></li>					
				</ul>
			</div>
		</div>
	</div>

	<div class="fill">
	



<!-- END header.php -->

