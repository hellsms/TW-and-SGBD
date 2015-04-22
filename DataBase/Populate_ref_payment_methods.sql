create or replace procedure populate_ref_payment_methods(v_payments_no INTEGER) as
   v_code NUMBER(9) := 000000001;
   v_description CHAR(30);
begin
  for eachPayment in 1..v_payments_no
    loop
      v_description := concat('Description ', initcap(dbms_random.string('L', 10)));
      insert into ref_payment_methods values(v_code, v_description);
      v_code := v_code + 1;
    end loop;
end populate_ref_payment_methods;