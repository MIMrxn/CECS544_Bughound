DROP TABLE IF EXISTS bugs;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS areas;
DROP TABLE IF EXISTS programs;
DROP TABLE IF EXISTS attachments;

DROP SCHEMA IF EXISTS bughound_db;

CREATE DATABASE IF NOT EXISTS bughound_db;

USE bughound_db;

CREATE TABLE employees (
	employee_id INT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	user_name varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	position varchar(255),
	group_num INT UNSIGNED,
	is_reporter BOOLEAN NOT NULL,
	user_level varchar(255) NOT NULL,
	is_visible INT NOT NULL DEFAULT 1,
	PRIMARY KEY(employee_id)
);

CREATE TABLE programs (
	program_id INT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	program_name varchar(255) NOT NULL,
	program_release INT UNSIGNED NOT NULL,
	program_version INT UNSIGNED NOT NULL,
	program_release_date DATE NOT NULL,
	is_visible INT NOT NULL DEFAULT 1,
	PRIMARY KEY(program_id) 
);

CREATE TABLE areas (
	area_id INT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	area_name varchar(255) NOT NULL,
	program_id INT UNSIGNED NOT NULL,
	is_visible INT NOT NULL DEFAULT 1,
	PRIMARY KEY(program_id, area_id),
	CONSTRAINT areas_fk1 FOREIGN KEY(program_id) REFERENCES programs(program_id)
);

CREATE TABLE attachments (
	file_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	file_name varchar(255) NOT NULL,
	file_type varchar(255) NOT NULL,
	report_id INT UNSIGNED NOT NULL,
	is_visible INT NOT NULL DEFAULT 1,
	PRIMARY KEY (file_id, report_id)
);

CREATE TABLE bugs (
	report_id INT NOT NULL UNIQUE AUTO_INCREMENT,
	program_id INT UNSIGNED NOT NULL,
	report_type varchar(255) NOT NULL,
	severity INT UNSIGNED NOT NULL,
	summary varchar(255) NOT NULL,
	reproducible BOOLEAN NOT NULL,
	problem_description varchar(800) NOT NULL,
	suggested_fix varchar(800),
	reported_by INT UNSIGNED NOT NULL,
	date_discovered DATE NOT NULL,
	area_id INT UNSIGNED,
	assigned_to INT UNSIGNED,
	status varchar(255),
	priority INT UNSIGNED,
	resolution varchar(255),
	resolution_version INT UNSIGNED,
	resolved_by INT UNSIGNED,
	date_resolved DATE,
	tested_by INT UNSIGNED,
	date_tested DATE,
	treat_deferred BOOLEAN,
	has_attachments BOOLEAN,
	comments varchar(800),
	is_visible INT NOT NULL DEFAULT 1,
	PRIMARY KEY (report_id),
	CONSTRAINT bugs_fk1 FOREIGN KEY(program_id) REFERENCES programs(program_id),
	CONSTRAINT bugs_fk2 FOREIGN KEY(area_id) REFERENCES areas(area_id),
	CONSTRAINT bugs_fk3 FOREIGN KEY(reported_by) REFERENCES employees(employee_id),
	CONSTRAINT bugs_fk4 FOREIGN KEY(assigned_to) REFERENCES employees(employee_id),
	CONSTRAINT bugs_fk5 FOREIGN KEY(resolved_by) REFERENCES employees(employee_id),
	CONSTRAINT bugs_fk6 FOREIGN KEY(tested_by) REFERENCES employees(employee_id)
);

