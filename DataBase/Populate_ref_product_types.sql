create or replace procedure populate_ref_product_types(v_products_no INTEGER) as
  v_code NUMBER(9) := 000000001;
  v_parent_code NUMBER(9);
  v_description CHAR(20);
begin
  for eachProduct in 1..v_products_no
    loop
      v_parent_code := v_code;
      v_description := concat('Perfume ', initcap(dbms_random.string('L', 5)));
      insert into ref_product_types values (v_code, v_parent_code, v_description);
      v_code := v_code + 1;
    end loop;
end populate_ref_product_types;