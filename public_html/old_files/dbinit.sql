CREATE TABLE about(
	description text,
	applinfo text,
	welcomeday text,
	freshmanday text
);

INSERT INTO about (description, applinfo, welcomeday, freshmanday) VALUES ("Description", "Application Info", "Welcome Day", "Freshman Day");
	
CREATE TABLE majors(
	id int(4) NOT NULL auto_increment,
	major_name	varchar(255) NOT NULL,
	PRIMARY KEY (id)
);	

INSERT INTO majors (major_name) VALUES ("EE"), ("CS"), ("EECS");
	
CREATE TABLE students(
	name varchar(255) NOT NULL,
	grad_year int(8),
	major_id int(4),
	uniqname varchar(255) NOT NULL,
	password varchar(32) NOT NULL DEFAULT "4cb9c8a8048fd02294477fcb1a41191a", -- default is changeme
	security int(2) NOT NULL DEFAULT '0', -- 0 is regular user, 1 is admin, 2 is recruiter
	PRIMARY KEY (uniqname),
	FOREIGN KEY (major_id) REFERENCES majors(id)
		ON DELETE NO ACTION
);

INSERT INTO students (name, uniqname, security) VALUES ("Christopher Peplin", "peplin", 1), ("Tyler Pasch", "typasch", 1), ("Matt Morlock", "mmorlock", 1);

CREATE TABLE recruiters(
	email varchar(255) NOT NULL,
	company varchar(255) NOT NULL,
	password varchar(32) NOT NULL DEFAULT "23c06dc98cf520e14ed2560fba0b6e7f", -- default is cse08
	PRIMARY KEY (email, company)
);

CREATE TABLE service_cat(
	id int(8) NOT NULL auto_increment,
	category_name varchar(255) NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO service_cat (category_name) VALUES ("Website");
INSERT INTO service_cat (category_name) VALUES ( "Tutoring");

CREATE TABLE service_log(
	id int(32) NOT NULL auto_increment,
	timestamp timestamp NOT NULL 
						DEFAULT CURRENT_TIMESTAMP 
						ON UPDATE CURRENT_TIMESTAMP,
	uniqname varchar(255) NOT NULL,
	category_id int(8) DEFAULT NULL,
	description varchar(255) DEFAULT NULL,
	hours int(4) NOT NULL,
	PRIMARY KEY (id, uniqname),
	FOREIGN KEY (uniqname) REFERENCES students
		ON DELETE CASCADE,
	FOREIGN KEY (category_id) REFERENCES service_cat(id)
		ON DELETE SET NULL
);
	
CREATE TABLE leadership(
	position varchar(255) NOT NULL,
	uniqname varchar(255) DEFAULT NULL,
	email varchar(255) DEFAULT NULL,
	description text DEFAULT NULL,
	sort int(6) NOT NULL,
	PRIMARY KEY (position),
	FOREIGN KEY (uniqname) REFERENCES students
		ON DELETE SET DEFAULT
);

INSERT INTO leadership (position, sort) VALUES ("President", 1), ("Vice President", 2), ("Treasurer", 3), ("Secretary", 4),
																											("Recruiting Chair", 5), ("Outreach Chair", 6), ("Peer Advising Chair", 7), 
																											("Program Development Chair", 8);
	
CREATE TABLE courses(
	num int(8) NOT NULL,
	name varchar(255) NOT NULL,
	description text, -- contains reccomendation info
	PRIMARY KEY (num)
);
	
CREATE TABLE faq_cat(
	id int(8) NOT NULL auto_increment,
	course_num int(8) NOT NULL,
	name varchar(255),
	PRIMARY KEY (id, course_num),
	FOREIGN KEY (course_num) REFERENCES courses
		ON UPDATE CASCADE
);
	
CREATE TABLE faq(
	id int(24) NOT NULL auto_increment,
	course_num int(8),
	cat_id int(8),
	question text,
	answer text,
	PRIMARY KEY (id, course_num),
	FOREIGN KEY (cat_id) REFERENCES faq_cat(id)
		ON DELETE SET NULL,
	FOREIGN KEY (course_num) REFERENCES courses(num)
		ON DELETE CASCADE
);
	
-- file is always uploaded to resumes/uniqname.pdf, this just keeps a record of the last upload
CREATE TABLE resume(
	uniqname varchar(255) NOT NULL,
	timestamp timestamp DEFAULT 0 ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (uniqname),
	FOREIGN KEY (uniqname) REFERENCES students
		ON DELETE CASCADE
);

-- meeting minutes, recruiting info?
-- on upload of meeting minutes, could email to group
	