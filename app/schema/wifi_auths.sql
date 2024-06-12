create table wifi_devices(
    id int(10) not null primary key auto_increment,
    wifi_ssid varchar(100) not null,
    wifi_password varchar(250) not null,
    is_active boolean default true,
    created_at timestamp default now(),
    updated_at timestamp default now() ON UPDATE now()
);