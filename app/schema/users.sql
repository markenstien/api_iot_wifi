drop table if exists users;
create table users(
    id int(10) not null primary key auto_increment,
    user_key char(8) not null,
    username varchar(100) not null,
    password varchar(250) not null,
    fullname varchar(100) not null,
    is_active  boolean default true,
    email varchar(100),
    is_email_verified boolean default false,
    user_type enum('admin', 'client'),
    created_at timestamp default now(),
    updated_at timestamp default now() ON UPDATE now()
);


insert into users (
    user_key,
    username,
    password,
    fullname,
    email,
    is_email_verified,
    user_type
) VALUES(
    '001BBX3',
    'admin',
    'admin',
    'admin user',
    'admin@admin.com',
    true,
    'admin'
);