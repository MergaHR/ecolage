# Ecolage - Educational Payment Management System

A modern PHP application built with CodeIgniter 3 for managing student payments and academic records.

## Features

- **User Management**: Secure authentication with role-based access
- **Student Management**: Complete student record management
- **Payment Processing**: Track and validate student payments
- **Academic Management**: Manage levels and mentions
- **Reporting**: Generate payment receipts and statistics

## Security Improvements

- ✅ Password hashing with PHP's `password_hash()`
- ✅ Input validation and sanitization
- ✅ SQL injection prevention
- ✅ Session management
- ✅ Form validation

## Project Structure

```
ecolage/
├── application/
│   ├── controllers/
│   │   ├── Auth.php          # Authentication controller
│   │   ├── Dashboard.php     # Main dashboard
│   │   ├── Students.php      # Student management
│   │   ├── Payments.php      # Payment processing
│   │   ├── Academic.php      # Academic data
│   │   └── Users.php         # User management
│   ├── models/
│   │   ├── User_model.php   # User operations
│   │   ├── Student_model.php # Student operations
│   │   ├── Payment_model.php # Payment operations
│   │   └── Academic_model.php # Academic operations
│   └── views/                # View files
├── assets/                   # Static assets
├── system/                   # CodeIgniter core
├── composer.json            # Dependencies
├── railway.json              # Railway deployment config
└── healthcheck.php           # Health check endpoint
```

## Installation

### Local Development

1. Clone the repository
2. Install dependencies: `composer install`
3. Configure database in `application/config/database.php`
4. Set up virtual host pointing to project root
5. Access the application

### Railway Deployment

1. Push your code to GitHub
2. Connect your repository to Railway
3. Railway will automatically detect and deploy the application
4. Configure environment variables in Railway dashboard

## Environment Variables

Copy `.env.example` to `.env` and configure:

```env
DB_HOST=your_railway_db_host
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
DB_NAME=your_db_name
```

## Database Setup

Import your database schema and ensure the following tables exist:

- `administration` - Admin users
- `compte` - User accounts
- `etudiant` - Students
- `niveau` - Academic levels
- `mention` - Academic mentions
- `payement` - Payment records
- `modepayement` - Payment methods
- `type_compte` - Account types

## Usage

1. **Login**: Access `/auth/login`
2. **Dashboard**: Main interface after login
3. **Student Management**: Add, edit, delete students
4. **Payments**: Process and validate payments
5. **Reports**: Generate receipts and statistics

## API Endpoints

- `GET /healthcheck.php` - Health check
- `POST /auth/authenticate` - User login
- `GET /dashboard` - Main dashboard
- `POST /students/create` - Create student
- `POST /payments/create_payment` - Process payment

## Security Notes

- All passwords are hashed using PHP's `password_hash()`
- Input validation is implemented using CodeIgniter's form validation
- SQL queries use CodeIgniter's active record pattern to prevent injection
- Session management is properly configured

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

MIT License - see LICENSE file for details
