-- Add Personnel to Database
-- This script creates a complete personnel record with all necessary related data

-- Start transaction for data integrity
START TRANSACTION;

-- 1. Create Name Detail for the personnel
INSERT INTO name_details (last_name, first_name, middle_name, suffix) 
VALUES ('Dela Cruz', 'Maria', 'Santos', 'Jr.')
ON DUPLICATE KEY UPDATE name_id = LAST_INSERT_ID(name_id);

SET @name_id = LAST_INSERT_ID();

-- 2. Create Home Address
INSERT INTO address_details (country, region, province, city, barangay, street, zip_code)
VALUES ('Philippines', 'National Capital Region', 'Metro Manila', 'Quezon City', 'Cubao', 'Aurora Boulevard', '1109')
ON DUPLICATE KEY UPDATE addr_id = LAST_INSERT_ID(addr_id);

SET @home_addr_id = LAST_INSERT_ID();

-- 3. Create Birth Place Address
INSERT INTO address_details (country, region, province, city, barangay, street, zip_code)
VALUES ('Philippines', 'Central Luzon', 'Pampanga', 'Angeles City', 'Balibago', 'MacArthur Highway', '2009')
ON DUPLICATE KEY UPDATE addr_id = LAST_INSERT_ID(addr_id);

SET @birth_addr_id = LAST_INSERT_ID();

-- 4. Create Job Address (if different from home)
INSERT INTO address_details (country, region, province, city, barangay, street, zip_code)
VALUES ('Philippines', 'National Capital Region', 'Metro Manila', 'Quezon City', 'Diliman', 'Camp Aguinaldo', '1110')
ON DUPLICATE KEY UPDATE addr_id = LAST_INSERT_ID(addr_id);

SET @job_addr_id = LAST_INSERT_ID();

