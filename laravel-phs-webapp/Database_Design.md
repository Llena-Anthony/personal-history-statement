DATABASE DESIGN

USER (username, password, usertype, organic role, branch, created_by, is_active, phs_stat)

USERDETAILS (username, name, profile_pic, home_addr, birth, nationality, tin, religion, mobile_num, email_addr, passport_num, passport_exp, change_in_name)
FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		home_addr REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		name REFERENCES NAMEDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		birth REFERENCES BIRTHDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

NAMEDETAILS (name_id, last_name, first_name, middle_name, nickname, name_extension)

BIRTHDETAILS (birth_id, b_date, b_month, b_year, b_place)
FK	b_place REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

JOBDETAILS (username, present_job, job_addr, rank, afpsn, been_dismissed, reason_for_dismissal)
FK	username REFERENCES USER NULLS NOT ALLOWED
		DELETE RESTRICT, UPDATE CASCADE
job_addr REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		rank REFERENCES MILITARYRANK NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
ADDRESSDETAILS (addr_id, street, barangay, municipality, province, city, country, zip_code)


PERSONALCHAR (username, sex, age, height, weight, body_build, complexion, eye_color, hair_color, other_features, health_state, recent_illness, blood_type, shoesize, headsize)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

MARITALSTATUS (username, marital_status)
  FK 	username REFERENCES USER NULLS NOT ALLOWED
 DELETE RESTRICT, UPDATE CASCADE

SPOUSEDETAILS (username, spouse_name, date_of_marriage, place_of_marriage, spouse_dob, spouse_birthplace, spouse_occupation, spouse_employer, contact_number, citizenship, ual_citizenship)
	FK	 username REFERENCES USER NULLS NOT ALLOWED 
DELETE RESTRICT, UPDATE CASCADE

CHILDRENDETAILS (child_id, username, child_name, child_dob, child_citizenship_address, parent_name)
	FK	 username REFERENCES USER NULLS NOT ALLOWED 
DELETE RESTRICT, UPDATE CASCADE

FAMILYHISTORY (fam_id, username, name, role, birthdate, occupation, employer, employment_addr, citizenship, isnaturalized, naturalized_details)
	FK	username REFERENCES USERDETAILS NULLS NOT ALLOWED 
DELETE RESTRICT, UPDATE CASCADE
name REFERENCES NAMEDETAILS NULLS NOT ALLOWED
	DELETE RESTRICT, UPDATE CASCADE
birthdate REFERENCES BIRTHDETAILS NULLS NOT ALLOWED
	DELETE RESTRICT, UPDATE CASCADE
		employment_addr REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

EDUCATIONALBACKGROUND (username, educ_details, other_training_attended, other_training_date, civil_service qualification)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		educ_details REFERENCES EEDUCATIONDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

EDUCATIONDETAILS (educ_id, username, school, date_attended, year_grad)

SCHOOLDETAILS (school_id, location, level)
	FK	location REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

033333MILITARYHISTORY (username, date_enlisted_afp, start_date_of_commision, end_date_of_commision, source_of_commision, military_assign)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		military_assign REFERENCES MILITARYASSIGNMENTS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

MILITARYASSIGNMENTS (assign_id, inclusive_dates, unit_office, co_or_chief_of_office)
	FK	 username REFERENCES MILITARY HISTORY NULLS NOT ALLOWED
			DEELETE RESTRICT, UPDATE CASCADE	

MILITARYSCHOOLATTENDED (history_id, school_location, date_attended, nature_of_training, rating)
	FK 	username REFERENCES MILITARYHISTORY NULLS NOT ALLOWED 
			DELETE RESTRICT, UPDATE CASCADE
		school_location REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

MILITARYAWARDS (history_id, decoration_award_or_commendation)
	FK 	history_id REFERENCES MILITARYHISTORY NULLS NOT ALLOWED	
			DELETE RESTRICT, UPDATE CASCADE
RESIDENCEHISTORY(username, address_id, from_year, to_year)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
	FK	address_id REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

EMPLOYMENTHISTORY(username, inclusive_dates, employment_type, employment_address, employment_reason_for_leaving, employer_name, employer_addr)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
	FK	employer_addr REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRCT, UPDATE CASCADE

FOREIGNVISITS (foreign_id, username, date_of_visit, country_visited, purpose_of_visit, foreign_address)
	FK	username REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESRICT, UPDATE CASCADE

CREDITREP (username, is_dependent, income_source, credit_inst_detail, has_filed_saln, agency, date_filed, amount-paid, credit_ref_detail)
	FK	username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		credit_inst_detail REFERENCES CREDITINSTITUTION NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		credit_ref_detail REFERENCES CREDITINSTITUTION NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

ARRESTRECORD (record_id, has_record, personal_arrest, fam_has_record, family_arrest, has_admin_case, admin_case_detail, violated_pd_1081, 1081_detail, use_narcotics_take_liqour, extent)
	FK	personal_arrest REFERENCES ARRESTDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		family_arrest REFERENCES ARRESTDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		1081_detail REFERENCES ARRESTDETAILS NULLS NOT ALLOWED
		DELETE RESTRICT, UPDATE CASCADE

ARRESTDETAILS (arrest_id, name_of_court, nature_of_offense, case_disposition)

CHARANDREP (reference_id, name, role, addr, username)
	FK	name REFERENCES NAMEDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		addr REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

ORGANIZATION (org_id, org_name, org_addr)
	FK	org_addr REFERENCES ADDRESSDETAILS NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

MEMBERSHIPDETAILS (org_id, username, position, membership_date)
	FK	org_id REFERENCES ORGANIZATION NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE
		username REFERENCES USER NULLS NOT ALLOWED
			DELETE RESTRICT, UPDATE CASCADE

MISCELLANEOUS (misc_id, hobbies, language_dialect, speak_fluency, read_fluency, write_fluency, undergo_lie_detection)

CREDITINSTITUTION (inst_id, inst_name, inst_addr)

HISTORYLOGS (log_id, username, logged_date, logged_time, activity)

MILITARYRANK (rank_id, rank, rank_desc, branch)
