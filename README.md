
![gh_nhm_readme_pic](https://github.com/user-attachments/assets/31cc6169-c77e-4a3a-8be5-4500e7b484c5)

# Housing Managent intranet - PHP Excercise

## 💡 Introduction

Hosted in: https://nnmaki.com/housingmanagementintranet/

The goal of this exercise project was to practice the various functions of the PHP programming language and to utilize an SQL database in such a way that data from a web form can be directly saved, retrieved, and modified in the database tables.

For example, I modified the site into a fault report/ticket system for a housing company, where residents can report a fault in their apartment. The report is saved in the database and can be retrieved as a list, which is printed on the page as separate cards.

In the same context, I also implemented a login system with PHP. The site has a form through which the user can register by providing a username, password, and email address. The system saves this information in the database. After registering, the user can log in with the credentials they created. The login uses PHP's built-in password encryption function password_hash(), so passwords are stored encrypted in the database. During login, the system compares the password entered by the user with the encrypted password in the database. If the credentials match, the script creates a unique session ID that is stored in the user's browser, allowing login to be recognized.

The ticket system and the login system are independent functions, but I combined them in this exercise project. Unlike in the real world, logged-in tickets can also be freely viewed.

Finally, I made a bilingual version of the site. I built a separate file for each language, from which the PHP script retrieves the necessary translations using the key-value principle. This required a lot of work, but it allows content changes to be made in one file, making it easy to manage the different language versions.

During the project, I also practiced PHP's MVC architecture, which separates functionalities into their own files. This makes it easier to update and troubleshoot the system, especially in larger projects. I also added error handling functions to the login system, which check, among other things, the completion of mandatory fields, the correct format of the email address, and whether the username or email is already in use. Based on these, clear error messages are displayed to the user.

All form inputs are sanitized with PHP's built-in htmlspecialchars() function, which cleans the data entered by the user into a safe format. In SQL queries, I used the prepared statements method, where the input is treated as plain data before being saved to the database, which prevents SQL injection.

This project significantly opened up the features of PHP for me, including the server-level functions of the backend language.

## 🔧 Tech talk

Used
- <b>PHP</b> -Main language for functionality and database connection
- <b>HTML & CSS</b> -Web layout
- <b>Javascript</b> -Popup-windows and to confirm actions
- <b>SQL & PhpMyAdmin</b> -Database 
- <b>Other tools</b> -Linux/Ubuntu, Visual Studio Code, Git & Github and Gimp
