# 📝 Personal History Statement System  (Initial Design)
> A Laravel + PHP-based web application for managing and submitting PHS (Personal History Statements) — built for the Philippine Military Academy.

---

## ⚙️ Tech Stack

| Layer      | Technology          |
|------------|---------------------|
| Backend    | PHP 8+, Laravel 10  |
| Frontend   | Blade (Laravel templating), Bootstrap 5 |
| Database   | MySQL               |
| Server     | Apache (via XAMPP/Laragon recommended) |
| ORM        | Eloquent            |
| Auth       | Laravel Breeze / Custom Auth Middleware |
| Environment| `.env` configuration for DB/APP URL     |

---

## 📁 Project Structure

```text
personal-history-statement/
├── app/Http/Controllers/              # Laravel Controllers (Auth, Admin, PHS, User)
├── app/Models/                        # Eloquent Models for each DB table
├── database/migrations/               # Table structure in Laravel syntax
├── resources/views/                   # Blade templates for views
│   ├── auth/                          # Login, register, password reset
│   ├── applicant/                     # PHS forms, progress, review
│   ├── admin/                         # Admin dashboard, user management
│   └── components/                    # Shared UI (alerts, headers, footers)
├── routes/web.php                     # Web routes (GET, POST)
├── public/                            # Public entry point (index.php)
├── .env                               # Local environment config
└── README.md                          # This file
```

---

## 🚀 Key Features

### 👨‍🎓 Applicant
- Secure login and password reset
- Fill and update PHS in sections (e.g. personal, military, education)
- Track submission progress via color-coded indicators
- Review and submit final form

### 🛡️ Admin
- View list of applicants and their PHS status
- Filter, search, and manage accounts
- Print-ready version of submissions
- View system activity logs

---

## 🛠️ Setup Guide (Local)

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/personal-history-statement.git
   cd personal-history-statement
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Setup your `.env`**
   Copy `.env.example` → `.env` and set:
   ```dotenv
   DB_DATABASE=phs_system
   DB_USERNAME=root
   DB_PASSWORD=
   APP_URL=http://localhost
   ```

4. **Generate Laravel keys & migrate**
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   ```

5. **Run the development server**
   ```bash
   php artisan serve
   ```

6. **Access the app**
   ```
   http://localhost:8000
   ```

---

## 📖 Database Overview

The system follows a normalized schema with over 30 tables, including:

- `users`, `user_details`, `name_details`, `birth_details`
- `military_history`, `military_awards`, `military_assignments`
- `educational_background`, `employment_history`
- `credit_rep`, `arrest_record`, `foreign_visits`, `history_logs`

Each table uses proper foreign key constraints and Laravel relationships (hasOne, hasMany, belongsTo).

---

## 🧩 Components

### Controllers
- `AuthController` – Handles login, logout, password changes
- `ApplicantController` – Manages PHS sections and form flow
- `AdminController` – Views users, submissions, logs
- `DashboardController` – Role-based homepage redirect and stats

### Models
- `User`, `UserDetail`, `MilitaryHistory`, `EducationDetail`, etc.
- All use Eloquent ORM relationships

### Views
- Blade templates: Responsive and organized into partials
- Includes Bootstrap 5-based layout and alert components

---

## 🎯 Future Plans

- [ ] Integrate Laravel Sanctum for API access
- [ ] Export PHS as downloadable PDF
- [ ] Attach signature and ID image upload to final submission

---

## 👨‍💻 Developers

- **John Henrich B. Collo**
- **Anthony R. Llena**
- **Joanalyn Mae S. Palangdan**
- **Kurshan Craig Sandler L. Casilen**

---

> 📌 Initial requirement for the internship at the Philippine Military Academy.