-- 5. Create the main User record
INSERT INTO users (username, password, usertype, organic_role, phs_status, is_active)
VALUES ('msdelacruz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'personnel', 'enlisted', 'pending', 1);

-- 6. Create User Detail record
INSERT INTO user_details (username, full_name, home_addr, birth_date, birth_place, nationality, religion, mobile_num, email_addr)
VALUES ('msdelacruz', @name_id, @home_addr_id, '1995-03-15', @birth_addr_id, 1, 'Roman Catholic', '09123456789', 'maria.delacruz@afp.mil.ph');

-- 7. Create Job Detail record
INSERT INTO job_details (username, service_branch, rank, afpsn, job_desc, job_addr)
VALUES ('msdelacruz', 'Philippine Army', 'Sergeant', '123456789', 'Administrative Assistant', @job_addr_id);

-- 8. Create Personal Detail record
INSERT INTO personal_details (username, health_state, blood_type, cap_size, shoe_size, hobbies, undergo_lie_detection)
VALUES ('msdelacruz', 'Good', 'O+', '7', '8', 'Reading, Swimming', 'Yes');

-- 9. Create Description Detail record
INSERT INTO description_details (username, sex, age, height, weight, body_build, complexion, eye_color, hair_color, other_marks)
VALUES ('msdelacruz', 'Female', 28, 1.65, 55.00, 'Medium', 'Fair', 'Brown', 'Black', 'Mole on left cheek');

-- 10. Create Government ID Detail record
INSERT INTO government_id_details (username, tin_num, pass_num, pass_exp)
VALUES ('msdelacruz', '123-456-789-000', 'P123456789', '2030-12-31');

-- 11. Create Military History Detail record
INSERT INTO military_history_details (username, enlist_date, start_comm, end_comm, comm_src)
VALUES ('msdelacruz', '2018-06-01', '2018-06-01', NULL, 'Direct Commission');

-- 12. Create Assignment Detail record
INSERT INTO assignment_details (start_date, assign_unit, assign_chief, username)
VALUES ('2018-06-01', '1st Infantry Division', 'Col. Juan Santos', 'msdelacruz');

-- 13. Create Marital Detail record (assuming single)
INSERT INTO marital_details (username, marital_stat)
VALUES ('msdelacruz', 'Single');

-- 14. Create Family History Detail records for parents
-- Father
INSERT INTO name_details (last_name, first_name, middle_name, suffix)
VALUES ('Dela Cruz', 'Jose', 'Santos', 'Sr.')
ON DUPLICATE KEY UPDATE name_id = LAST_INSERT_ID(name_id);

SET @father_name_id = LAST_INSERT_ID();

INSERT INTO family_details (fam_name, birth_date, citizenship)
VALUES (@father_name_id, '1970-05-20', 1);

SET @father_fam_id = LAST_INSERT_ID();

INSERT INTO family_history_details (username, fam_id, role)
VALUES ('msdelacruz', @father_fam_id, 'father');

-- Mother
INSERT INTO name_details (last_name, first_name, middle_name, suffix)
VALUES ('Santos', 'Ana', 'Garcia', NULL)
ON DUPLICATE KEY UPDATE name_id = LAST_INSERT_ID(name_id);

SET @mother_name_id = LAST_INSERT_ID();

INSERT INTO family_details (fam_name, birth_date, citizenship)
VALUES (@mother_name_id, '1972-08-12', 1);

SET @mother_fam_id = LAST_INSERT_ID();

INSERT INTO family_history_details (username, fam_id, role)
VALUES ('msdelacruz', @mother_fam_id, 'mother');

-- 15. Create Educational Background records
-- Elementary
INSERT INTO school_details (school_name, school_addr)
VALUES ('Angeles Elementary School', @birth_addr_id)
ON DUPLICATE KEY UPDATE school_id = LAST_INSERT_ID(school_id);

SET @elementary_school_id = LAST_INSERT_ID();

INSERT INTO education_details (username, school, level, start_date, end_date, degree, units_earned)
VALUES ('msdelacruz', @elementary_school_id, 'Elementary', '2001-06-01', '2007-03-31', 'Elementary Graduate', NULL);

-- High School
INSERT INTO school_details (school_name, school_addr)
VALUES ('Angeles National High School', @birth_addr_id)
ON DUPLICATE KEY UPDATE school_id = LAST_INSERT_ID(school_id);

SET @highschool_school_id = LAST_INSERT_ID();

INSERT INTO education_details (username, school, level, start_date, end_date, degree, units_earned)
VALUES ('msdelacruz', @highschool_school_id, 'High School', '2007-06-01', '2011-03-31', 'High School Graduate', NULL);

-- College
INSERT INTO school_details (school_name, school_addr)
VALUES ('University of the Philippines', @home_addr_id)
ON DUPLICATE KEY UPDATE school_id = LAST_INSERT_ID(school_id);

SET @college_school_id = LAST_INSERT_ID();

INSERT INTO education_details (username, school, level, start_date, end_date, degree, units_earned)
VALUES ('msdelacruz', @college_school_id, 'College', '2011-06-01', '2015-03-31', 'Bachelor of Science in Business Administration', 144);

-- 16. Create Reference Detail records
-- Reference 1
INSERT INTO name_details (last_name, first_name, middle_name, suffix)
VALUES ('Garcia', 'Pedro', 'Martinez', NULL)
ON DUPLICATE KEY UPDATE name_id = LAST_INSERT_ID(name_id);

SET @ref1_name_id = LAST_INSERT_ID();

INSERT INTO reference_details (ref_name, ref_addr, ref_type, username)
VALUES (@ref1_name_id, @home_addr_id, 'Character Reference', 'msdelacruz');

-- Reference 2
INSERT INTO name_details (last_name, first_name, middle_name, suffix)
VALUES ('Lopez', 'Maria', 'Santos', NULL)
ON DUPLICATE KEY UPDATE name_id = LAST_INSERT_ID(name_id);

SET @ref2_name_id = LAST_INSERT_ID();

INSERT INTO reference_details (ref_name, ref_addr, ref_type, username)
VALUES (@ref2_name_id, @home_addr_id, 'Professional Reference', 'msdelacruz');

-- 17. Create Membership Detail record
INSERT INTO organization_details (org_name, org_addr)
VALUES ('Philippine Army Officers Club', @job_addr_id)
ON DUPLICATE KEY UPDATE org_id = LAST_INSERT_ID(org_id);

SET @org_id = LAST_INSERT_ID();

INSERT INTO membership_details (username, org, mem_date, position)
VALUES ('msdelacruz', @org_id, '2018-06-01', 'Member');

-- 18. Create Language Detail records
INSERT INTO language_details (username, lang_id, fluency)
VALUES ('msdelacruz', 1, 'Fluent'), -- English
       ('msdelacruz', 2, 'Native'); -- Filipino/Tagalog

-- 19. Create Bank Detail record
INSERT INTO bank_details (bank, bank_addr)
VALUES ('Land Bank of the Philippines', @home_addr_id)
ON DUPLICATE KEY UPDATE bank_id = LAST_INSERT_ID(bank_id);

SET @bank_id = LAST_INSERT_ID();

INSERT INTO bank_account_details (account_id, bank, username)
VALUES ('1234567890', @bank_id, 'msdelacruz');

-- 20. Create Credit Detail record
INSERT INTO credit_details (username, credit_card, credit_limit, credit_balance)
VALUES ('msdelacruz', 'BDO Credit Card', 50000.00, 15000.00);

-- Commit the transaction
COMMIT;

-- Display the created personnel information
SELECT 
    u.username,
    u.usertype,
    u.organic_role,
    u.phs_status,
    CONCAT(nd.first_name, ' ', nd.last_name) as full_name,
    ud.email_addr,
    ud.mobile_num,
    jd.rank,
    jd.service_branch,
    jd.afpsn
FROM users u
JOIN user_details ud ON u.username = ud.username
JOIN name_details nd ON ud.full_name = nd.name_id
LEFT JOIN job_details jd ON u.username = jd.username
WHERE u.username = 'msdelacruz'; 