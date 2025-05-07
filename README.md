# Saipali Lost and Found System

This is a PHP-based web application designed to manage a Lost and Found system. The system allows users to report lost or found items, while administrators can manage and oversee the platform through a secure admin login.

---
### Demo 

![Screenshot 2023-10-21 154835](https://github.com/likyCoder/saipalilostandfound/blob/main/assets/screenshot/shot1.png)



## Features

- **User-Friendly Interface**:
  - Users can report lost or found items.
  - View listings of reported items.

- **Admin Dashboard**:
  - Secure admin login for managing the platform.
  - View, edit, or delete reports.

- **Database-Driven**:
  - MySQL database to store user reports and admin data.

- **Customizable**:
  - Built with PHP and HTML for easy customization.
  - Hack support for enhanced type checking during development.

---

## Requirements

To run this project, ensure you have the following installed:

- **Web Server**: Apache/Nginx
- **PHP**: Version 7.4 or above
- **MySQL**: Version 5.7 or above
- **Composer**: For dependency management (optional)

---

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/likyCoder/saipalilostandfound.git
   cd saipalilostandfound

   Set up the MySQL database:

### 2. Create a new MySQL database.
Import the database.sql file (if available) into the database.
### 3. Configure database connection:

### 4. Open the configuration file (e.g., config.php or .env).
Update the database credentials (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) to match your setup.
### 5. Start the development server:

    ## bash
php -S localhost:8000

### 6. Access the application:
Open http://localhost:8000 in your browser.
### 7. Admin Login
The admin login credentials are stored in the MySQL database. Use the following default credentials to log in:

Username: admin
Password: admin123
### 8. For security, change the default admin credentials after the first login.

Folder Structure
/public: Contains public-facing files (e.g., HTML, CSS, JavaScript).
/src: Core PHP files for handling logic.
/database: SQL scripts for database setup.
/config: Configuration files for database and application settings.
Contributing
Feel free to contribute to this project! Follow these steps:

Fork the repository.
Create a new branch:
bash
git checkout -b feature-name
Commit your changes:
  ## bash
git commit -m "Add feature name"
Push to your branch:
      ## bash
git push origin feature-name
Open a Pull Request.

### License
This project is licensed under the MIT License.

## Contact
For any queries or issues, please contact [likyCoder.](https:likyjosh.likesyou.org)

