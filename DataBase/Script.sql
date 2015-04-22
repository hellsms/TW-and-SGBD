DROP TABLE Customers cascade constraints;

/

CREATE TABLE Customers (

customer_id NUMBER(3) PRIMARY KEY,

organisation_or_person CHAR(20) NOT NULL,

organisation_name CHAR(20) NOT NULL,

gender CHAR(10) NOT NULL,

first_name CHAR(20) NOT NULL,

middle_initial CHAR(1) NOT NULL,

last_name CHAR(20) NOT NULL,

email_address CHAR(30) NOT NULL,

login_name CHAR(20) UNIQUE,

login_password CHAR(20) UNIQUE,

phone_number NUMBER(20) NOT NULL,

address_line_1 CHAR(40) NOT NULL,

address_line_2 CHAR(40) NULL,

address_line_3 CHAR(40) NULL,

address_line_4 CHAR(40) NULL,

town_city CHAR(20) NOT NULL,

county CHAR(20) NOT NULL,

country CHAR(20) NOT NULL);

/

DROP TABLE Ref_Product_Types cascade constraints;

/

CREATE TABLE Ref_Product_Types (

product_type_code NUMBER(3) PRIMARY KEY,

parent_product_type_code NUMBER(3) REFERENCES Ref_Product_Types(product_type_code),

product_type_description CHAR(20) NOT NULL ) ;

/

DROP TABLE Products cascade constraints;

/

CREATE TABLE Products (

product_id NUMBER(3) PRIMARY KEY,

product_type_code NUMBER(3) REFERENCES Ref_product_Types (product_type_code),

ret_merchandise_auth_nr NUMBER(3) NOT NULL,

product_name CHAR(20) NOT NULL,

product_price NUMBER(10) CHECK(product_price>0),

product_review CHAR(20) NOT NULL,

product_size CHAR(20) NOT NULL,

product_description CHAR(20) NOT NULL,

other_product_details CHAR(40) UNIQUE);

/

DROP TABLE Ref_Payment_Methods cascade constraints;

/

CREATE TABLE Ref_Payment_Methods (

payment_method_code NUMBER(3) PRIMARY KEY,

payment_method_description CHAR(30) NOT NULL);

/

DROP TABLE Customer_Payment_Methods cascade constraints;

/

CREATE TABLE Customer_Payment_Methods (

customer_payment_id NUMBER(3) PRIMARY KEY,

customer_id NUMBER(3) REFERENCES Customers (customer_id),

payment_method_code NUMBER(3) REFERENCES Ref_Payment_Methods (payment_method_code),

credit_card_number NUMBER(5) ,

payment_method_details CHAR(40) UNIQUE);

/

DROP TABLE Ref_Order_Status_Codes cascade constraints;

/

CREATE TABLE Ref_Order_Status_Codes (

order_status_code NUMBER(3) PRIMARY KEY,

order_status_description CHAR(30) NOT NULL);

/

DROP TABLE Shipment_Items cascade constraints;

/

CREATE TABLE Shipment_Items (

shipment_id NUMBER(3) NOT NULL,

order_item_id NUMBER(3) NOT NULL,

PRIMARY KEY(shipment_id,order_item_id));

/

DROP TABLE Ref_Invoice_Status_Codes cascade constraints;

/

CREATE TABLE Ref_Invoice_Status_Codes (

invoice_status_code NUMBER(3) PRIMARY KEY,

invoice_status_description CHAR(30) NOT NULL);

/

DROP TABLE Ref_Order_Item_Status_Codes cascade constraints;

/

CREATE TABLE Ref_Order_Item_Status_Codes (

order_item_status_code NUMBER(3) PRIMARY KEY,

order_item_status_description CHAR(30) NOT NULL);

/

DROP TABLE Orders cascade constraints;

/

CREATE TABLE Orders (

order_id NUMBER(3) PRIMARY KEY,

customer_id NUMBER(3) REFERENCES Customers (customer_id),

order_status_code NUMBER(3) REFERENCES Ref_Order_Status_Codes (order_status_code),

date_order_placed DATE NULL,

order_details CHAR(40) UNIQUE);

/

DROP TABLE Invoices cascade constraints;

/

CREATE TABLE Invoices (

invoice_number NUMBER(3) PRIMARY KEY,

order_id NUMBER(3) REFERENCES Orders (order_id),

invoice_status_code NUMBER(3) REFERENCES Ref_Invoice_Status_Codes (invoice_status_code),

invoice_date DATE NULL,

invoice_details CHAR(40) UNIQUE);

/

DROP TABLE Payments cascade constraints;

/

CREATE TABLE Payments (

payment_id NUMBER(3) PRIMARY KEY,

invoice_number NUMBER(3) REFERENCES Invoices (invoice_number),

payment_date DATE ,

payment_amount NUMBER(20) NOT NULL);

/

DROP TABLE Order_Items cascade constraints;

/

CREATE TABLE Order_Items (

order_item_id NUMBER(3) PRIMARY KEY,

product_id NUMBER(3) REFERENCES Products (product_id),

order_id NUMBER(3) REFERENCES Orders (order_id),

order_item_status_code NUMBER(3) REFERENCES Ref_Order_Status_Codes (order_status_code),

order_item_quantity NUMBER(1) NOT NULL,

order_item_price NUMBER(3) NOT NULL,

RMA_number NUMBER(3) UNIQUE,

RMA_issued_by CHAR(20) NOT NULL,

RMA_issued_date DATE NOT NULL,

other_order_item_details CHAR(40) );

/

DROP TABLE Shipments cascade constraints;

/

CREATE TABLE Shipments (

shipment_id NUMBER(3) PRIMARY KEY,

order_id NUMBER(3) REFERENCES Orders (order_id),

invoice_number NUMBER(3) REFERENCES Invoices (invoice_number),

shipment_tracking_number NUMBER(20) NOT NULL,

shipment_date DATE ,

other_shipment_details CHAR(40) );
