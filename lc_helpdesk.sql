PGDMP         5                z            lc_helpdesk    14.2    14.2 j    b           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            c           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            d           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            e           1262    16427    lc_helpdesk    DATABASE     o   CREATE DATABASE lc_helpdesk WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';
    DROP DATABASE lc_helpdesk;
                postgres    false            �            1255    57459    close_ticket(text)    FUNCTION     b  CREATE FUNCTION public.close_ticket(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
		t_status_id INTEGER;
BEGIN 
		t_code := ticket_details::json->>'code';
		t_status_id := ticket_details::json->>'status_id';
		
		UPDATE tickets
		SET status_id = t_status_id
		WHERE code = t_code;
		
		RETURN true;
END; 
$$;
 8   DROP FUNCTION public.close_ticket(ticket_details text);
       public          postgres    false            �            1255    16428    login(text)    FUNCTION     6  CREATE FUNCTION public.login(user_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	v_username text;
	v_hashed_password text;
	results text;
BEGIN 
		v_username := user_details::json->>'username';
		v_hashed_password := user_details::json->>'password';
		
		json_result_obj=json_build_object('success',false,'data',null);
		
		select users.id from users into results  where username=v_username and hashed_pass=v_hashed_password;
		
		
		if found then
		
		 	update users set status=1 Where username=v_username;
		 
		
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at
			from users u
				INNER JOIN regions r
				ON r.id =u.region
				INNER JOIN departments d
				ON d.id =u.department_id
							 Where u.username=v_username
				)
		json_response;
		
		
		end if;
		
		 RETURN json_result_obj;
	
END; 
$$;
 /   DROP FUNCTION public.login(user_details text);
       public          postgres    false            �            1255    49260    note_insert(text)    FUNCTION       CREATE FUNCTION public.note_insert(note_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
		t_note TEXT;
		t_user_id INTEGER;
		t_date_created TEXT;
BEGIN 
		t_code := note_details::json->>'code';
  		t_note := note_details::json->>'note';
		t_user_id := note_details::json->>'user_id';
		t_date_created := note_details::json->>'note_date';
		
		INSERT INTO public.note(
			ticket_id, note, user_id, date_created)
			VALUES (t_code, t_note, t_user_id, t_date_created);
		
		RETURN true;
END; 
$$;
 5   DROP FUNCTION public.note_insert(note_details text);
       public          postgres    false            �            1255    65660    password_update(text)    FUNCTION     ^  CREATE FUNCTION public.password_update(user_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		u_username TEXT;
		n_pass TEXT;
		
BEGIN 
		u_username := user_details::json->>'username';
		n_pass := user_details::json->>'n_pass';
		
		UPDATE users
		SET hashed_pass = n_pass
		WHERE username = u_username;
		RETURN true;
END; 
$$;
 9   DROP FUNCTION public.password_update(user_details text);
       public          postgres    false                       1255    90219    print_ticket(text)    FUNCTION     1  CREATE FUNCTION public.print_ticket(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	sr_from_date TEXT;
	sr_to_date TEXT;
	sr_department INTEGER;
	sr_division INTEGER;
	sr_region INTEGER;
BEGIN 
		sr_from_date := ticket_details::json->>'from_date';
		sr_to_date := ticket_details::json->>'to_date';
		sr_department := ticket_details::json->>'department_id';
		sr_division := ticket_details::json->>'division_id';
		sr_region := ticket_details::json->>'region_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.date_created>=sr_from_date AND ti.date_created<=sr_to_date)
			 AND
			 (ti.department_id =sr_department)
			 AND
			 (ti.division_id =sr_division)
			 AND
			 (ti.region_id =sr_region)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 8   DROP FUNCTION public.print_ticket(ticket_details text);
       public          postgres    false                       1255    65644    profile_update(text)    FUNCTION     #  CREATE FUNCTION public.profile_update(user_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		u_user_id INTEGER;
		u_first_name TEXT;
		u_surname TEXT;
        u_email TEXT;
        u_phone TEXT;
        u_department TEXT;
        u_region TEXT;
		f_department_id INTEGER;
		f_region_id INTEGER;
		
BEGIN 
		u_user_id := user_details::json->>'user_id';
		u_first_name := user_details::json->>'first_name';
		u_surname := user_details::json->>'surname';
        u_email := user_details::json->>'email';
        u_phone := user_details::json->>'phone';
        u_department := user_details::json->>'department_id';
		u_region := user_details::json->>'region';
		
		SELECT departments.id FROM departments WHERE dept_name = u_department INTO f_department_id;
		SELECT regions.id FROM regions WHERE region_name = u_region INTO f_region_id;
		
		UPDATE users
		SET first_name = u_first_name,surname = u_surname,email = u_email,phone = u_phone,department_id = f_department_id,region = f_region_id
		WHERE id = u_user_id;
		RETURN true;
END; 
$$;
 8   DROP FUNCTION public.profile_update(user_details text);
       public          postgres    false                       1255    41066    re_assign_ticket(text)    FUNCTION     �  CREATE FUNCTION public.re_assign_ticket(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
        t_priority TEXT;
		t_assigned_userid INTEGER;
		t_date_assigned DATE;
		t_department_id INTEGER;
		t_status_id INTEGER;
		f_priority_id INTEGER;
BEGIN 
		t_code := ticket_details::json->>'code';
		t_priority := ticket_details::json->>'priority_id';
		t_assigned_userid := ticket_details::json->>'assigned_userid';
		t_date_assigned := ticket_details::json->>'date_assigned';
		t_department_id := ticket_details::json->>'department_id';
		t_status_id := ticket_details::json->>'status_id';
		
		SELECT priority.id FROM priority WHERE priority_name = t_priority INTO f_priority_id;
		
		UPDATE tickets
		SET priority_id = f_priority_id,assigned_userid = t_assigned_userid,date_assigned = t_date_assigned,department_id = t_department_id,
		status_id = t_status_id
		WHERE code = t_code;
		
		RETURN true;
END; 
$$;
 <   DROP FUNCTION public.re_assign_ticket(ticket_details text);
       public          postgres    false            �            1255    16429    select_all_tickets()    FUNCTION     Y  CREATE FUNCTION public.select_all_tickets() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
BEGIN 
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
SELECT *FROM tickets
)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 +   DROP FUNCTION public.select_all_tickets();
       public          postgres    false            �            1255    16430    select_all_users()    FUNCTION     L  CREATE FUNCTION public.select_all_users() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
BEGIN 
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at
from users u
INNER JOIN regions r
ON r.id =u.region
INNER JOIN departments d
ON d.id =u.department_id
ORDER BY u.created_at

)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 )   DROP FUNCTION public.select_all_users();
       public          postgres    false                       1255    122986    select_dept_users()    FUNCTION     �  CREATE FUNCTION public.select_dept_users() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
BEGIN 
json_result_obj=json_build_object(
	'success',true,
	'total_users', (select count (*) from users),
	'hardware_count', (select count (*) from users where department_id = 1),
	'hardware_users', (select json_agg(row_to_json(hu))
				 from
				 (
					select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.login_date
					from users u
					INNER JOIN regions r
					ON r.id =u.region
					INNER JOIN departments d
					ON d.id =u.department_id
					Where u.department_id = 1
				 ) hu),
	'networking_count', (select count (*) from users where department_id = 2),
	'networking_users', (select json_agg(row_to_json(nu))
				 from
				 (
					select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.login_date
					from users u
					INNER JOIN regions r
					ON r.id =u.region
					INNER JOIN departments d
					ON d.id =u.department_id
					Where u.department_id = 2
				 ) nu),
	'software_count', (select count (*) from users where department_id = 3),
	'software_users', (select json_agg(row_to_json(su))
				 from
				 (
					select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.login_date
					from users u
					INNER JOIN regions r
					ON r.id =u.region
					INNER JOIN departments d
					ON d.id =u.department_id
					Where u.department_id = 3
				 ) su),
	'desktop_support_count', (select count (*) from users where department_id = 4),
	'desktop_support_users', (select json_agg(row_to_json(dsu))
				 from
				 (
					select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.login_date
					from users u
					INNER JOIN regions r
					ON r.id =u.region
					INNER JOIN departments d
					ON d.id =u.department_id
					Where u.department_id = 4
				 ) dsu)
	);
		 
RETURN json_result_obj;
END; 
$$;
 *   DROP FUNCTION public.select_dept_users();
       public          postgres    false                       1255    106604 #   select_mytickets_to_dashboard(text)    FUNCTION     �  CREATE FUNCTION public.select_mytickets_to_dashboard(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	t_userid INTEGER;
BEGIN 
		t_userid := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 FROM tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE ti.assigned_userid =t_userid
			 ORDER BY ti.id DESC LIMIT 6
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 I   DROP FUNCTION public.select_mytickets_to_dashboard(ticket_details text);
       public          postgres    false            �            1255    90218    select_note_byticket(text)    FUNCTION     P  CREATE FUNCTION public.select_note_byticket(note_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	ticket TEXT;
BEGIN 
		ticket := note_details::json->>'ticket_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select n.id,n.ticket_id,n.note,u.first_name AS first_name,u.surname AS surname,n.date_created
			 from note n
			 INNER JOIN users u
			 ON u.id = n.user_id
			 Where n.ticket_id=ticket
)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 >   DROP FUNCTION public.select_note_byticket(note_details text);
       public          postgres    false                       1255    114798    select_status_tickets()    FUNCTION     3  CREATE FUNCTION public.select_status_tickets() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
BEGIN 
json_result_obj=json_build_object(
	'success',true,
	'total_tickets', (select count (*) from tickets),
	'open_count', (select count (*) from tickets where status_id = 1),
	'open_percentage', (select json_agg(row_to_json(op)) from (select count(*), avg( (status_id = 1)::int ) * 100 as open_percentage from tickets) op),
	'open_data', (select json_agg(row_to_json(ot))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 1 
				 ) ot),
	'pending_count', (select count (*) from tickets where status_id = 2),
	'pending_percentage', (select json_agg(row_to_json(pp)) from (select count(*), avg( (status_id = 2)::int ) * 100 as pending_percentage from tickets) pp),
	'pending_data', (select json_agg(row_to_json(pt))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 2 
				 ) pt),
	'on_hold_count', (select count (*) from tickets where status_id = 3),
	'on_hold_percentage', (select json_agg(row_to_json(ohp)) from (select count(*), avg( (status_id = 3)::int ) * 100 as on_hold_percentage from tickets) ohp),
	'on_hold_data', (select json_agg(row_to_json(oht))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 3
				 ) oht),
	'solved_count', (select count (*) from tickets where status_id = 4),
	'solved_percentage', (select json_agg(row_to_json(sp)) from (select count(*), avg( (status_id = 4)::int ) * 100 as solved_percentage from tickets) sp),
	'solved_data', (select json_agg(row_to_json(st))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 4 
				 ) st),
	'closed_count', (select count (*) from tickets where status_id = 5),
	'closed_percentage', (select json_agg(row_to_json(cp)) from (select count(*), avg( (status_id = 5)::int ) * 100 as closed_percentage from tickets) cp),
	'closed_data', (select json_agg(row_to_json(ct))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 5 
				 ) ct)
	);
		 
