# User Enrolment Manager – Take Home Task

A take-home assignment for managing user enrolments in a simplified Moodle-like PHP system.

## 🚀 Features Implemented

- Enrol users into courses
- Unenrol users from courses
- Retrieve all courses a user is enrolled in
- Validation for:
  - Duplicate enrolments
  - Invalid user/course IDs
  - Unenrolling users not enrolled
- Comprehensive unit tests with PHPUnit
- CLI interface for enrol/unenrol actions - data not stored
- Basic logging for enrolment activity

## 📜 Commit Discipline

All commits follow Conventional Commits, and the project was developed using clean Git practices with feature branching, isolated changes, and descriptive messages.

## ⚙️ Tech Stack

- PHP 8.0+
- PHPUnit (via Composer)

## 📂 Folder Structure

   ```bash
    src/
    ├── enrolment_manager.php
    ├── user.php
    └── course.php
    tests/
    └── enrolment_manager_test.php
    cli.php
    composer.json
    phpunit.xml
    README.md
   ```

## 📦 Setup

1. **Install dependencies**
   Run the following to install PHPUnit:

   ```bash
   composer install
   ```

2. **Make logs folder**:

   ```bash
   mkdir logs
   ```

3. **Run the tests**:

   ```bash
   ./vendor/bin/phpunit
   ```

## 🧰 Usage via CLI

   ```bash
   php cli.php enrol 1 200
   php cli.php unenrol 1 200
   php cli.php list 1
   ```

## 🧠 Reflections

This was a great hands-on exercise to build and test functionality that mimics real-world application logic. I enjoyed working through validation flows, thinking through edge cases, and reinforcing best practices around testing and version control.

## 🤝 Acknowledgement

Grateful for the opportunity to work on this challenge. It was a rewarding deep dive into writing reliable, readable, and testable PHP. I am excited to walk through the approach and decisions during the upcoming interview.

Thanks,
Alan2K
