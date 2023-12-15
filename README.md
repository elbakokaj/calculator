README for My Calculator Project
Overview
This project is a web-based calculator application with user authentication. It allows users to perform basic arithmetic operations and maintains a history of calculations.
Features
•	Basic arithmetic operations: Addition, Subtraction, Multiplication, Division, and Brackets.
•	User authentication: Login and Registration.
•	Calculation history: Viewable history of past calculations.
Installation
1.	Clone the repository.
2.	Set up a MySQL database and import the provided schema.
3.	Configure database settings in config/db_connect.php.
4.	Run the application on a PHP server.
Usage
•	Users must register and log in to access the calculator.
•	Perform calculations using the web interface.
•	View past calculations in the history section.
Dependencies
•	PHP
•	MySQL
•	JavaScript
•	Bootstrap for styling
Directory Structure
•	assets/: JavaScript files.
•	config/: Database configuration.
•	public/: HTML files for UI.
•	src/: PHP classes and scripts.
Security
•	Passwords are hashed using PHP's password_hash function.
•	PHP session management is used for user authentication.

