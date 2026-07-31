# Halal Food Guide

A lightweight, web-based Halal food guide helper application. Search for ingredients or E-codes (food additive emulsifier codes) to find out whether their status is Halal, Haram, or Syubhat (doubtful).

## Features

- **Search by Ingredient Name**: Look up common food ingredients to check their status.
- **Search by E-Code**: Fast lookup of emulsifier / food additive codes (e.g., E120).
- **A-Z Letter Filtering**: Browse ingredients alphabetically.
- **Lightweight Design**: Self-contained client-side styling and dependency-free native tooltips.
- **Modern Animations**: High-performance CSS transitions replacing JS-based interval loops.

## Directory Structure

```text
halal/
├── assets/
│   ├── css/
│   │   └── halal.css             # Main stylesheet (with native tooltip & animations)
│   ├── img/
│   │   ├── find.png              # Search icon asset
│   │   └── mail.png              # Contact mail icon asset
│   └── js/
│       ├── halal.js              # Core application logic (Vanilla JS - Development)
│       ├── halal.min.js          # Core application logic (Vanilla JS - Production/Minified)
├── db/
│   └── db_halal.sql              # Database schema and initial data
├── inc/
│   ├── config.php                # Environment variables and application config
│   └── process.php               # Database queries and response processing logic
├── .env                          # Environment variables configuration (ignored by Git)
├── .gitignore                    # Git ignore file
├── index.php                     # Application entry point
├── LICENSE                       # License information
└── README.md                     # Documentation
```

## Setup & Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL / MariaDB
- Web server (e.g., Apache, Nginx, or Laragon / XAMPP)

### Installation Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/cahyadsn/halal.git
   cd halal
   ```

2. **Configure the Database**:
   - Create a new MySQL database named `db_halal`.
   - Import the SQL schema file located at `db/db_halal.sql` into your database.
     ```bash
     mysql -u your_username -p db_halal < db/db_halal.sql
     ```

3. **Set Up Environment Variables**:
   Create a `.env` file in the root directory (you can copy the database credentials there):
   ```ini
   DB_HOST=localhost
   DB_USER=your_username_here
   DB_PASS=your_password_here
   DB_NAME=db_halal
   ```

4. **Run the Application**:
   Serve the project folder using your local server setup (such as Laragon or PHP's built-in web server):
   ```bash
   php -S localhost:8000
   ```
   Open `http://localhost:8000` in your web browser.

## Technologies Used

- **Backend**: Native PHP (with `.env` configuration integration)
- **Frontend**: HTML5, Vanilla CSS (CSS transitions & custom tooltips), Vanilla JavaScript (No jQuery or external dependencies)
- **Database**: MySQL

## Changelog

### [2.0.1] - 2026-07-31
- **Dependency Removal**: Completely removed jQuery and ClueTip library dependencies.
- **Vanilla JS Refactor**: Created unminified clean Vanilla JS implementation `assets/js/halal.js` by refactoring `assets/js/halal.jquery.js` to vanilla JS.
- **Vanilla CSS Transitions**: Migrated menu item expansion and rotation animations to native CSS transforms and transitions.
- **Custom Tooltips**: Created a lightweight, native JavaScript custom tooltip implementation.
- **Directory Restructuring**:
  - Relocated styling, script, and image assets to `assets/` subdirectories.
  - Relocated database schema to `db/`.
  - Moved backend logic and config scripts to `inc/`.
- **Bug Fixes**:
  - Fixed a path bug preventing `.env` files from being loaded by `inc/config.php`.
  - Fixed a critical database loop logic bug in `inc/process.php` (`$resi` undefined variable).
- **Security Hardening**:
  - Escaped user parameters in database queries with `$db->real_escape_string` to protect against SQL injections.
  - Escaped echoed variables using `htmlspecialchars` to secure against XSS.
- **Project Configuration**:
  - Created `GEMINI.md` to document the workspace configuration.
  - Added `.env` and `GEMINI.md` to `.gitignore`.

## Author

- **Cahya DSN** - [cahyadsn@gmail.com](mailto:cahyadsn@gmail.com)
