drop table if exists `student`;

create table students
(
	id int(11) primary key,
	first_name varchar(255),
	last_name varchar(255),
	gpa 	float(11),
	year	int(11),
	major	varchar(6)
);

