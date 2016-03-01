<div class="col-md-6">
	<h3>Welcome user "<?php echo $logged_in['username']; ?>" 
	(<a href="<?php echo base_url('/index.php/Forum/logout'); ?>">Logout</a>) </h3>
	<div class="panel-group">
		<?php
			$html = '';
			$cat_name = '';
			foreach($records as $row) {
				//echo 'Here: ' . $row->cat_name;
				if ($cat_name != $row->cat_name)  {
					if ($cat_name != '') {
						$html .= '</table></div></div>';
					}
					$html .= '<div class="panel panel-default">'
							 . ' <div class="panel-heading">'
							. '<div class="btn-group">'
							. '<button type="button" class="btn btn-info">' . $row->cat_name . '</button>'
							. '</div>'
							 .   '<a href="' .  base_url('/index.php/Forum/new_topic/' . $row->board_id) 
							 . '"'
                             .	 ' class="btn btn-default btn-sm pull-right">'
							 .      '<span class="glyphicon glyphicon-plus"></span>New Topic'
							 .   '</a>'
							 . '</div>';
					$cat_name = $row->cat_name;
					$html .= '<div class="panel-body">'
								. '<table class="table table-striped">'
								.	'<tr>'
								.     '<th>Topic</th>'
								.     '<th>User</th>'
								.     '<th>Created</th>'								
								.     '<th>Replies</th>'																
								.   '</tr>';
				}
				// convert mysql datetime to php datetime
				$phpdate = strtotime( $row->add_dt);
				if ($row->topic_id > 0) {
					$html  .=  '<tr>'
								  . '<td>' 
									. '<a href="' . base_url('/index.php/Forum/topic/' . $row->topic_id)
									. '">' 
									. $row->topic_subject . '</a>'
								  . '</td>'
								  . '<td>' 
									. $row->user_name 
								  . '</td>'
								  . '<td>' 
									. date('m-d-y', $phpdate)
								  . '</td>'
								  . '<td>' 
									. $row->num_replies
								  . '</td>'
							. '</tr>';
				}
			}
			echo $html;	 
	   ?>
   </div>
</div>  <!-- container div -->