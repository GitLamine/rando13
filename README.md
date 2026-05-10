# rando13
My first back-end web app with php mysql
Rando13 is an application aimed at sharing hiking experiences. Please note that the application is still under development and some features may not be fully finalized.

# Technologies Used
PHP native
Bootstrap 5.3
Native JavaScript

# Prerequisites
Before getting started, make sure you have the following installed:
Laragon with Apache server
PHP 8.1.10
MailHog executable for managing email sending. You can access it at http://localhost:8025/.

# Features
Browse articles shared by hikers.
User registration and login.
Newsletter subscription.
Adding articles by users.

# Structure
Rando13 follows a Separation of Concerns (SoC) based structure. Here's how the files are organized:
View files are located in the views folder.
Data processing files are located in the src folder.
A functions.php file is included, containing functions that support the data processing files for each page.
Examples:
To display the user profile, use profile.php in the views folder, while the associated data processing is done in profile_process.php in the src folder.
To add an article, use add_articles.php in the views folder, and the associated data processing is done in add_articles_process.php in the src folder.

# Installation
Clone this repository to your local machine.
Ensure that the mentioned prerequisites are installed and configured.
Run migrations to create the necessary database and tables.
Launch the application using Laragon or any other compatible local server.

Contribution
Contributions to improving Rando13 are welcome! If you would like to contribute, please follow these guidelines:

Fork this repository.
Create a branch for your feature or fix.
Make the necessary changes.
Submit a pull request to the main branch.
License
Rando13 is distributed under the [Insert your chosen license here] license.

# contact
To provide feedback, please send it to my email.: mohamedlamine.silarbi@gmail.com
