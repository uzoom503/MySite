<div class="col-md-6">
<h4>New Topic</h4>
<br>
<form  method="post" action="<?php echo base_url('index.php/Forum/new_topic/' . $board_id) ; ?>" role="form">
	<div class="form-group">
      <label for="topic_subject">Topic Subject:</label>
       <input type="text" class="form-control" id="topic_subject" name="topic_subject" />
	</div>
	<div class="form-group">	
		<label for="topic_message">Topic Message:</label>	
         <textarea class="form-control" rows="10" id="topic_message" name="topic_message"></textarea>
	</div>		
	 <div class="form-group">
		<input type="submit" name="submit_button" value="Add" />
	</div>			 
</form>
</div>  <!-- container div -->