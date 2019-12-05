# AssignAdminComEmpProject
Assignment Small project Admin Company and Employee

##Requirement




1.[DONE] Auth
3.[DONE] seed email applocumadmin@yopmail.com and password “Password@123”
7.[DONE] Companies DB table consists of these fields:
		Name (Required), 
		email(Required), 
		logo (minimum 100×100), 
		website

8.[DONE] Employees DB table consists of these fields: 
	Full name (required), 
	Company (foreign key to Companies), 
	email(Required), 
	phone(Required)


4. Email Regex validation and Password validations will be such that password must contain at least one uppercase, one lowercase and one symbol with at least 8 characters 

2. Admin in CRUD for Companies and Employees

5. Companies and Employees using JQuery AJAX. Create update feature using Ajax with the popup.

6. Email notification: send email to admin email whenever a new company is entered
9. Store companies logos in storage/app/public folder and make them accessible from public
10. Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page.
11. uniqure email