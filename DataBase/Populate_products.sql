create or replace procedure populate_products(v_products_no INTEGER) as
  v_id NUMBER(9) := 000000001;
  v_code NUMBER(9) := 000000001;
  v_auth NUMBER(9) := 000000001;
  v_name CHAR(20);
  v_price NUMBER(10);
  v_review CHAR(20);
  v_size CHAR(20);
  v_description CHAR(20);
  v_other CHAR(40);
begin
  for eachProduct in 1..v_products_no
    loop
      v_name := concat('Pefume', eachProduct);
      v_price := dbms_random.value(1, 100000);
      v_review := concat('Review', eachProduct);
      v_size := concat(eachProduct, 'ml');
      v_description := concat('Perfume ', initcap(dbms_random.string('L', 5)));
      insert into products values (v_id, v_code, v_auth, v_name, v_price, v_review, v_size, v_description, v_other);
      v_code := v_code + 1;
      v_id := v_id + 1;
      v_auth := v_auth + 1;
    end loop;
end populate_products;