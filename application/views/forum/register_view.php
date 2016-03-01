
<div class="col-md-6">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Sign Up</div>
			<div style="float:right; font-size: 85%; position: relative; top:-10px">
				<a id="signinlink" href="<?php echo base_url('index.php/Forum/login'); ?>">
					Sign In
				</a>
			</div>
		</div>  
		<div class="panel-body" >
			<form  id="formRegister" method="post" action="<?php echo base_url('index.php/Forum/register_submit'); ?>" role="form">
				<div class="form-group">
				  <label for="user_name">Username:</label>
				   <input id="inputUserName" type="text" class="form-control" id="user_name" name="user_name" minlength="4" required="true"/><span id="spanUserNameCheck"></span>
				</div>
				<div class="form-group">	
					<label for="user_pass">Password:</label>	
					<input type="password" class="form-control" id="user_pass" name="user_pass">
				</div>		
				<div class="form-group">		
					<label for="user_pass_again">Password again</label>		
					 <input type="password" class="form-control" id="user_pass_again" name="user_pass_check">
				</div>				
				<div class="form-group">			
					<label for="email"> E-mail:</label>			
				   <input type="email" class="form-control" id="email" name="user_email">
				</div>		
				 <div class="form-group">
				<button type="submit" class="btn btn-info" disabled="true">		
						Register
						<span class="glyphicon glyphicon-log-in"></span>
					</button>
				</div>			 
			</form>
		</div>
	</div>
</div>  <!-- container div -->
<script>
	$('#formRegister').validate();
	$('#inputUserName').keyup(function(e){
		if ($(this).val().length >= 4) {
			url = "<?php echo '/index.php/api/user/IsUserExist/user_name/';?>" + $(this).val();
		    //alert(url);
			$.get("<?php echo base_url();?>" + url, function(data){
				//alert(data['exist']);
				// check if user_name exist?
				if (data['exist'] == false) {
					$('#spanUserNameCheck').text('User name is available!');
					$('button.btn-info').attr("disabled",false);
				}
				else {
					$('#spanUserNameCheck').text('User name already exists');					
					$('button.btn-info').attr("disabled",true);					
				}
			});
		}
	});
</script>
