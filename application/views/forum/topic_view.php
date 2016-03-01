<div class="col-md-6">
	<!-- Bread crumb -->
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url('index.php/Forum/board');?>">
			<?php echo $records[0]->cat_name;?>
			</a>		 
		</li>
		<li class="active"><?php echo $records[0]->topic_subject;?>
		</li>
	</ul>
	<h4><?php echo $records[0]->topic_message;?></h4>
<?php
	foreach($records as $row) {
		if ($row->reply_id) {
?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<?php echo $row->user_name; ?>
				</div>
				<div class="panel-body">
					<?php echo $row->reply_content; ?>
				</div>
			</div>	
<?php
		}
	}
?>
	<div class="panel">
		<button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#reply_panel">
			<span class="glyphicon glyphicon-envelope">Reply</span>
		</button>
		<div style="float: right;">
			<!-- Pagination -->
			 <ul class="pagination">
<?php
				if ($current_page > 1) {
					echo '<li><a href="' 
						. base_url(sprintf('index.php/Forum/topic/%d/1', $records[0]->topic_id)) 
						.  ' ">First</a></li>';
					echo '<li><a href="' 
						. base_url(sprintf('index.php/Forum/topic/%d/%d', $records[0]->topic_id, $current_page-1)) 
						.  sprintf(' ">%d</a></li>',$current_page-1);
				}
				echo '<li class="active"><a href="' 
					. base_url(sprintf('index.php/Forum/topic/%d/%d', $records[0]->topic_id, $current_page)) 
				    .  sprintf(' ">%d</a></li>', $current_page);
				if ($current_page < $num_pages) {
					echo '<li><a href="' 
						. base_url(sprintf('index.php/Forum/topic/%d/%d', $records[0]->topic_id, $current_page+1)) 
						.  sprintf(' ">%d</a></li>',$current_page+1) ;
					echo '<li><a href="' 
						. base_url(sprintf('index.php/Forum/topic/%d/%d', $records[0]->topic_id, $num_pages)) 
						.  ' ">Last</a></li>';
				}
?>
			</ul>
		</div>
	</div>
	<!-- collapse reply panel -->
	<div id="reply_panel" class="collapse">
		<form method="post" action="<?php echo base_url('index.php/Forum/reply_topic'); ?>" role="form">
		    <input type="hidden" name="topic_id" id="topic_id" value="<?php echo $records[0]->topic_id; ?>"/>
			<div class="form-group">	
				<label for="reply_message">Reply Topic Message:</label>	
				 <textarea class="form-control" rows="10" id="reply_message" name="reply_message"></textarea>
			</div>	
			 <div class="form-group">
				<input class="btn btn-info btn-sm" type="submit" name="submit_button" value="Post Reply" />
			</div>				
		</form>
	</div>

</div>  <!-- container div -->