RETURN json_result_obj;
END; 
$$;
 .   DROP FUNCTION public.select_status_tickets();
       public          postgres    false                       1255    114799    select_status_tickets_by_dept()    FUNCTION     �  CREATE FUNCTION public.select_status_tickets_by_dept() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
BEGIN 
json_result_obj=json_build_object(
	'success',true,
	'hardware_total_tickets', (select count (*) from tickets where department_id = 1),
	'hardware_pending_count', (select count (*) from tickets where status_id = 2 and department_id = 1),
	'hardware_on_hold_count', (select count (*) from tickets where status_id = 3 and department_id = 1),
	'hardware_solved_count', (select count (*) from tickets where status_id = 4 and department_id = 1),
	'hardware_closed_count', (select count (*) from tickets where status_id = 5 and department_id = 1),
	'networking_total_tickets', (select count (*) from tickets where department_id = 2),
	'networking_pending_count', (select count (*) from tickets where status_id = 2 and department_id = 2),
	'networking_on_hold_count', (select count (*) from tickets where status_id = 3 and department_id = 2),
	'networking_solved_count', (select count (*) from tickets where status_id = 4 and department_id = 2),
	'networking_closed_count', (select count (*) from tickets where status_id = 5 and department_id = 2),
	'software_total_tickets', (select count (*) from tickets where department_id = 3),
	'software_pending_count', (select count (*) from tickets where status_id = 2 and department_id = 3),
	'software_on_hold_count', (select count (*) from tickets where status_id = 3 and department_id = 3),
	'software_solved_count', (select count (*) from tickets where status_id = 4 and department_id = 3),
	'software_closed_count', (select count (*) from tickets where status_id = 5 and department_id = 3),
	'desktop_support_total_tickets', (select count (*) from tickets where department_id = 4),
	'desktop_support_pending_count', (select count (*) from tickets where status_id = 2 and department_id = 4),
	'desktop_support_on_hold_count', (select count (*) from tickets where status_id = 3 and department_id = 4),
	'desktop_support_solved_count', (select count (*) from tickets where status_id = 4 and department_id = 4),
	'desktop_support_closed_count', (select count (*) from tickets where status_id = 5 and department_id = 4)
	
	);
		 
