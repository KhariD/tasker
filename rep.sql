drop table if exists `reps`;

create table reps
(
    user varchar(255) primary key,
    fname varchar(255),
    lname varchar(255),
    phone int(11),
    com int(11)
);