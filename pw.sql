 
CREATE TABLE  IF NOT EXISTS reservationList(
	id int(20) NOT NULL,
	name varchar(20),
	tel varchar(50),
	idcard varchar(20),
	playdate varchar(20),
	playercount varchar(20),
	playerid varchar(20),
	PRIMARY KEY (id)
);

CREATE TABLE  IF NOT EXISTS adminUser(
	id int(20) NOT NULL,
	username varchar(20),
	password varchar(50),
	PRIMARY KEY (id)
)