RETURN json_result_obj;
END; 
$$;
 6   DROP FUNCTION public.select_status_tickets_by_dept();
       public          postgres    false                       1255    114808 )   select_status_tickets_by_dept_per_month()    FUNCTION     N  CREATE FUNCTION public.select_status_tickets_by_dept_per_month() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
created_at TEXT;
BEGIN 
select to_char(CURRENT_DATE, 'YYYY') into created_at;
json_result_obj=json_build_object(
	'success',true,
	'hardware_jan_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-01%'),
	'hardware_feb_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-02%'),
	'hardware_mar_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-03%'),
	'hardware_apr_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-04%'),
	'hardware_may_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-05%'),
	'hardware_jun_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-06%'),
	'hardware_jul_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-07%'),
	'hardware_aug_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-08%'),
	'hardware_sep_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-09%'),
	'hardware_oct_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-10%'),
	'hardware_nov_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-11%'),
	'hardware_dec_count', (select count (*) from tickets where department_id = 1 and date_created like '%'||created_at||'-12%'),
	'networking_jan_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-01%'),
	'networking_feb_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-02%'),
	'networking_mar_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-03%'),
	'networking_apr_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-04%'),
	'networking_may_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-05%'),
	'networking_jun_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-06%'),
	'networking_jul_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-07%'),
	'networking_aug_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-08%'),
	'networking_sep_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-09%'),
	'networking_oct_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-10%'),
	'networking_nov_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-11%'),
	'networking_dec_count', (select count (*) from tickets where department_id = 2 and date_created like '%'||created_at||'-12%'),
	'software_jan_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-01%'),
	'software_feb_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-02%'),
	'software_mar_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-03%'),
	'software_apr_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-04%'),
	'software_may_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-05%'),
	'software_jun_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-06%'),
	'software_jul_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-07%'),
	'software_aug_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-08%'),
	'software_sep_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-09%'),
	'software_oct_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-10%'),
	'software_nov_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-11%'),
	'software_dec_count', (select count (*) from tickets where department_id = 3 and date_created like '%'||created_at||'-12%'),
	'desktop_support_jan_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-01%'),
	'desktop_support_feb_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-02%'),
	'desktop_support_mar_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-03%'),
	'desktop_support_apr_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-04%'),
	'desktop_support_may_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-05%'),
	'desktop_support_jun_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-06%'),
	'desktop_support_jul_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-07%'),
	'desktop_support_aug_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-08%'),
	'desktop_support_sep_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-09%'),
	'desktop_support_oct_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-10%'),
	'desktop_support_nov_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-11%'),
	'desktop_support_dec_count', (select count (*) from tickets where department_id = 4 and date_created like '%'||created_at||'-12%')
	);
		 
