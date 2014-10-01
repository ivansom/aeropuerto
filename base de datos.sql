create table airlines(
id serial,
name char(30),
code char(30),
link char(30),
file integer,
primary key(id)
);

create table passanger(
id serial,
ticket char(10),
name char(30),
passport char(30),
bag integer,
primary key(id)
);