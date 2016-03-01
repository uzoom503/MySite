 <script>
    $(document).ready(function (){
		// get audio players 
		audio = $('#embedded_audio');
		audio[0].volume = .5;
		
		// get "div" playlist
		playlist = $('div.playlist');
		// session playlist
		sess_playlist = new Object();
	
		// load from local storage 
	    loadFromLocalStorage();
		
		// Current 
		current = 0;		
        len = playlist.find('a.playlist').length - 1;
		
		// Save playlist to "local storage"
		function saveToLocalStorage() {	
			//alert('save: ' + JSON.stringify(sess_playlist));		
			localStorage.setItem("playlist", JSON.stringify(sess_playlist));				
		}
		// load into playlist from "local storage"		
		function loadFromLocalStorage(){
			sess_playlist = (JSON.parse(localStorage.getItem("playlist")) || new Object());
			//alert(sess_playlist);
			$.each(sess_playlist, function( file_name, path_file ) {
				playlist.append( '<a class="list-group-item playlist" href="#" '
				                    + ' file="' + file_name + '" '
				                    + ' pathfile="' 
									+  path_file + '">' 
									+ ' <button type="button" class="btn btn-xs btn-default playlist">'
									+ '<span class="glyphicon glyphicon-minus"></span>'		
                                    + '</button>'									
									+ file_name									
									+ '</a>'
									);				
			});
		}
		// function help to encode other special characters that encodeURIComponent do NOT
		// encode.
		function urlencode(str) {
			str = (str + '').toString();
			// Tilde should be allowed unescaped in future versions of PHP (as reflected below),
			//	/but if you want to reflect current
			// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
			return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
		}
		//*************************************************************
		// Ajax search
		//  This pass parameter on URL, require encoding of URL
		//*************************************************************
		$("#xxxfrmSearch").submit(
			function(event){
				//alert('submit');
				$('#search_error').text('');
				
				event.preventDefault();
				 $.ajax({
					url: "<?php echo base_url() . 'index.php/Nhac/getSearchSvc/';?>" 	
					           + urlencode($('#txtSearchValue').val()),
					type: "POST",
					dataType: "json",    // this will decode response data from json automatically
					error: function(jqXHR, status, error) {
						$('#search_error').text("Error:" + error);
					},
					success:
						function(data) {
							
							ul = $('#ul_result');
							ul.empty();
							//alert('sucess');
							$.each(data, function(filename,pathfile){							
								ul.append('<li class="list-group-item">'
											+' <a class="search_list" href="#" pathfile="' + pathfile 
											+'" file="' + filename + '">'
											+ filename 
											+ '</a></li>');														
							});
						}
			});		
		});
		$("#frmSearch").submit(
			function(event){
				//alert('submit');
				$('#search_error').text('');
				
				event.preventDefault();
				 $.ajax({
					url: "<?php echo base_url() . 'index.php/Nhac/postSearchSvc';?>",
					type: "POST",
					dataType: "text",
					data: {'q': $('#txtSearchValue').val()},
					error: function(jqXHR, status, error) {
						$('#search_error').text("Error:" + error);
					},
					success:
						function(data) {		
							// manually parse Json since "datatype" is "text",not "json"
							jsonData = jQuery.parseJSON(data);						
							ul = $('#ul_result');
							ul.empty();
							//alert('sucess');
							$.each(jsonData, function(filename,pathfile){							
								ul.append('<li class="list-group-item">'
											+' <a class="search_list" href="#" pathfile="' + pathfile 
											+'" file="' + filename + '">'
											+ filename 
											+ '</a></li>');														
							});
						}
			});		
		});
		//*************************************************************
		//  if user click on play "-" on playlist link, then
		//  remove from "session playlist"
		//  remove from DOM
		//  save "session playlist" to local storage
		//*************************************************************
		$(document).on('click','button.playlist',function (e) {
			//alert ('click to remove link');
			var file_name = $(this).parent().attr('file');
			// remove from object
			delete sess_playlist[file_name];
			//alert('now: ' + JSON.stringify(sess_playlist));					
			// remove from DOM
			$(this).parent().remove();		
            		
			saveToLocalStorage();		
            // this return prevent event from propagating(or bubbling up) the DOM
			// ie The you-may-not-know-this bit is that whenever an event happens on an element, that // event is triggered on every single parent element as well.
			return false;
		});
		//*************************************************************
		//  
		// 
		//*************************************************************
		$(document).on('click','a.search_list', function () {
				var path_file = $(this).attr('pathfile');
				var file_name = $(this).attr('file');
				// add to sess_playlist
				sess_playlist[file_name] = path_file;
				saveToLocalStorage();
				//alert('path_file=' + path_file);				
				playlist.append( '<a class="list-group-item playlist" href="#"'
                        			+ ' file="' + file_name + '" '
				                    + 'pathfile="' 
									+  path_file + '">' 
									+ ' <button type="button" class="btn btn-xs btn-default playlist">'
									+ '<span class="glyphicon glyphicon-minus"></span>'		
                                    + '</button>'									
									+  file_name
									+ '</a>'
									);
				tracks = playlist.find('a.playlist');
				len = tracks.length - 1;
				//alert('Track length=' + len);				
		});
		//*************************************************************
		// If you try to do something with the elements that are dynamically added to DOM using the // jQuery click() method it will not work, because it bind the click event only to the 
		// elements that exist at the time of binding. To bind the click event to all existing and 
		// future elements, use the jQuery on() method.
		//*************************************************************		
		$(document).on("click", 'a.playlist', function(e){
			//alert('click to play link');	
			link = $(this);
			current = link.index();
			play(link, audio[0]);
						
            // prevent event "bubbling"						
			return false;
		});		
	
		// Event - to detect "ended" song, to go to next song in play list
		audio[0].addEventListener('ended',function(e){
			current++;
			if(current > len){
				current = 0;
				link = playlist.find('a.playlist')[0];
			}else{
				link = playlist.find('a.playlist')[current];    
			}
			//alert('Next song index=' + current);
			play($(link),audio[0]);
		});		
		// "repeat 1" check box
		$('#cbx_audio_loop').click(function(){
			if ($(this).attr('value') == 'checked') {
				$('#embedded_audio').attr('loop', 'true');	
			}
			else {
				$('#embedded_audio').attr('loop', 'false');	
			}
		});
		// play the parameter "link" song
		function play(link, player){
			//alert(link.attr('pathfile'));
			player.src = link.attr('pathfile');
			link.addClass('active').siblings().removeClass('active');
			player.load();
			player.play();
		}
	});
