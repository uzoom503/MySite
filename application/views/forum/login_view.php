<div class="col-md-6">
   <div class="panel panel-info" >
		<div class="panel-heading">
			<div class="panel-title">Sign In</div>
		</div>     
		<div class="panel-body" >		
			<form  role="form" method="post" action="<?php echo base_url('index.php/Forum/login'); ?>">

				<div class="form-group">
				  <label for="user_name">Username:</label>
				   <input type="text" class="form-control" id="user_name" name="user_name" size="15" maxlength="15" required/>
				</div>
				<div class="form-group">	
					<label for="user_pass">Password:</label>	
					<input type="password" class="form-control" id="user_pass" name="user_pass" size="15" maxlength="15" required/>
				</div>		
				 <div class="form-group">
					<button type="submit" class="btn btn-info">		
						Login
						<span class="glyphicon glyphicon-log-in"></span>
					</button>
				</div>	
				<div class="form-group">
				   <div class="col-md-12 control">
						<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
							Don't have an account! 
							<a href="<?php echo base_url('/index.php/Forum/register'); ?>">
								Sign Up Here
							</a>
							<div>
								<a href="#pnlForgetPassword" data-toggle="collapse">Forgot password?</a>							
							</div>						
						</div>
					</div>
				</div>    
			</form>
		</div>
	</div>
	<?php echo validation_errors(); ?>
	<!-- collapse panel -->
	<div id="pnlForgetPassword" class="collapse panel-body">
		<div class="panel panel-info">
				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" size="25" maxlength="25" placeholder="Email" required/>
				</div>
				 <div class="form-group">
					<button type="submit" class="btn btn-info">		
						Find Password
					</button>
				</div>	

		</div>							
	</div>
	
</div>  <!-- container div -->