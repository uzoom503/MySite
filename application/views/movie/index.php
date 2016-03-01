 <script>
      $(document).ready(function (){
		  $('img').click(function () {
			  var file_name = $(this).attr('filename');
			  alert(file_name);
			  $('#embedded_video').attr('src',  file_name );
					  
			});
		});
</script>
<div class="container">
	<center> 
		<iframe id="embedded_video" autoplay="false" width="600px" height="300px">
		</iframe> 
	</center>
	<center><table class="table">
			<tr>
	<?php
	   $html = "";
	   foreach ($movies as $movie) {
		  $html .= "<td>"  
				. sprintf('<img src="%s" height="128" width="128" filename="%s">',
						$movie["Poster"], $movie["FileName"])
				. "</img>"
				. $movie["Title"]
				. "</td>";		  
	   }
	   echo $html;
	?>
			</tr>
	</center></table>
	<span>
		<ul class="pager">
		<li class="previous">
		<a href="<?php echo base_url() . '/index.php/Movie/Prev';?>">
			Previous
		</a></li>
		<li class="next"><a href="<?php echo base_url() . '/index.php/Movie/Next';?>">Next</a></li>
		</ul>
	</span>
</div>  <!-- container div -->