RETURN json_result_obj;
END; 
$$;
 @   DROP FUNCTION public.select_status_tickets_by_dept_per_month();
       public          postgres    false            �            1255    24687    select_ticket(text)    FUNCTION     c  CREATE FUNCTION public.select_ticket(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	statusid integer;
BEGIN 
		statusid := ticket_details::json->>'statusid';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 Where ti.status_id=statusid
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 9   DROP FUNCTION public.select_ticket(ticket_details text);
       public          postgres    false            �            1255    41068    select_ticket_byopenid(text)    FUNCTION     f  CREATE FUNCTION public.select_ticket_byopenid(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 FROM tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 Where ti.open_id=user_id
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 B   DROP FUNCTION public.select_ticket_byopenid(ticket_details text);
       public          postgres    false                        1255    41067    select_ticket_byuserid(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_byuserid(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id !=5)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 B   DROP FUNCTION public.select_ticket_byuserid(ticket_details text);
       public          postgres    false                       1255    98410    select_ticket_chart(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_chart(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	c_dept integer;
	c_status integer;
BEGIN 
		c_dept := ticket_details::json->>'department_id';
		c_status := ticket_details::json->>'status_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 FROM tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE
			 ti.department_id=c_dept
			 AND
			 ti.status_id=c_status
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 ?   DROP FUNCTION public.select_ticket_chart(ticket_details text);
       public          postgres    false            
           1255    98413    select_ticket_dept(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_dept(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	t_dept INTEGER;
BEGIN 
		t_dept := ticket_details::json->>'department_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT *
			 FROM tickets ti 
			 WHERE
			 ti.department_id=t_dept
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 >   DROP FUNCTION public.select_ticket_dept(ticket_details text);
       public          postgres    false                       1255    98412 "   select_ticket_dept_per_month(text)    FUNCTION     e  CREATE FUNCTION public.select_ticket_dept_per_month(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	t_dept INTEGER;
	t_month TEXT;
BEGIN 
		t_dept := ticket_details::json->>'department_id';
		t_month := ticket_details::json->>'month';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT *
			 FROM tickets ti 
			 WHERE
			 ti.department_id=t_dept
			 AND
			 ti.date_created LIKE ('%' || t_month || '%')
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 H   DROP FUNCTION public.select_ticket_dept_per_month(ticket_details text);
       public          postgres    false            �            1255    82026    select_ticket_logs(text)    FUNCTION       CREATE FUNCTION public.select_ticket_logs(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	region integer;
BEGIN 
		region := ticket_details::json->>'region_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.created_by,ti.date_created
			 FROM tickets ti
			 Where ti.region_id=region
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 >   DROP FUNCTION public.select_ticket_logs(ticket_details text);
       public          postgres    false                       1255    49264    select_ticket_myclosed(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_myclosed(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id =5)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 B   DROP FUNCTION public.select_ticket_myclosed(ticket_details text);
       public          postgres    false                       1255    49262    select_ticket_myonhold(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_myonhold(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id =3)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 B   DROP FUNCTION public.select_ticket_myonhold(ticket_details text);
       public          postgres    false                       1255    114812    select_ticket_myopen(text)    FUNCTION     d  CREATE FUNCTION public.select_ticket_myopen(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 FROM tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 Where ti.open_id=user_id
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 @   DROP FUNCTION public.select_ticket_myopen(ticket_details text);
       public          postgres    false                       1255    49261    select_ticket_mypending(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_mypending(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id =2)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 C   DROP FUNCTION public.select_ticket_mypending(ticket_details text);
       public          postgres    false                       1255    49263    select_ticket_mysolved(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_mysolved(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id =4)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 B   DROP FUNCTION public.select_ticket_mysolved(ticket_details text);
       public          postgres    false            	           1255    49268    select_ticket_performance(text)    FUNCTION     g  CREATE FUNCTION public.select_ticket_performance(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE ti.assigned_userid=user_id
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 E   DROP FUNCTION public.select_ticket_performance(ticket_details text);
       public          postgres    false                       1255    114811    select_ticket_to_handle(text)    FUNCTION     �  CREATE FUNCTION public.select_ticket_to_handle(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_id integer;
BEGIN 
		user_id := ticket_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 from tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 INNER JOIN departments de
			 ON de.id =ti.department_id
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE (ti.assigned_userid=user_id)
			 AND
			 (ti.status_id !=5)
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 C   DROP FUNCTION public.select_ticket_to_handle(ticket_details text);
       public          postgres    false                       1255    98411    select_tickets_to_dashboard()    FUNCTION       CREATE FUNCTION public.select_tickets_to_dashboard() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
BEGIN 
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			SELECT ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
			 FROM tickets ti
			 INNER JOIN  divisions d
			 ON d.id =ti.division_id
			 INNER JOIN regions r
			 ON r.id =ti.region_id
			 INNER JOIN priority pi
			 ON pi.id =ti.priority_id
			 INNER JOIN status s
			 ON s.id =ti.status_id
			 LEFT OUTER JOIN departments de
			 ON de.id =ti.department_id
			 LEFT OUTER JOIN users u
			 ON u.id =ti.assigned_userid
			 ORDER BY ti.id DESC LIMIT 6
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 4   DROP FUNCTION public.select_tickets_to_dashboard();
       public          postgres    false                       1255    122991    select_user_by_dept(text)    FUNCTION     �  CREATE FUNCTION public.select_user_by_dept(user_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_dept integer;
BEGIN 
		user_dept := user_details::json->>'user_dept';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at
from users u
INNER JOIN regions r
ON r.id =u.region
INNER JOIN departments d
ON d.id =u.department_id
			 Where u.department_id=user_dept
)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 =   DROP FUNCTION public.select_user_by_dept(user_details text);
       public          postgres    false            �            1255    16431    select_user_byid(text)    FUNCTION     �  CREATE FUNCTION public.select_user_byid(user_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	userid integer;
BEGIN 
		userid := user_details::json->>'user_id';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.updated_at
from users u
INNER JOIN regions r
ON r.id =u.region
INNER JOIN departments d
ON d.id =u.department_id
			 Where u.id=userid
)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 :   DROP FUNCTION public.select_user_byid(user_details text);
       public          postgres    false            �            1255    16513    select_user_byreg(text)    FUNCTION     �  CREATE FUNCTION public.select_user_byreg(user_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
	user_reg integer;
BEGIN 
		user_reg := user_details::json->>'user_reg';
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 from (
			select u.id,u.first_name,u.surname,u.username,u.email,u.phone,u.role,r.region_name AS region,d.dept_name AS department,u.status,u.created_at,u.updated_at
from users u
INNER JOIN regions r
ON r.id =u.region
INNER JOIN departments d
ON d.id =u.department_id
			 Where u.region=user_reg
)
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 ;   DROP FUNCTION public.select_user_byreg(user_details text);
       public          postgres    false            �            1255    73834    select_user_logs()    FUNCTION     e  CREATE FUNCTION public.select_user_logs() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
BEGIN 
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			 SElECT *
			 FROM user_logs
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 )   DROP FUNCTION public.select_user_logs();
       public          postgres    false                       1255    122988    select_user_logs_count(text)    FUNCTION       CREATE FUNCTION public.select_user_logs_count(log_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
l_username TEXT;
created_at TEXT;
BEGIN
l_username := log_details::json->>'username';
select to_char(CURRENT_DATE, 'YYYY') into created_at;
json_result_obj=json_build_object(
	'success',true,
	'total_logs_count', (select count (*) from user_logs where username = l_username),
	'success_logs_count', (select count (*) from user_logs where username = l_username and status = 1),
	'success_jan_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-01%'),
	'success_feb_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-02%'),
	'success_mar_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-03%'),
	'success_apr_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-04%'),
	'success_may_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-05%'),
	'success_jun_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-06%'),
	'success_jul_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-07%'),
	'success_aug_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-08%'),
	'success_sep_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-09%'),
	'success_oct_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-10%'),
	'success_nov_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-11%'),
	'success_dec_count', (select count (*) from user_logs where username = l_username and status = 1 and login_date like '%'||created_at||'-12%'),
	'failed_logs_count', (select count (*) from user_logs where username = l_username and status = 0),
	'failed_jan_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-01%'),
	'failed_feb_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-02%'),
	'failed_mar_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-03%'),
	'failed_apr_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-04%'),
	'failed_may_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-05%'),
	'failed_jun_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-06%'),
	'failed_jul_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-07%'),
	'failed_aug_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-08%'),
	'failed_sep_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-09%'),
	'failed_oct_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-10%'),
	'failed_nov_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-11%'),
	'failed_dec_count', (select count (*) from user_logs where username = l_username and status = 0 and login_date like '%'||created_at||'-12%')
	);
		 
RETURN json_result_obj;
END; 
$$;
 ?   DROP FUNCTION public.select_user_logs_count(log_details text);
       public          postgres    false                       1255    98419    select_user_performance()    FUNCTION     �  CREATE FUNCTION public.select_user_performance() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	json_result_obj TEXT DEFAULT '';
BEGIN 
		json_result_obj=json_build_object('success',true,'data',array_to_json(array_agg(
		 row_to_json(json_response)))) 
		 FROM (
			 SElECT ti.assigned_userid,u.first_name AS first_name,u.surname AS surname,
			 COUNT(ti.assigned_userid) total
			 FROM tickets ti
			 INNER JOIN users u
			 ON u.id =ti.assigned_userid
			 WHERE ti.status_id = 5
			 GROUP BY ti.assigned_userid, u.first_name, u.surname 
			 ORDER BY COUNT(ti.assigned_userid) DESC
			 LIMIT 6
		 )
		json_response;
		 
		 RETURN json_result_obj;
END; 
$$;
 0   DROP FUNCTION public.select_user_performance();
       public          postgres    false                       1255    122993    select_user_tasks(text)    FUNCTION     &  CREATE FUNCTION public.select_user_tasks(ticket_details text) RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE 
