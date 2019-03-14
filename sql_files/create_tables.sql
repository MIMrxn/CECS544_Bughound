DROP TABLE IF EXISTS bugs;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS programs;
DROP TABLE IF EXISTS areas;
DROP TABLE IF EXISTS attachments;

CREATE TABLE employees (
	employee_id INT NOT NULL UNIQUE AUTO_INCREMENT,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	user_name varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	position varchar(255) NOT NULL,
	group_num INT NOT NULL,
	is_reporter BOOLEAN NOT NULL,
	user_level varchar(255) NOT NULL,
	PRIMARY KEY(employee_id)
);

CREATE TABLE programs (
	program_name varchar(255) UNIQUE NOT NULL,
	program_version INT NOT NULL,
	program_release INT NOT NULL,
	program_release_date DATE NOT NULL,
	PRIMARY KEY(program_name, program_version, program_release)
);

CREATE TABLE areas (
	area_id INT AUTO_INCREMENT,
	area_name varchar(255) UNIQUE NOT NULL,
	PRIMARY KEY(area_id, area_name)
);

CREATE TABLE attachments (
	file_id INT NOT NULL AUTO_INCREMENT,
	file_name varchar(255) NOT NULL,
	file_type varchar(255) NOT NULL,
	PRIMARY KEY (file_id)
);

CREATE TABLE bugs (
	report_id INT NOT NULL UNIQUE AUTO_INCREMENT,
	program_name varchar(255) NOT NULL,
	report_type varchar(255) NOT NULL,
	severity INT NOT NULL,
	has_attachments BOOLEAN NOT NULL,
	summary varchar(255) NOT NULL,
	reproducible BOOLEAN NOT NULL,
	problem_description varchar(800) NOT NULL,
	suggested_fix varchar(800),
	reported_by INT NOT NULL,
	date_discovered DATE NOT NULL,
	functional_area_name varchar(255) NOT NULL,
	assigned_to INT NOT NULL,
	comments varchar(800),
	status varchar(255) NOT NULL,
	priority INT NOT NULL,
	resolution varchar(255) NOT NULL,
	resolution_version INT NOT NULL,
	resolved_by INT NOT NULL,
	date_resolved DATE NOT NULL,
	tested_by INT NOT NULL,
	date_tested DATE NOT NULL,
	treat_deferred BOOLEAN NOT NULL,
	PRIMARY KEY (report_id)
);

