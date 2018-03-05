create table education
(
	ID int auto_increment
		primary key,
	USER_PROFILE_ID int null,
	INSTITUTION text null,
	LEVEL text null,
	DEGREE text null
)
engine=InnoDB
;

create index USER_PROFILE_ID
	on education (USER_PROFILE_ID)
;

create table employment_history
(
	ID int auto_increment
		primary key,
	USER_PROFILE_ID int null,
	EMPLOYER text null,
	POSITION text null,
	DURATION text null
)
engine=InnoDB
;

create index USER_PROFILE_ID
	on employment_history (USER_PROFILE_ID)
;

create table groups
(
	ID int auto_increment
		primary key,
	TITLE varchar(50) null,
	SUMMARY varchar(255) null,
	DESCRIPTION text null,
	constraint TITLE
		unique (TITLE)
)
engine=InnoDB
;

create table jobs
(
	ID int auto_increment
		primary key,
	TITLE varchar(255) not null,
	AUTHOR varchar(255) not null,
	LOCATION varchar(255) not null,
	DESCRIPTION text null,
	REQUIREMENTS text null,
	SALARY double null,
	CREATE_DATE datetime default CURRENT_TIMESTAMP null
)
engine=InnoDB
;

create table join_user_group
(
	ID int auto_increment
		primary key,
	USER_ID int null,
	GROUP_ID int null,
	constraint join_user_group_ibfk_2
		foreign key (GROUP_ID) references groups (ID)
)
engine=InnoDB
;

create index USER_ID
	on join_user_group (USER_ID)
;

create index GROUP_ID
	on join_user_group (GROUP_ID)
;

create table skills
(
	ID int auto_increment
		primary key,
	USER_PROFILE_ID int not null,
	TITLE varchar(100) not null,
	DESCRIPTION text null
)
engine=InnoDB
;

create index USER_PROFILE_ID
	on skills (USER_PROFILE_ID)
;

create table suspended_users
(
	ID int auto_increment
		primary key,
	USER_ID int null,
	DURATION date null
)
engine=InnoDB
;

create index USER_ID
	on suspended_users (USER_ID)
;

create table user_profiles
(
	ID int auto_increment
		primary key,
	USER_ID int not null,
	BIO varchar(10000) null,
	IMGURL varchar(500) null,
	LOCATION varchar(100) null
)
engine=InnoDB
;

create index USER_ID
	on user_profiles (USER_ID)
;

alter table education
	add constraint education_ibfk_1
		foreign key (USER_PROFILE_ID) references user_profiles (USER_ID)
;

alter table employment_history
	add constraint employment_history_ibfk_1
		foreign key (USER_PROFILE_ID) references user_profiles (USER_ID)
;

alter table skills
	add constraint skills_ibfk_1
		foreign key (USER_PROFILE_ID) references user_profiles (USER_ID)
;

create table users
(
	ID int auto_increment
		primary key,
	EMAIL varchar(255) not null,
	PASSWORD varchar(255) not null collate latin1_bin,
	FIRSTNAME varchar(255) null,
	LASTNAME varchar(255) null,
	ADMIN tinyint(1) default '0' null,
	constraint EMAIL
		unique (EMAIL)
)
engine=InnoDB
;

alter table join_user_group
	add constraint join_user_group_ibfk_1
		foreign key (USER_ID) references users (ID)
;

alter table suspended_users
	add constraint suspended_users_ibfk_1
		foreign key (USER_ID) references users (ID)
;

alter table user_profiles
	add constraint user_profiles_ibfk_1
		foreign key (USER_ID) references users (ID)
;