json_result_obj TEXT DEFAULT '';
t_user_id integer;
BEGIN 
t_user_id := ticket_details::json->>'user_id';
json_result_obj=json_build_object(
	'success',true,
	'total_count', (select count (*) from tickets where assigned_userid = t_user_id),
	'user_performance', (select json_agg(row_to_json(cp)) from (select count(*), avg( (status_id = 5)::int ) * 100 as performance_percentage from tickets where assigned_userid = t_user_id) cp),
	'handle_count', (select count (*) from tickets where assigned_userid = t_user_id and status_id != 5),
	'handle_data', (select json_agg(row_to_json(ht))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.assigned_userid = t_user_id and status_id != 5
				 ) ht),
	'open_count', (select count (*) from tickets where open_id = t_user_id),
	'open_data', (select json_agg(row_to_json(ot))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.open_id = t_user_id
				 ) ot),
	'pending_count', (select count (*) from tickets where status_id = 2 and assigned_userid = t_user_id),
	'pending_data', (select json_agg(row_to_json(pt))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 2 and ti.assigned_userid = t_user_id 
				 ) pt),
	'on_hold_count', (select count (*) from tickets where status_id = 3 and assigned_userid = t_user_id),
	'on_hold_data', (select json_agg(row_to_json(oht))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 3 and ti.assigned_userid = t_user_id
				 ) oht),
	'solved_count', (select count (*) from tickets where status_id = 4 and assigned_userid = t_user_id),
	'solved_data', (select json_agg(row_to_json(st))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 4 and ti.assigned_userid = t_user_id
				 ) st),
	'closed_count', (select count (*) from tickets where status_id = 5 and assigned_userid = t_user_id),
	'closed_data', (select json_agg(row_to_json(ct))
				 from
				 (
					select ti.id,ti.code,ti.subject,ti.details,ti.complainant_name,ti.complainant_number,ti.complainant_office,d.division_name AS division,r.region_name AS region,pi.priority_name AS priority,s.status_name AS status,u.first_name AS first_name,u.surname AS surname,de.dept_name AS department,ti.date_created,ti.date_assigned
					from tickets ti
					inner join  divisions d
					on d.id =ti.division_id
					inner join regions r
					on r.id =ti.region_id
					inner join priority pi
					on pi.id =ti.priority_id
					inner join status s
					on s.id =ti.status_id
					left outer join departments de
					on de.id =ti.department_id
					left outer join users u
					on u.id =ti.assigned_userid
					where ti.status_id = 5 and ti.assigned_userid = t_user_id 
				 ) ct)
	);
		 