</script>
<div class="container-fluid">
	<div class="row">
		<div id="sidebar" class="col-md-3 sidebar">
		    <!-- bootstrap form-->
			<form role="form" id="frmSearch" method="post" action="<?php echo base_url() . 'index.php/Nhac/search'; ?>">
			    <h4>Mp3 Search</h4>
				<input type="text" class="form-control" id="txtSearchValue" name="q" size="25" required="true" value="<?php echo $q; ?>" />
				<button type="submit" class="btn btn-info btn-sm">
					<span class="glyphicon glyphicon-search"></span> Search
				</button>
			</form>
			<br>
			<div id="search_error">
			</div>
			<div class="result">
				<!-- Bootstrap list group -->
				<ul id="ul_result" class="list-group">
					<?php 
						foreach($data as $file => $pathfile) {
							echo  sprintf('<li class="list-group-item"><a class="search_list" href="#" pathfile="%s" file="%s">', $pathfile, $file) . $file . '</a></li>';
						}
					?>
				</ul>
			</div>			
		</div>			

		<!-- bootstrap remainder container -->
		<div class="col-md-6">
			<!-- HTML5 audio --->
			<audio id="embedded_audio" preload="none" controls="">
				<source src="#" type="audio/mpeg"> 
			</audio>
			<!-- Bootstrap checkbox -->
			<div class="checkbox">
				<label>
					<input type="checkbox" id="cbx_audio_loop" value="">Repeat 1</input>
				</label>
			</div>
			<!-- Bootstrap list group -->			
			<div class="list-group playlist">
			</div>
		</div> 


