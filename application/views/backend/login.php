<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>
	

	<link rel="stylesheet" href="<?php echo site_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/font-icons/entypo/css/entypo.css'); ?>">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/neon-forms.css'); ?>">
	<!-- <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css'); ?>"> -->

	<script src="<?php echo site_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>

	<link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon.png'); ?>">
	
</head>
<body class="login-page " style="background-color: #07162f" >


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '<?php echo base_url();?>';
</script>

<div class="login-container">
	
	<div class="login-header login-caret" style="background-color: #0e2142;">
		
		<div class="login-content" style="width:100%;">
			
			<a href="<?php echo base_url();?>" class="logo">
				<?php echo img(['src' => 'uploads/logo.png', 'height' => '60', 'alt' => '']); ?>
			</a>
			
			<p class="description">
            	<h2 style="color:#cacaca; font-weight:100;">
					<?php echo $system_name;?>
              </h2>
           </p>
			
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
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Please enter correct email and password!</p>
			</div>
			
			<form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group" >
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login
					</button>
				</div>
				
						
			</form>
			
			
			
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom Scripts -->
	<script src="<?php echo site_url('assets/js/gsap/main-gsap.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/joinable.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/resizeable.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/neon-api.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.validate.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/neon-login.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/neon-custom.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/neon-demo.js'); ?>"></script>

</body>
</html>