RETURN json_result_obj;
END; 
$$;
 =   DROP FUNCTION public.select_user_tasks(ticket_details text);
       public          postgres    false                       1255    16432    ticket_insert(text)    FUNCTION     �	  CREATE FUNCTION public.ticket_insert(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_pin INTEGER;
		t_code TEXT;
		t_region_id INTEGER;
        t_division_id INTEGER;
        t_priority_id INTEGER;
		t_is_assigned INTEGER;
		t_assigned_userid INTEGER;
		t_date_assigned DATE;
		t_department_id INTEGER;
		t_subject TEXT;
		t_details TEXT;
		t_complainant_name TEXT;
		t_complainant_number TEXT;
		t_complainant_office TEXT;
		t_status_id INTEGER;
		t_open_id INTEGER;
		t_created_by TEXT;
		t_date_created TEXT;
		region_code TEXT;
		division_code TEXT;
		r_code TEXT;
		m_code INTEGER;
		t_lc TEXT;
BEGIN 
		t_region_id := ticket_details::json->>'region_id';
  		t_division_id := ticket_details::json->>'division_id';
		t_priority_id := ticket_details::json->>'priority_id';
		t_is_assigned := ticket_details::json->>'is_assigned';
		t_assigned_userid := ticket_details::json->>'assigned_userid';
		t_date_assigned := ticket_details::json->>'assigned_userid';
		t_department_id := ticket_details::json->>'department_id';
		t_subject := ticket_details::json->>'subject';
		t_details := ticket_details::json->>'details';
		t_complainant_name := ticket_details::json->>'complainant_name';
		t_complainant_number := ticket_details::json->>'complainant_number';
		t_complainant_office := ticket_details::json->>'complainant_office';
		t_status_id := ticket_details::json->>'status_id';
		t_open_id := ticket_details::json->>'open_id';
		t_pin := ticket_details::json->>'pin';
		t_created_by := ticket_details::json->>'created_by';
		t_date_created := ticket_details::json->>'date_created';
       
		SELECT max(tickets.id) FROM tickets INTO m_code;
	    SELECT regions.region_code FROM regions WHERE id=t_region_id INTO  region_code;
		SELECT divisions.division_code FROM divisions WHERE id=t_division_id INTO division_code;
		
		t_code := m_code+1;
		t_lc := 'LC';
		r_code := t_lc||region_code||division_code||t_code||t_pin;
		
		INSERT INTO public.tickets(
			code, region_id, division_id, priority_id, is_assigned, assigned_userid, date_assigned, department_id, subject, details, complainant_name, complainant_number, complainant_office, status_id, open_id, created_by, date_created)
			VALUES (r_code, t_region_id,t_division_id,t_priority_id, t_is_assigned, t_assigned_userid, t_date_assigned, t_department_id,t_subject,t_details,t_complainant_name,t_complainant_number,t_complainant_office, t_status_id, t_open_id, t_created_by, t_date_created);
		
		RETURN true;
END; 
$$;
 9   DROP FUNCTION public.ticket_insert(ticket_details text);
       public          postgres    false                       1255    32878    ticket_update(text)    FUNCTION       CREATE FUNCTION public.ticket_update(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
		t_region TEXT;
        t_division TEXT;
        t_priority TEXT;
		t_is_assigned INTEGER;
		t_assigned_userid INTEGER;
		t_date_assigned DATE;
		t_department_id INTEGER;
		t_subject TEXT;
		t_details TEXT;
		t_complainant_name TEXT;
		t_complainant_number TEXT;
		t_complainant_office TEXT;
		t_status_id INTEGER;
		f_region_id INTEGER;
		f_priority_id INTEGER;
		f_division_id INTEGER;
BEGIN 
		t_code := ticket_details::json->>'code';
		t_region := ticket_details::json->>'region_id';
  		t_division := ticket_details::json->>'division_id';
		t_priority := ticket_details::json->>'priority_id';
		t_is_assigned := ticket_details::json->>'is_assigned';
		t_assigned_userid := ticket_details::json->>'assigned_userid';
		t_date_assigned := ticket_details::json->>'date_assigned';
		t_department_id := ticket_details::json->>'department_id';
		t_subject := ticket_details::json->>'subject';
		t_details := ticket_details::json->>'details';
		t_complainant_name := ticket_details::json->>'complainant_name';
		t_complainant_number := ticket_details::json->>'complainant_number';
		t_complainant_office := ticket_details::json->>'complainant_office';
		t_status_id := ticket_details::json->>'status_id';
		
		SELECT regions.id FROM regions WHERE region_name = t_region INTO f_region_id;
		SELECT priority.id FROM priority WHERE priority_name = t_priority INTO f_priority_id;
		SELECT divisions.id FROM divisions WHERE division_name = t_division INTO f_division_id;
		
		UPDATE tickets
		SET region_id = f_region_id,division_id = f_division_id,priority_id = f_priority_id,subject = t_subject,details = t_details,complainant_name = t_complainant_name,complainant_number = t_complainant_number,
		complainant_office = t_complainant_office,is_assigned = t_is_assigned,assigned_userid = t_assigned_userid,date_assigned = t_date_assigned,department_id = t_department_id,status_id = t_status_id
		WHERE code = t_code;
		
		RETURN true;
END; 
$$;
 9   DROP FUNCTION public.ticket_update(ticket_details text);
       public          postgres    false            �            1255    57458    ticket_update_handle(text)    FUNCTION     �  CREATE FUNCTION public.ticket_update_handle(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
		t_status_id TEXT;
		f_status_id INTEGER;
BEGIN 
		t_code := ticket_details::json->>'code';
		t_status_id := ticket_details::json->>'status_id';
		
		SELECT status.id FROM status WHERE status_name = t_status_id INTO f_status_id;
		
		UPDATE tickets
		SET status_id = f_status_id
		WHERE code = t_code;
		
		RETURN true;
END; 
$$;
 @   DROP FUNCTION public.ticket_update_handle(ticket_details text);
       public          postgres    false                       1255    49258    ticket_update_myopen(text)    FUNCTION     �  CREATE FUNCTION public.ticket_update_myopen(ticket_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		t_code TEXT;
		t_region TEXT;
        t_division TEXT;
        t_priority TEXT;
		t_subject TEXT;
		t_details TEXT;
		t_complainant_name TEXT;
		t_complainant_number TEXT;
		t_complainant_office TEXT;
		f_region_id INTEGER;
		f_priority_id INTEGER;
		f_division_id INTEGER;
BEGIN 
		t_code := ticket_details::json->>'code';
		t_region := ticket_details::json->>'region_id';
  		t_division := ticket_details::json->>'division_id';
		t_priority := ticket_details::json->>'priority_id';
		t_subject := ticket_details::json->>'subject';
		t_details := ticket_details::json->>'details';
		t_complainant_name := ticket_details::json->>'complainant_name';
		t_complainant_number := ticket_details::json->>'complainant_number';
		t_complainant_office := ticket_details::json->>'complainant_office';
		
		SELECT regions.id FROM regions WHERE region_name = t_region INTO f_region_id;
		SELECT priority.id FROM priority WHERE priority_name = t_priority INTO f_priority_id;
		SELECT divisions.id FROM divisions WHERE division_name = t_division INTO f_division_id;
		
		UPDATE tickets
		SET region_id = f_region_id,division_id = f_division_id,priority_id = f_priority_id,subject = t_subject,details = t_details,
		complainant_name = t_complainant_name, complainant_number = t_complainant_number,complainant_office = t_complainant_office
		WHERE code = t_code;
		
		RETURN true;
END; 
$$;
 @   DROP FUNCTION public.ticket_update_myopen(ticket_details text);
       public          postgres    false            �            1255    16433    user_insert(text)    FUNCTION     �  CREATE FUNCTION public.user_insert(user_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		ufirst_name TEXT;
		usurname TEXT;
        uusername TEXT;
        uemail TEXT;
        uphone TEXT;
        uhashed_pass TEXT;
        urole TEXT;
        udepartment_id INTEGER;
        uregion INTEGER;
		ustatus TEXT;
		ulogin_date DATE;
		
BEGIN 
		ufirst_name := user_details::json->>'first_name';
		usurname := user_details::json->>'surname';
        uusername := user_details::json->>'username';
        uemail := user_details::json->>'email';
        uphone := user_details::json->>'phone';
        uhashed_pass := user_details::json->>'hashed_pass';
        urole := user_details::json->>'role';
        ustatus := user_details::json->>'status';
        udepartment_id := user_details::json->>'department_id';
		uregion := user_details::json->>'region';
		ustatus := user_details::json->>'status';
		ulogin_date := user_details::json->>'login_date';
		
		INSERT INTO public.users(
		first_name, surname, username, email, phone, hashed_pass, role, department_id, region, status, login_date)
		VALUES (ufirst_name, usurname, uusername, uemail, uphone, uhashed_pass, urole, udepartment_id, uregion, ustatus, ulogin_date);

		RETURN true;
END; 
$$;
 5   DROP FUNCTION public.user_insert(user_details text);
       public          postgres    false            �            1255    65650    user_logs_insert(text)    FUNCTION     *  CREATE FUNCTION public.user_logs_insert(log_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		l_username TEXT;
		l_user_ip TEXT;
		l_status INTEGER;
		l_login_date TEXT;
BEGIN 
		l_username := log_details::json->>'username';
  		l_user_ip := log_details::json->>'user_ip';
		l_status := log_details::json->>'status';
		l_login_date := log_details::json->>'login_date';
		
		INSERT INTO public.user_logs(
			username, user_ip, status, login_date)
			VALUES (l_username, l_user_ip, l_status, l_login_date);
		
		RETURN true;
END; 
$$;
 9   DROP FUNCTION public.user_logs_insert(log_details text);
       public          postgres    false            �            1255    65659    user_logs_update(text)    FUNCTION     �  CREATE FUNCTION public.user_logs_update(log_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		l_username TEXT;
		l_logout_date TEXT;
		
BEGIN 
		l_username := log_details::json->>'username';
		l_logout_date := log_details::json->>'logout_date';
		
		UPDATE user_logs
		SET logout_date = l_logout_date
		WHERE username = l_username
		AND id = 
		(
			SELECT MAX(user_logs.id)
			FROM user_logs 
			WHERE username = l_username
		);
		
		RETURN true;
END; 
$$;
 9   DROP FUNCTION public.user_logs_update(log_details text);
       public          postgres    false            �            1255    65643    user_update(text)    FUNCTION     r  CREATE FUNCTION public.user_update(user_details text) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
		u_user_id INTEGER;
		u_first_name TEXT;
		u_surname TEXT;
        u_email TEXT;
        u_phone TEXT;
        u_role TEXT;
        u_department TEXT;
        u_region TEXT;
		f_department_id INTEGER;
		f_region_id INTEGER;
		
BEGIN 
		u_user_id := user_details::json->>'user_id';
		u_first_name := user_details::json->>'first_name';
		u_surname := user_details::json->>'surname';
        u_email := user_details::json->>'email';
        u_phone := user_details::json->>'phone';
        u_role := user_details::json->>'role';
        u_department := user_details::json->>'department_id';
		u_region := user_details::json->>'region';
		
		SELECT departments.id FROM departments WHERE dept_name = u_department INTO f_department_id;
		SELECT regions.id FROM regions WHERE region_name = u_region INTO f_region_id;
		
		UPDATE users
		SET first_name = u_first_name,surname = u_surname,email = u_email,phone = u_phone,role = u_role,department_id = f_department_id,region = f_region_id
		WHERE id = u_user_id;
		RETURN true;
END; 
$$;
 5   DROP FUNCTION public.user_update(user_details text);
       public          postgres    false            �            1259    16434    departments    TABLE     l   CREATE TABLE public.departments (
    id integer NOT NULL,
    dept_name character varying(100) NOT NULL
);
    DROP TABLE public.departments;
       public         heap    postgres    false            �            1259    16437    departments_id_seq    SEQUENCE     �   CREATE SEQUENCE public.departments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.departments_id_seq;
       public          postgres    false    209            f           0    0    departments_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;
          public          postgres    false    210            �            1259    16438 	   divisions    TABLE     �   CREATE TABLE public.divisions (
    id integer NOT NULL,
    division_name character varying(100) NOT NULL,
    division_code character varying(5) NOT NULL
);
    DROP TABLE public.divisions;
       public         heap    postgres    false            �            1259    16441    divisions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.divisions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.divisions_id_seq;
       public          postgres    false    211            g           0    0    divisions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.divisions_id_seq OWNED BY public.divisions.id;
          public          postgres    false    212            �            1259    24672    note    TABLE     �   CREATE TABLE public.note (
    id integer NOT NULL,
    ticket_id character varying(200) NOT NULL,
    note text NOT NULL,
    user_id integer NOT NULL,
    date_created character varying(100)
);
    DROP TABLE public.note;
       public         heap    postgres    false            �            1259    73838    note_id_seq    SEQUENCE     |   CREATE SEQUENCE public.note_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 "   DROP SEQUENCE public.note_id_seq;
       public          postgres    false    220            h           0    0    note_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.note_id_seq OWNED BY public.note.id;
          public          postgres    false    225            �            1259    24664    priority    TABLE     m   CREATE TABLE public.priority (
    id integer NOT NULL,
    priority_name character varying(100) NOT NULL
);
    DROP TABLE public.priority;
       public         heap    postgres    false            �            1259    73840    priority_id_seq    SEQUENCE     �   CREATE SEQUENCE public.priority_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 &   DROP SEQUENCE public.priority_id_seq;
       public          postgres    false    219            i           0    0    priority_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.priority_id_seq OWNED BY public.priority.id;
          public          postgres    false    226            �            1259    16442    regions    TABLE     �   CREATE TABLE public.regions (
    id integer NOT NULL,
    region_name character varying(100) NOT NULL,
    region_code character varying(5) NOT NULL
);
    DROP TABLE public.regions;
       public         heap    postgres    false            �            1259    16445    regions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.regions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.regions_id_seq;
       public          postgres    false    213            j           0    0    regions_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.regions_id_seq OWNED BY public.regions.id;
          public          postgres    false    214            �            1259    24694    status    TABLE     �   CREATE TABLE public.status (
    id integer DEFAULT nextval('public.divisions_id_seq'::regclass) NOT NULL,
    status_name character varying(100) NOT NULL
);
    DROP TABLE public.status;
       public         heap    postgres    false    212            �            1259    73837    status_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 $   DROP SEQUENCE public.status_id_seq;
       public          postgres    false    221            k           0    0    status_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.status_id_seq OWNED BY public.status.id;
          public          postgres    false    224            �            1259    16446    tickets    TABLE     }  CREATE TABLE public.tickets (
    id integer NOT NULL,
    code character varying(200),
    region_id integer NOT NULL,
    division_id integer NOT NULL,
    priority_id integer NOT NULL,
    subject character varying(500) NOT NULL,
    details text,
    complainant_name character varying(200),
    complainant_number character varying(15),
    complainant_office character varying(50),
    is_assigned integer NOT NULL,
    assigned_userid integer,
    date_assigned date,
    department_id integer,
    status_id integer NOT NULL,
    open_id integer,
    created_by character varying(200),
    date_created character varying(100)
);
    DROP TABLE public.tickets;
       public         heap    postgres    false            �            1259    16454    tickets_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tickets_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.tickets_id_seq;
       public          postgres    false    215            l           0    0    tickets_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.tickets_id_seq OWNED BY public.tickets.id;
          public          postgres    false    216            �            1259    65645 	   user_logs    TABLE     �   CREATE TABLE public.user_logs (
    id integer NOT NULL,
    username character varying(100),
    user_ip character varying(100),
    status integer NOT NULL,
    login_date character varying(100),
    logout_date character varying(100)
);
    DROP TABLE public.user_logs;
       public         heap    postgres    false            �            1259    73835    user_logs_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 '   DROP SEQUENCE public.user_logs_id_seq;
       public          postgres    false    222            m           0    0    user_logs_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.user_logs_id_seq OWNED BY public.user_logs.id;
          public          postgres    false    223            �            1259    16455    users    TABLE       CREATE TABLE public.users (
    id integer NOT NULL,
    first_name character varying(100) NOT NULL,
    username character varying(100) NOT NULL,
    email character varying(100),
    phone character varying(50) NOT NULL,
    hashed_pass character varying(200) NOT NULL,
    role character varying(100),
    department_id integer,
    region integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    login_date date,
    surname character varying(100) NOT NULL,
    status character varying(50)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16460    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    217            n           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    218            �           2604    16461    departments id    DEFAULT     p   ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);
 =   ALTER TABLE public.departments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209            �           2604    16462    divisions id    DEFAULT     l   ALTER TABLE ONLY public.divisions ALTER COLUMN id SET DEFAULT nextval('public.divisions_id_seq'::regclass);
 ;   ALTER TABLE public.divisions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    211            �           2604    73839    note id    DEFAULT     b   ALTER TABLE ONLY public.note ALTER COLUMN id SET DEFAULT nextval('public.note_id_seq'::regclass);
 6   ALTER TABLE public.note ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    220            �           2604    73841    priority id    DEFAULT     j   ALTER TABLE ONLY public.priority ALTER COLUMN id SET DEFAULT nextval('public.priority_id_seq'::regclass);
 :   ALTER TABLE public.priority ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    219            �           2604    16463 
   regions id    DEFAULT     h   ALTER TABLE ONLY public.regions ALTER COLUMN id SET DEFAULT nextval('public.regions_id_seq'::regclass);
 9   ALTER TABLE public.regions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213            �           2604    16464 
   tickets id    DEFAULT     h   ALTER TABLE ONLY public.tickets ALTER COLUMN id SET DEFAULT nextval('public.tickets_id_seq'::regclass);
 9   ALTER TABLE public.tickets ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215            �           2604    73836    user_logs id    DEFAULT     l   ALTER TABLE ONLY public.user_logs ALTER COLUMN id SET DEFAULT nextval('public.user_logs_id_seq'::regclass);
 ;   ALTER TABLE public.user_logs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            �           2604    16465    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217            N          0    16434    departments 
   TABLE DATA           4   COPY public.departments (id, dept_name) FROM stdin;
    public          postgres    false    209   �_      P          0    16438 	   divisions 
   TABLE DATA           E   COPY public.divisions (id, division_name, division_code) FROM stdin;
    public          postgres    false    211   `      Y          0    24672    note 
   TABLE DATA           J   COPY public.note (id, ticket_id, note, user_id, date_created) FROM stdin;
    public          postgres    false    220   ~`      X          0    24664    priority 
   TABLE DATA           5   COPY public.priority (id, priority_name) FROM stdin;
    public          postgres    false    219   =a      R          0    16442    regions 
   TABLE DATA           ?   COPY public.regions (id, region_name, region_code) FROM stdin;
    public          postgres    false    213   ya      Z          0    24694    status 
   TABLE DATA           1   COPY public.status (id, status_name) FROM stdin;
    public          postgres    false    221   Fb      T          0    16446    tickets 
   TABLE DATA             COPY public.tickets (id, code, region_id, division_id, priority_id, subject, details, complainant_name, complainant_number, complainant_office, is_assigned, assigned_userid, date_assigned, department_id, status_id, open_id, created_by, date_created) FROM stdin;
    public          postgres    false    215   �b      [          0    65645 	   user_logs 
   TABLE DATA           [   COPY public.user_logs (id, username, user_ip, status, login_date, logout_date) FROM stdin;
    public          postgres    false    222   Vd      V          0    16455    users 
   TABLE DATA           �   COPY public.users (id, first_name, username, email, phone, hashed_pass, role, department_id, region, created_at, login_date, surname, status) FROM stdin;
    public          postgres    false    217   �h      o           0    0    departments_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.departments_id_seq', 4, true);
          public          postgres    false    210            p           0    0    divisions_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.divisions_id_seq', 13, true);
          public          postgres    false    212            q           0    0    note_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.note_id_seq', 5, true);
          public          postgres    false    225            r           0    0    priority_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.priority_id_seq', 1, false);
          public          postgres    false    226            s           0    0    regions_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.regions_id_seq', 16, true);
          public          postgres    false    214            t           0    0    status_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.status_id_seq', 1, false);
          public          postgres    false    224            u           0    0    tickets_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.tickets_id_seq', 25, true);
          public          postgres    false    216            v           0    0    user_logs_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.user_logs_id_seq', 176, true);
          public          postgres    false    223            w           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 30, true);
          public          postgres    false    218            �           2606    16467    departments departments_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.departments DROP CONSTRAINT departments_pkey;
       public            postgres    false    209            �           2606    16469    tickets tickets_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.tickets DROP CONSTRAINT tickets_pkey;
       public            postgres    false    215            �           2606    65649    user_logs user_logs_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.user_logs
    ADD CONSTRAINT user_logs_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.user_logs DROP CONSTRAINT user_logs_pkey;
       public            postgres    false    222            �           2606    16471    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217            N   ?   x�3��H,J)O,J�2��K-)�/���K�2��O+��p��g��(���p��qqq *�W      P   [   x�3��	sa.#΀0_�e����\&��@Q �2��Q��,�@�ciJf	����e�阜�_��9;s�s:;�BdA,�=... ���      Y   �   x�mα
�0��y�ۺؒ\�j���(E��%`�Q�B���-B(�v|�K��fy:�׈H���z���4܍k��q��2�W(���n4��mS���mbY(Δ@��x�+����0h���T\�bAD>�t?�mꢺ��@�KRL�	�@�pmg Xg&����rB�J Op      X   ,   x�3���/�2��MM�,��2���L��2�-JO�+����� ��	G      R   �   x�5��N�0��3O�'@��q[Y-�QL��U�ʮ\���I����ή�1Z����Gi���{EVא���|C����m�]�E�߸��3��O�3�K���[�g�SL�{Ǘ�l���-�#dԯ9	�A��QG�hV��L�η4�E/v7�78�n�����+����Jz�C,Y�8X�����iF      Z   8   x�3�H�K��K�2���S���I�2���)KM�2�t��/29�R�b���� k��      T   �  x����n�0���S���bȔ�%�e�0dM�"Z�E��D�-�2�o?*��n0����#���O��z��%�Ȅ(n�s@W��������<�C�;#R~ĲK��6�խ��{꬐(3Ĳ�Jl�Z��I�'���)g���j}�Q���K~�Ո��D5�����`:gc
t�j`��9St��U'�һ��>FJ�ej���H�	ߢD��o:�j�\6W�`>��?�7K�G�������M*{���@n�s����Ľ��M�w���c{�2$�o�8���CG��ofGQ�(���f�SF�ٛ��������6���~ dl�_'���+���s�d]M�g�`��`ɉU`:yh��D�z\����7���=�gۙ����6���;������vu
�I;WK�V�K�eS9�M�қ�O�w�ϋ��]�&I����m      [   ,  x��XKn9]�N�H��D}�s�l�'0ÀO�?$e-U*Et��X�DR�vy~z~����z{� ��/x! ���+�M��,��!���Ϸ���������_|m	�y�2z���1��5������z�}���};�Эc�0�(m�B�f=�B0�J��`oM�����ٵ�NIl���-5a�QKWȒ���(���$��OX�q�u{�e�K(�]��MC/1
%����q��D�E�1����:�}�@,�'����9�z����z�ÚN��G�n�$a�����u�aQ�I�k���R<b�+��L�8�z(����/M�r$��P]��Q��^յRX*�mS��HE�r���?�����1Kr�*�H��&��S5���[W]���a���hT�#�|E9{E��Q<�2J����#�a�?�<թ(p�&�+ʆsh�r5�i�%Mr�(l�K�y�p�D��Qذ�`V�B�H��W��#��������m��� 4��}��B�w��JX/Q����G�Þ��!xDX�Њ��M�STŉG��Ћ�G�U˩��2a�HT��ģ�N�����qr�J�9�=ՅG����%�+ŉG�� z�#��<J�4;��O&2'��8}JD���ټ����T�=- z��	�q����g�9�ɪ*�G�M���Ђ%�2�x>�us�{��\x��V/Lv��#�A�b�s5a��	#�N���Mnh�I^�89���ۂ��y�H:���3e�uű4���2e)䩉�gMIq9�ί���qȰ(j�#E���a�uŤXi.�F��Ůl>�^�!O�A�Q�ԠA�Չ]�ĉSFH��{w��%3�՘�p���s�:`&�b����eG�D��j*�º��cR�ޘ�Îh�M��bv��/O��^�nO�?�/sR�80�m����#/K�<`|�e�T��"ў+'a�tֲV|����q�혌z,�y��}����V1?s���"��#�Αb��񨍴��OX���v�~�O����HN�:ÊE{T�~!���6      V   $  x����N�0���S��v�&9�4�	��+�lM�J��u{}�?��p�}������U8�T�*�؅��k{趢IG��@�1��!�Ֆ�r��]�l�6Q�&Y[�ևP�@�@�����6G��z�¢$6	VWO�ކ4~�b{ч�tH?K$�J������};�p^�_h\���*=����7ID�rC�L�S߇�;�� �0�i1"ݧ%�;���7��7G�l<;1_W�z����a9x���h.M��4NФS'��J��J-��s,=IO<S�c����b�ٻȲ�\�j     