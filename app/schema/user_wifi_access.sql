create table user_wifi_access(
    id int(10) not null primary key auto_increment,
    wifi_id varchar(100) not null,
    user_id varchar(250) not null,
    access_date datetime
);