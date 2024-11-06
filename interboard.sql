

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gecollegetapplicantscountbystatus` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `sp_gecollegetapplicantscountbystatus`(college_id int(20),a_status varchar(50))
BEGIN
		SELECT COUNT(*) AS applicant_count FROM `applications` WHERE `status`=cast(a_status as char) and `user_id` IN(SELECT `id` FROM `users` WHERE `role`='student' AND `college_id`=college_id);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getschoolapplicants` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getschoolapplicants` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `sp_getschoolapplicants`(a_college_id int(20),a_status varchar(20))
BEGIN
	if a_status is null or a_status="" or a_status="NULL" then 
		SELECT A.*,B.`id` AS student_id,CONCAT(B.`first_name`,' ',B.`last_name`) AS student_name,B.`email` AS student_email,
		B.`phone` AS student_phone,C.`id` AS job_id,C.`ref_no`,C.`title`,C.`job_type`,C.`description`,C.`experience_level`,C.`salary_range`,
		D.`name` AS company_name, D.`email` AS company_email, D.`phone` AS company_phone FROM `applications` A 
		INNER JOIN `users` B ON A.`user_id`=B.`id` INNER JOIN `jobs` C ON A.`job_id`=C.`id` INNER JOIN `corporates` D ON C.`corporate_id`=D.`id`
		WHERE A.`user_id` IN(SELECT `id` FROM `users` WHERE `role`='student' AND `college_id`=a_college_id);
	else
		SELECT A.*,B.`id` as student_id,CONCAT(B.`first_name`,' ',B.`last_name`) AS student_name,B.`email` AS student_email,
		B.`phone` AS student_phone,C.`id` as job_id,C.`ref_no`,C.`title`,C.`job_type`,C.`description`,C.`experience_level`,C.`salary_range`,
		D.`name` AS company_name, D.`email` AS company_email, D.`phone` AS company_phone FROM `applications` A 
		INNER JOIN `users` B ON A.`user_id`=B.`id` INNER JOIN `jobs` C ON A.`job_id`=C.`id` INNER JOIN `corporates` D ON C.`corporate_id`=D.`id`
		WHERE A.`status`=a_status and A.`user_id` IN(SELECT `id` FROM `users` WHERE `role`='student' AND `college_id`=a_college_id);
	end if;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getschoolapplicantscount` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getschoolapplicantscount` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `sp_getschoolapplicantscount`(college_id int(20))
BEGIN
		select count(*) as applicant_count from `applications` where `user_id` in(select `id` from `users` where `role`='student' and `college_id`=college_id);
	END */$$
DELIMITER ;
