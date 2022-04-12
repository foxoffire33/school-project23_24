drop database if exists shop;
create database if not exists shop;
use shop;

# set global sql_mode=(select replace(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

create table users
(
    id         int primary key auto_increment,
    name       varchar(255) not null,
    email      varchar(255) not null,
    password   char(65)     not null,
    roles      json         not null,
    deleted_at datetime default null,
    unique (email)
);

create table coin
(
    id         int primary key auto_increment,
    name       varchar(255) not null,
    short_name varchar(5)   not null,
    value      text         not null,
    deleted_at datetime default null
);

create table walled
(
    id         int primary key auto_increment,
    user_id    int   not null,
    coin_id    int   not null,
    value      float not null,
    deleted_at datetime default null,
    unique (user_id, coin_id),
    foreign key (user_id) references users (id),
    foreign key (coin_id) references coin (id)
);

create table transaction
(
    id               int primary key auto_increment,
    sale_coin        int      not null default 0,
    sale_coin_amount float    not null default 0.00,
    buy_coin         int      not null default 0.00,
    buy_coin_amount  float    not null,
    user_id          int      not null,
    created_at       datetime not null default now(),
    deleted_at       datetime          default null
);

# drop view if exists walled;
# create view walled as
    # select coin.short_name, sum(transaction.buy_coin_amount) as Buy, sum(transaction.sale_coin_amount) as Sale, user_id
                                                                  # from transaction
                                                                             #          join coin on coin.id = transaction.buy_coin
          # group by buy_coin, sale_coin;

drop procedure if exists TradeCoin;
create
definer = reinier@`%` procedure TradeCoin(IN sale_coin int, IN sale_amount float, IN buy_coin int, IN userID int)
begin
start transaction;
select (1 / value) into @buyValue from coin where id = buy_coin; #us dollar value
select value into @saleFullValue from coin where id = sale_coin;#us dollar value
select (1 / value) into @saleValue from coin where id = sale_coin;#us dollar value
select value into @walledCoinValue from walled where coin_id = sale_coin and user_id = userID;
select value into @walledCoinBuyValue from walled where coin_id = buy_coin and user_id = userID;

replace walled (`user_id`, `coin_id`, `value`) values (userID, sale_coin, (select @walledCoinValue) - sale_amount);
    replace walled (`user_id`, `coin_id`, `value`)
    values (userID, buy_coin, (((select @buyValue) * (select @saleValue)) * sale_amount) + (select @walledCoinBuyValue));

insert into transaction (sale_coin, sale_coin_amount, buy_coin, buy_coin_amount, user_id)
values (sale_coin, sale_amount, buy_coin, (((select @buyValue) * (select @saleValue)) * sale_amount), userID);

if (select sign(value) from walled where coin_id = sale_coin and user_id limit 1) < 0 then
        rollback;
signal sqlstate '45000' set message_text = 'Not enough funds';
else
        commit;
end if;
end;





create definer = reinier@`%` trigger before_insert_transaction
    before insert
    on transaction
    for each row
begin
    if (select coin_id from walled where user_id = NEW.user_id and coin_id = NEW.buy_coin limit 1) is null then
        insert into walled (`user_id`, `coin_id`, `value`) values (New.user_id, NEW.buy_coin, NEW.buy_coin_amount);
elseif NEW.buy_coin = 1 then #Als het om us dollar gaat update de waarde
select value into @value from walled where coin_id = 1 and walled.user_id;
replace walled (`user_id`, `coin_id`, `value`) values (NEW.user_id, 1, (select @value) + NEW.buy_coin_amount);
end if;
end;



insert into coin(`id`, `name`, `short_name`, `value`)
values (0, 'US Dollar', 'USD', 1.0);

insert into coin(`name`, `short_name`, `value`)
values ('Bitcoin', 'BTC', 69044.77);
insert into coin(`name`, `short_name`, `value`)
values ('Ethereum', 'ETH', 264411);
insert into coin(`name`, `short_name`, `value`)
values ('Tether', 'USDT', 3427.77);
insert into coin(`name`, `short_name`, `value`)
values ('Binance coin', 'BNB', 425.79);
insert into coin(`name`, `short_name`, `value`)
values ('USD Coin', 'USDC', 69044.77);

insert into users(`name`, `email`, `password`, `roles`)
    value ('Reinier Eduard De La Parra', 'reinierdlp@gmail.com',
           '$2y$10$o/hSD6GTQZVj7F2OXmCct.SLbCluyUbx..OcVXfDQ3iJyOa3o8.AK', '[
  1,
  2
]');


insert into users(`name`, `email`, `password`, `roles`)
    value ('Reinier Eduard De La Parra', 'reinierdlp@live.com',
           '$2y$10$o/hSD6GTQZVj7F2OXmCct.SLbCluyUbx..OcVXfDQ3iJyOa3o8.AK', '[
  1,
  2
]');

insert into users(`name`, `email`, `password`, `roles`)
    value ('Reinier Eduard De La Parra', 'reinierdlp@live.eu',
           '$2y$10$o/hSD6GTQZVj7F2OXmCct.SLbCluyUbx..OcVXfDQ3iJyOa3o8.AK', '[
  1,
  2
]');

# call TradeCoin(1, 100, 2, 1);
select (1 / value) * 100
from coin
where id = 2;

select *
from users
where email = 'reinierdlp@gmail.com'
  and `deleted_at` IS NULL;

select 1 / 1;