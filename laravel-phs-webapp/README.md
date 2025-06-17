# Personal History Statement (PHS) Online System

A web-based application for managing Personal History Statements (PHS) for the Philippine Military Academy. This system allows users to submit and manage their PHS forms online, while administrators can review and process these submissions.

## Features

- User Authentication and Authorization
- Personal History Statement (PHS) Form Submission
- Admin Dashboard for PHS Management
- User Management System
- Responsive Design
- Secure Data Handling

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM (for frontend assets)
- Git

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd laravel-phs-webapp
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pma_phs_dbs
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations:
```bash
php artisan migrate
```

8. Seed the database with initial data (optional):
```bash
php artisan db:seed
```

9. Start the development server:
```bash
php artisan serve
```

10. In a separate terminal, compile frontend assets:
```bash
npm run dev
```

The application should now be running at `http://localhost:8000`

## Default Admin Account

After running the migrations and seeders, you can log in with these default credentials:

```
Username: admin
Password: admin123
```

**Important**: Change these credentials immediately after first login.

## Directory Structure

```
laravel-phs-webapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── images/
│   └── css/
├── resources/
│   └── views/
│       ├── admin/
│       ├── client/
│       └── layouts/
└── routes/
    └── web.php
```

## User Roles

1. **Administrator**
   - Full access to admin dashboard
   - Manage user accounts
   - Review and process PHS submissions
   - Generate reports

2. **Client/User**
   - Submit PHS forms
   - View submission status
   - Update personal information

## Security Features

- Password hashing
- CSRF protection
- Input validation
- Role-based access control
- Secure session handling

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email [support@example.com] or create an issue in the repository.

## Acknowledgments

- Philippine Military Academy
- Laravel Framework
- Tailwind CSS
- Font Awesome
