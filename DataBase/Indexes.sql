//indecsi la filtrarea inregistrarilor

CREATE INDEX index1 ON Payments(payment_amount);
/
select * from Payments where payment_amount=400;
/
//indecsi la join

//indecsi bazati pe functii

CREATE INDEX index2 ON Customers(upper(first_name));
/
select * from CUSTOMERS where upper(first_name) = 'ELENA';
/