create table position (
	id int(11) auto_increment primary key,
	title varchar(50) not null,
	description varchar(200) not null,
	created_at datetime DEFAULT CURRENT_TIMESTAMP,
	updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

