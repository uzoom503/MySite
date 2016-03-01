<div class="container">
<section>
<h3>What this?</h3>
This is my php website. It is built using XAMPP(Apache, MySQL,PHP), CodeIgniter with Rest Service framework, JQuery, and bootstrap.

</section>

<section>
<h4>Installation</h4>
<ul>
<li>Install XAMPP.</li>
<li>Install bootstrap</li>
<li>Reference jquery</li>
<li>
Drop "Mysite" folder to where Apache's WWW root.
</li>
<li>
Configure "base_url" to "MySite" in config.php
</li>
<li>
Create MySQL database "Test"
</li>
<li> run Application/SQL/forum.sql to build schema
</li>
</ul>
<h3>Bootstrap</h3>
Incorporate Bootstrap control:
<ul>
<li>Navigation Bar</li>
<li>List Item</li>
<li>Panel List</li>
<li>collapse</li>
</ul>
<h3>CodeIgniter Rest Server</h3>
Integrate with CodeIgniter Rest Server to create rest-full service.
Using Jquery ajax method to call "restfull" service.
<p>
Link to download library here.
<pre>
https://github.com/chriskacerguis/codeigniter-restserver
</pre>
Tutorial is here
<pre>
http://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter--net-8814
</pre>
An example api controller is called "Example" and link to test:
<pre>
http://192.168.1.17:2080/MySite/index.php/api/example/users
http://192.168.1.17:2080/MySite/index.php/api/example/users?id=1
http://192.168.1.17:2080/MySite/index.php/api/example/users/id/1
</pre>

</section>
<section>
<h4>Music and Movie</h4>
It contains searching for existing mp3 and movie files on file system in defined folders: configured in config.php.
<p>
Movie has a web service called to "movie database" api to retrieve movie info and display on screen.
<p>
Music search is AJAX and you can click on link to build playlist to audio.
<p>
Playlist is saved to HTML5 local storage.
<p>
The music page is Single Page Application.
<p>
Music and movie are not using any database.  They search through file system folders: defined in config.php.
</section>

<section>
<h3>Forum</h3>
This application is a small forum: 
consists Board, Topic Replies.  
<p>
User can add "new topic" to given board and then reply to topic.
<p>
It has login page and register new user page.
</section>


</div>
