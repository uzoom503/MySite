use  `test`;
CREATE TABLE `forumboard` (
  `cat_name` varchar(25) NOT NULL,
  `cat_descp` varchar(255) NOT NULL,  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `forumuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
   `user_name` varchar(25) NOT NULL,
   `email` varchar(32),
   `user_password` varchar(32),
   `add_dt` datetime,
     PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `forumtopic` (
  `topic_subject` varchar(25) NOT NULL,
  `topic_message` long varchar,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `user_id`  int(11) NOT NULL,
  `add_dt` datetime DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `forumreplies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_content` long varchar,  
  `topic_id` int(11) NOT NULL,
  `user_id`  int(11) NOT NULL,
   `add_dt` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
insert test.forumboard(cat_name, cat_descp)
values ('PHP installation', 'Solve your environment here!');

insert into test.forumtopic(topic_subject, board_id, user_id) values ('what is XAMP',1, 1);
insert into test.forumtopic(topic_subject, board_id, user_id) values ('Install CodeIgniter',1, 1);

insert test.forumboard(cat_name, cat_descp)
values ('PHP Framework', 'What framework are you using?');