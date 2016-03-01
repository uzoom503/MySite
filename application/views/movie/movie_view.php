 <script>
      $(document).ready(function (){
			var playerInstance = jwplayer("embedded_video");
			playerInstance.setup({
				file: '',
				image: '',
				width: 640,
				height: 360,
				title: 'Basic Video Embed',
				description: 'A video with a basic title and description!',
				mediaid: '123456'
			});		
		  $('a.movie').click(function () {
				var pathfile = $(this).attr('pathfile');
				//alert(pathfile);
				$('#embedded_video').attr('src',  pathfile );

				// load video
				var playerInstance = jwplayer("embedded_video");
				playerInstance.setup({
					file: pathfile,
					image: '',
					width: 640,
					height: 360,
					title: 'Basic Video Embed',
					description: 'A video with a basic title and description!',
					mediaid: '123456'
				});		
                var filename = $(this).attr('filename').slice(0,-4);
				filename = filename.replace(/ /gi, "+"); 
				var url_txt = 'http://www.omdbapi.com/?t=' + filename + '&y=&plot=short&r=json';
				//alert(url_txt);
                // ajax
				$.ajax({
					url: url_txt,
					dataType: "json",      // set to "json" to have data converted automatically to object.
					datda: "",
					type: "GET",
					success: function(data) {
						// note: data is already converted into data object converted from json
						var html_txt = 'Title: ' + data.Title + '<br>'
						         + 'Year: ' + data.Year + '<br>'
								 + 'Genre: ' + data.Genre + '<br>'
								 + 'IMDB Rating: ' + data.imdbRating + '<br>'								 
								 ;
						$('#movie_info').html(html_txt);
						$('#poster').attr('src', data.Poster);
					},
					error: function(jqXHR, status, error) {
						$('#title').text("Error:" + error  + ' ' + url_txt);
					}
				});
			});
		});
		


		
</script>
<div class="container-fluid">
	<div class="row">
		<div id="sidebar" class="col-md-3 sidebar">
			<!-- bootstrap form-->
			<form role="form" method="post" action="<?php echo base_url() . 'index.php/Movie/search'; ?>">
				<h4>Movie Search</h4>		
				<input type="text" class="form-control" name="q" size="25" maxlength="255" value="<?php echo $q; ?>" />
				<button type="submit" class="btn btn-info btn-sm">
					<span class="glyphicon glyphicon-search"></span>Search
				</button>
			</form>
			<div class="result">
				<!-- bootstrap list-group -->
				<ul class="list-group">
					<?php 
						foreach($data as $file => $pathfile) {
							echo sprintf('<li class="list-group-item"><a class="movie" href="#" pathfile="%s" filename="%s">', 				$pathfile, $file) 
								. $file 
								. '</a></li>';
						}
					?>
				</ul>;		   
			</div>
		</div>

		<!--
		   <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
			<script src="http://vjs.zencdn.net/c/video.js"></script>	
			<script src="https://content.jwplatform.com/libraries/pWK1PEWl.js"></script>	
		-->
			<script src="<?php echo base_url() . '/js/pWK1PEWl.js'; ?>"></script>	
			<script>jwplayer.key="e5/YRt8bAqdJSAi2ogdBuvGGeJRjW2LPx3nGJQ==";</script>

		<div class="col-md-6">
			<div id="embedded_video">Loading the player...</div>
			<div id="movie_info">Movie Information...</div>
			<img id="poster" src="">Poster...</img>
		</div>

	</div>
