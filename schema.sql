CREATE DATABASE technicalTest;

USE technicalTest;

CREATE TABLE technicalTest.jobRole
(
	jobRoleId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	role VARCHAR(30) NOT NULL,
	PRIMARY KEY (jobRoleId)
) ENGINE=INNODB COMMENT="job role";

INSERT INTO technicalTest.jobRole
(
	role
)
VALUES
(
	'Developer'
),
(
	'Project Manager'
),
(
	'Designer'
),
(
	'Tester'
);

CREATE TABLE technicalTest.person
(
	personId INT(2) UNSIGNED NOT NULL,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	jobRoleId INT UNSIGNED NOT NULL,
	PRIMARY KEY (personId),
	FOREIGN KEY (jobRoleId) REFERENCES technicalTest.jobRole(jobRoleId) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB COMMENT="person Data";
