STUDENT MANAGEMENT SYSTEM - ASSIGNMENT 8, QUESTION 1

This project follows the structure and coding style of the supplied CRUD v3 project:
- db.php: MySQL connection using get_connection()
- Student.php: Student CRUD methods in a PHP class using MySQLi prepared statements
- navbar.php and footer.php: shared Bootstrap layout
- student_add.php: create student record
- student_display.php: list all student details in a table with Details, Update and Delete links
- student_details.php: view one student by Student ID
- student_update.php: update a student record
- student_delete.php: delete a student record
- index.php: home page
- student_management.sql: database/table setup

SETUP
1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin and import student_management.sql, or run its SQL in the SQL tab.
3. Confirm db.php settings match your MySQL setup. Defaults match the reference project (localhost, root, blank password, database mca26).
4. Copy this folder into htdocs, then open http://localhost/student_management_system/.

Student ID is auto-incrementing. Mobile and email are unique. Departments are CSE, CST, CEN, MSc and MCA. CGPA is validated from 0 to 10.
