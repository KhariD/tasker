drop table if exists `owner`;

create table owner
(
    user varchar(255) primary key,
    fname varchar(255),
    lname varchar(255),
    phone varchar(255),
    com varchar(255)
);