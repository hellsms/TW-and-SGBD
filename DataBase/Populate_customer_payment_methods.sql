create or replace procedure populate_customer_pm(v_payments_no INTEGER) as
  v_cp_id NUMBER(9) := 1;
  v_c_id NUMBER(9) := 1;
  v_pm_code NUMBER(9) := 1;
  v_credit_card_no NUMBER(5);
  v_pm_details CHAR(40);
begin
  for eachPayment in 1..v_payments_no
    loop
      v_credit_card_no := to_number(dbms_random.value(10000,99999));
      v_pm_details := concat('Deails for method no ', eachPayment);
      insert into customer_payment_methods values(v_cp_id, v_c_id, v_pm_code, v_credit_card_no, v_pm_details);
      v_cp_id := v_cp_id + 1;
      v_c_id := v_c_id + 1;
      v_pm_code := v_pm_code + 1;
    end loop;
end populate_customer_pm;