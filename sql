CREATE DATABASE Table_Structures;
USE Table_Structures;
CREATE TABLE EmployeeMaster (
    EmployeeCode INT NOT NULL PRIMARY KEY,
	EPassword VARCHAR(255) NOT NULL,
    FullName VARCHAR(50) NOT NULL,
	Designation VARCHAR(50),
    emailId VARCHAR(100) NOT NULL,
	Gender CHAR(1) CHECK (Gender IN ('M', 'F')),
	DateOfJoining DATE,
	ContactNumber VARCHAR(50),
	ReportingManagerCode INT,
	FOREIGN KEY (ReportingManagerCode) REFERENCES EmployeeMaster(EmployeeCode)
);
INSERT INTO EmployeeMaster (EmployeeCode, EPassword, FullName, Designation, EmailId, Gender, DateOfJoining, ContactNumber, ReportingManagerCode)
VALUES (1, 'Kavish123', 'Kavish Dham', 'Software Engineer', 'kavish.dham@example.com' , 'M' , '2022-01-10' , '9818627381', null),
       (2, 'Prisha123', 'Prisha Malik', 'Project Manager', 'prisha.malik@example.com', 'F' , '2022-03-12', '9762534289', 1),
	   (3, 'Harshit123', 'Harshit Garg', 'Marketing Specialist', 'harshit.garg@example.com' , 'M' , '2020-12-10' , '9816279381', 2),
	   (4, 'Suhawani123', 'Suhawani', 'HR Manager', 'suhawani@example.com' , 'F' , '2021-01-12' , '9765439721', 3);

SELECT * FROM EmployeeMaster;

INSERT INTO EmployeeMaster (EmployeeCode, EPassword, FullName, Designation, EmailId, Gender, DateOfJoining, ContactNumber, ReportingManagerCode)
VALUES (5, 'Vasu123', 'Vasu Goel' , 'Database Manager', 'vasu.goel@example.com' , 'M' , '2021-01-10' , '9818557381', 4);

SELECT * FROM EmployeeMaster;
INSERT INTO EmployeeMaster (EmployeeCode, EPassword, FullName, Designation, EmailId, Gender, DateOfJoining, ContactNumber, ReportingManagerCode)
VALUES (6, 'Jeetesh123', 'Jeetesh Meena' , 'Database Manager', 'jeetesh.meena@example.com' , 'M' , '2021-05-05' , '9865331980', 5);

SELECT * FROM EmployeeMaster;

CREATE TABLE ExpenseMaster (
    ExpenseCode INT NOT NULL PRIMARY KEY,	ExpenseDescription VARCHAR(50) NOT NULL
);

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (100, 'Mobile Bills');
SELECT * FROM ExpenseMaster;

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (101, 'Taxi Charges');

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (102, 'Canteen Bills');

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (103, 'Miscellaneous');

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (104, 'Team Lunch');

INSERT INTO ExpenseMaster(ExpenseCode,ExpenseDescription)
VALUES (105, 'Relocation Expense');

SELECT * FROM ExpenseMaster;


CREATE TABLE ClaimMaster (
    CM_ClaimID INT NOT NULL PRIMARY KEY,
	CM_EmployeeCode INT,
	CM_Status VARCHAR(50),
	CM_ContactNo VARCHAR(50),
	CMRepMgrCode INT,
	CM_SubmittedON DATE,
	CM_ExpenseCode VARCHAR(20),
	CM_Amount DECIMAL(10 , 2),
	CM_Description VARCHAR(500)
);
INSERT INTO ClaimMaster( CM_ClaimID, CM_EmployeeCode, CM_Status,CM_ContactNo, CMRepMgrCode, CM_SubmittedON, CM_ExpenseCode, CM_Amount, CM_Description)
Values(1, 101, 'pending', '9876775520', 201, '2023-06-15', 'EXP001', 400.00, 'Travel expensis for client meetings');
INSERT INTO ClaimMaster( CM_ClaimID, CM_EmployeeCode, CM_Status,CM_ContactNo, CMRepMgrCode, CM_SubmittedON, CM_ExpenseCode, CM_Amount, CM_Description)
Values(2, 102, 'approved', '9859823109', 202, '2023-06-20', 'EXP002', 100.00, 'Meal expenses during business trip');
INSERT INTO ClaimMaster( CM_ClaimID, CM_EmployeeCode, CM_Status,CM_ContactNo, CMRepMgrCode, CM_SubmittedON, CM_ExpenseCode, CM_Amount, CM_Description)
Values(3, 103, 'Rejected', '9718677442', 203, '2023-07-01', 'EXP003', 1200.00, 'Hotel expenses for training');

SELECT * FROM ClaimMaster;

CREATE TABLE Statusmaster (
    SM_StatusID INT NOT NULL PRIMARY KEY,
	SM_StatusDescription VARCHAR(50)
);

INSERT INTO Statusmaster(SM_StatusID,SM_StatusDescription)
VALUES(1, 'submitted');
INSERT INTO Statusmaster(SM_StatusID,SM_StatusDescription)
VALUES(2, 'approved');
INSERT INTO Statusmaster(SM_StatusID,SM_StatusDescription)
VALUES(3, 'rejected');
INSERT INTO Statusmaster(SM_StatusID,SM_StatusDescription)
VALUES(4, 'refer back');
INSERT INTO Statusmaster(SM_StatusID,SM_StatusDescription)
VALUES(5, 'new');
SELECT * FROM Statusmaster;
