-- Simple Personnel Addition Script
-- This script adds a basic personnel record with minimal required data

START TRANSACTION;

-- 1. Create Name Detail
INSERT INTO name_details (last_name, first_name, middle_name, suffix) 
VALUES ('Santos', 'Juan', 'Dela Cruz', NULL);

SET @name_id = LAST_INSERT_ID();

-- 2. Create Home Address
INSERT INTO address_details (country, region, province, city, barangay, street, zip_code)
VALUES ('Philippines', 'National Capital Region', 'Metro Manila', 'Quezon City', 'Diliman', 'Commonwealth Avenue', '1101');

SET @home_addr_id = LAST_INSERT_ID();

-- 3. Create Birth Place Address
INSERT INTO address_details (country, region, province, city, barangay, street, zip_code)
VALUES ('Philippines', 'National Capital Region', 'Metro Manila', 'Manila', 'Intramuros', 'General Luna Street', '1002');

SET @birth_addr_id = LAST_INSERT_ID();

-- 4. Create the main User record
INSERT INTO users (username, password, usertype, organic_role, phs_status, is_active)
VALUES ('jsantos', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'personnel', 'enlisted', 'pending', 1);

-- 5. Create User Detail record
INSERT INTO user_details (username, full_name, home_addr, birth_date, birth_place, nationality, religion, mobile_num, email_addr)
VALUES ('jsantos', @name_id, @home_addr_id, '1990-01-15', @birth_addr_id, 1, 'Roman Catholic', '09123456789', 'juan.santos@afp.mil.ph');

-- 6. Create Job Detail record
INSERT INTO job_details (username, service_branch, rank, afpsn, job_desc)
VALUES ('jsantos', 'Philippine Army', 'Private First Class', '987654321', 'Infantry Soldier');

-- 7. Create Personal Detail record
INSERT INTO personal_details (username, health_state, blood_type)
VALUES ('jsantos', 'Good', 'A+');

-- 8. Create Description Detail record
INSERT INTO description_details (username, sex, age, height, weight)
VALUES ('jsantos', 'Male', 33, 1.70, 70.00);

-- 9. Create Marital Detail record
INSERT INTO marital_details (username, marital_stat)
VALUES ('jsantos', 'Single');

-- 10. Create Military History Detail record
INSERT INTO military_history_details (username, enlist_date, start_comm)
VALUES ('jsantos', '2020-01-01', '2020-01-01');

COMMIT;

-- Display the created personnel
SELECT 
    u.username,
    u.usertype,
    u.organic_role,
    CONCAT(nd.first_name, ' ', nd.last_name) as full_name,
    ud.email_addr,
    jd.rank,
    jd.service_branch
FROM users u
JOIN user_details ud ON u.username = ud.username
JOIN name_details nd ON ud.full_name = nd.name_id
LEFT JOIN job_details jd ON u.username = jd.username
WHERE u.username = 'jsantos'; 