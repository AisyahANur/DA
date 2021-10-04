<!DOCTYPE html>
<html lang="en">
<head>
 	<?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<link rel="shortcut icon" href="<?php echo site_url('assets/uploads/logo.png'); ?>" >

	<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>

	<link rel="stylesheet" href="<?= base_url();?>assets2/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/neon-core.css">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/neon-theme.css">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/neon-forms.css">
	<link rel="stylesheet" href="<?= base_url();?>assets2/css/custom.css">

	<script src="<?= base_url();?>assets2/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="<?= base_url();?>assets2/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page "  style="background-color: #07162f">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret" style="background-color: #0e2142;">
		
		<div class="login-content">
			<a href="<?php echo base_url();?>" class="logo">
				<?php echo img(['src' => 'uploads/logo.png', 'height' => '60', 'alt' => '']); ?>
			</a>
			
			<p class="description">
            	<h2 style="color:#cacaca; font-weight:100;">
					<?php echo $system_name;?>
              </h2>
            
           </p>
			
			
			<!-- <a href="index.html" class="logo">
				<img src="<?= base_url();?>assets2/images/logo@2x.png" width="120" alt="" />
			</a>
			
			<p class="description">Dear user, log in to access the admin area!</p>
			 -->
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form  ">
		
		<div class="login-content">

			<?php if ($this->session->flashdata('salah')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('salah'); ?>
				</div>
				<?php endif; ?>

			<div class="form-login-error">
				
			</div>
			
			<form method="post" action="<?= base_url();?>login/auth">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" required placeholder="Username" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" required placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>
				
				
				
			
			</form>
			
			
			<!-- <div class="login-bottom-links">
				
				<a href="extra-forgot-password.html" class="link">Forgot your password?</a>
				
				<br />
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div> -->
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom scripts (common) -->
	<!--<script src="<?= base_url();?>assets2/js/gsap/TweenMax.min.js"></script>-->
	<script src="<?= base_url();?>assets2/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?= base_url();?>assets2/js/bootstrap.js"></script>
	<!--<script src="<?= base_url();?>assets2/js/joinable.js"></script>-->
	<script src="<?= base_url();?>assets2/js/resizeable.js"></script>
	<!--<script src="<?= base_url();?>assets2/js/neon-api.js"></script>-->
	<!--<script src="<?= base_url();?>assets2/js/jquery.validate.min.js"></script>-->
	<script src="<?= base_url();?>assets2/js/neon-login.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<!--<script src="<?= base_url();?>assets2/js/neon-custom.js"></script>-->


	<!-- Demo Settings -->
	<!--<script src="<?= base_url();?>assets2/js/neon-demo.js"></script>-->

</body>
</html>