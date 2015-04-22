create or replace procedure populate_customers(v_customers_no INTEGER) as
  v_customer_id NUMBER(9) := 000000001;
  v_organisation_or_person CHAR(20) := 'Person';
  v_organisation_name CHAR(20);
  v_gender CHAR(10);
  v_first_name CHAR(20);
  v_middle_initial CHAR(1);
  v_last_name CHAR(20);
  v_email_address CHAR(30);
  v_login_name CHAR(20);
  v_login_password CHAR(20);
  v_phone_number NUMBER(20);
  v_address_line_1 CHAR(40);
  v_address_line_2 CHAR(40) := null;
  v_address_line_3 CHAR(40) := null;
  v_address_line_4 CHAR(40) := null;
  v_town_city CHAR(20);
  v_county CHAR(20);
  v_country CHAR(20);
BEGIN
  FOR eachCustomer IN 1..v_customers_no
    LOOP
      v_organisation_name := CONCAT('Person',TO_CHAR(eachCustomer));
      if(dbms_random.random > 0)
        then
          v_gender := 'Female';
        else 
          v_gender := 'Male';
      end if;
      v_first_name := CONCAT('FirstName',TO_CHAR(eachCustomer));
      v_middle_initial := dbms_random.string('U', 1);
      v_last_name := CONCAT('LastName',TO_CHAR(eachCustomer));
      v_email_address := CONCAT('Email',TO_CHAR(eachCustomer));
      v_login_name := CONCAT('Login',TO_CHAR(eachCustomer));
      v_login_password := CONCAT('Pass',TO_CHAR(eachCustomer));
      v_phone_number := dbms_random.value(100000000000, 999999999999);
      v_address_line_1 := CONCAT('Address',TO_CHAR(eachCustomer));
      v_town_city := CONCAT('TownCity',TO_CHAR(eachCustomer));
      v_county := CONCAT('County',TO_CHAR(eachCustomer));
      v_country := CONCAT('Country',TO_CHAR(eachCustomer));
      INSERT INTO customers VALUES(v_customer_id, v_organisation_or_person, v_organisation_name, v_gender,
                                   v_first_name, v_middle_initial, v_last_name, v_email_address,
                                   v_login_name, v_login_password, v_phone_number, v_address_line_1,
                                   v_address_line_2, v_address_line_3, v_address_line_4, v_town_city, v_county, v_county);
      v_customer_id := v_customer_id + 1;
    END LOOP;
END populate_customers;