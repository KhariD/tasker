drop table if exists `vehicle`;

create table vehicle
(
    vin varchar(255) primary key,
    make varchar(255),
    model varchar(255),
    year int(11),
    miles int(11),
    type varchar(255),
    color varchar(255),
    trans varchar(255),
    price int(11)
);