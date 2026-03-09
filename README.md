# Blog CMS - Content Management System

A full-featured PHP-based Blog Content Management System with admin dashboard, user authentication, category and tag management, and responsive public-facing pages.

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Database Schema](#database-schema)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

---

## 📖 Overview

This is a complete Blog Content Management System built with PHP and MySQL. It provides a comprehensive admin panel for managing blog posts, categories, and tags, along with public-facing pages for readers to browse and read articles.

---

## ✨ Features

### Admin Panel
- **Dashboard** - View all blog posts with search and sort functionality
- **Blog Management** - Create, edit, and delete blog posts
- **Category Management** - Full CRUD operations for blog categories
- **Tag Management** - Full CRUD operations for blog tags
- **User Authentication** - Secure login and registration system

### Public Pages
- **Home Page** - Featured blog posts showcase
- **Blog Archive** - Browse all published blog posts
- **Single Post View** - Read individual blog articles
- **About Page** - Information about the blog/site

### Security
- Password hashing using BCRYPT
- SQL injection prevention with prepared statements
- Session-based authentication
- Input validation and sanitization

---

## 🛠 Tech Stack

| Component | Technology |
|-----------|------------|
| **Backend** | PHP 8.0+ |
| **Database** | MySQL |
| **Frontend** | HTML5, CSS3, JavaScript |
| **Authentication** | Session-based with password hashing |
| **Design** | Custom responsive CSS |

---

## 📂 Project Structure

```
DBMS LAB FINAL PROJECT/
├── connection.php          # Database connection
├── index.php              # Admin dashboard
├── login.php              # Login/Registration page
├── logout.php             # Logout handler
├── layout.php             # Admin layout template
│
├── create.php             # Create new blog post
├── edit.php               # Edit existing blog post
├── delete.php             # Delete blog post
│
├── category.php           # Category list
├── categoryCreate.php     # Create category
├── categoryEdit.php       # Edit category
├── categoryDelete.php     # Delete category
│
├── tag.php                # Tag list
├── tagCreate.php          # Create tag
├── tagEdit.php            # Edit tag
├── tagDelete.php          # Delete tag
│
├── landing/               # Public facing pages
│   ├── home.php           # Home/Landing page
│   ├── blog.php           # Blog archive page
│   ├── about.php          # About page
│   └── single_blog.php    # Single blog post view
│
├── samiya/                # Frontend assets
│   ├── css/               # Stylesheets
│   │   ├── style.css
│   │   ├── login.css
│   │   └── responsive.css
│   ├── js/                # JavaScript files
│   │   ├── script.js
│   │   └── login.js
│   └── img/               # Images and icons
│
└── uploads/               # User uploaded files
```

---

## 🚀 Installation

### Prerequisites

- PHP 8.0 or higher
- MySQL 8.0 or higher
- XAMPP, WAMP, or any PHP/MySQL local server

### Steps

1. **Clone or Download the Project**
   
   Copy all files to your web server's document root (e.g., `htdocs` for XAMPP).

2. **Set Up the Database**

   - Open phpMyAdmin or MySQL command line
   - Create a new database named `dbms_final_project`
   - Import the database schema (see Database Schema section)

3. **Configure Database Connection**

   Edit `connection.php` if needed:
   ```php
   $host = 'localhost';      
   $user = 'root';  
   $password = '';
   $database = 'dbms_final_project';
   ```

4. **Start the Server**

   Start Apache and MySQL in XAMPP/WAMP and access the project:
   ```
   http://localhost/DBMS LAB FINAL PROJECT/
   ```

---

## ⚙️ Configuration

### Database Connection

The main configuration is in [`connection.php`](connection.php):

```php
$host = 'localhost';      // Database host
$user = 'root';           // Database username
$password = '';          // Database password
$database = 'dbms_final_project'; // Database name
```

### Admin Access

1. Navigate to the login page
2. Click "Create an account" to register a new admin user
3. Password requirements:
   - At least 6 characters
   - Must include at least one number
   - Must include at least one special character

---

## 📖 Usage

### Admin Panel

1. **Login** - Access the admin dashboard at `index.php`
2. **Dashboard** - View all blog posts, search, and manage content
3. **Categories** - Create and manage blog categories
4. **Tags** - Create and manage blog tags
5. **Logout** - Securely log out from the admin panel

### Creating a Blog Post

1. Go to Dashboard → Click "Add New"
2. Fill in the blog details:
   - Title
   - Slug (URL-friendly version)
   - Short Description
   - Featured Image
   - Category
   - Tags
3. Click "Submit" to publish

### Public Pages

Access public pages via the `landing/` directory:
- Home: `landing/home.php`
- Blog: `landing/blog.php`
- About: `landing/about.php`

---

## 🗄 Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

### Categories Table
```sql
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);
```

### Tags Table
```sql
CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);
```

### Blogs Table
```sql
CREATE TABLE blogs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description TEXT,
    description LONGTEXT,
    featured_image VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
```

### Blog-Tag Junction Table
```sql
CREATE TABLE blog_tag (
    id INT PRIMARY KEY AUTO_INCREMENT,
    blog_id INT,
    tag_id INT,
    FOREIGN KEY (blog_id) REFERENCES blogs(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);
```

---

## 📸 Screenshots

| Page | Description |
|------|-------------|
| Login/Register | Secure authentication with form validation |
| Dashboard | Overview of all blog posts with search & sort |
| Category Management | CRUD operations for categories |
| Tag Management | CRUD operations for tags |
| Blog Editor | Rich text editor for creating posts |
| Public Home | Responsive landing page |
| Blog Archive | Grid layout of all blog posts |

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👤 Author

**Samiya's Blog & Management System**
- Email: samiya.r.cse.2k23@gmail.com

---

## 🙏 Acknowledgments

- PHP Documentation
- MySQL Documentation
- Open source community

---

<p align="center">Made with ❤️ for DBMS Lab Final Project</p>
