# Installation Guide

This guide will walk you through the complete installation process for Serendib Journeys.

## 📋 Prerequisites

Before installing, ensure you have the following installed on your system:

- **PHP**: 8.0.2 or higher
- **Composer**: Latest version
- **Node.js**: 16.x or higher
- **MySQL**: 8.0 or higher
- **Git**: For version control

### System Requirements

- **Memory**: Minimum 512MB RAM (1GB recommended)
- **Storage**: At least 1GB free space
- **Network**: Internet connection for package downloads

## 🚀 Installation Steps

### 1. Clone the Repository

```bash
git clone <repository-url>
cd serendib-journeys-web
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env` file with your configuration:

```env
APP_NAME="Serendib Journeys"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serendib_journeys
DB_USERNAME=your_username
DB_PASSWORD=your_password

STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
STRIPE_WEBHOOK_SECRET=your_stripe_webhook_secret

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Database Setup

Create the database:

```sql
CREATE DATABASE serendib_journeys CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run migrations:

```bash
php artisan migrate
```

### 7. Seed the Database (Optional)

```bash
php artisan db:seed
```

### 8. Storage Setup

Create storage links:

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 10. Set Permissions (Linux/Mac)

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🔧 Configuration

### Stripe Configuration

1. Create a Stripe account at [stripe.com](https://stripe.com)
2. Get your API keys from the Stripe dashboard
3. Update the `.env` file with your Stripe credentials
4. Configure webhook endpoint in Stripe dashboard:
   - URL: `https://yourdomain.com/stripe/webhook`
   - Events: `payment_intent.succeeded`, `payment_intent.payment_failed`

### Mail Configuration

Configure your email settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```

## 🧪 Testing the Installation

### 1. Start the Development Server

```bash
php artisan serve
```

### 2. Visit the Application

Open your browser and navigate to `http://localhost:8000`

### 3. Create Admin User

```bash
php artisan tinker
```

```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'admin@serendibjourneys.com';
$user->password = Hash::make('password');
$user->save();

$role = App\Models\Role::where('slug', 'admin')->first();
$user->roles()->attach($role->id);
```

## 🚨 Troubleshooting

### Common Issues

#### 1. Composer Memory Limit

If you encounter memory issues:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

#### 2. Permission Denied

```bash
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

#### 3. Database Connection Error

- Verify database credentials in `.env`
- Ensure MySQL service is running
- Check database exists and is accessible

#### 4. Node.js Dependencies

If npm install fails:

```bash
rm -rf node_modules package-lock.json
npm install
```

## 📦 Production Deployment

For production deployment, see the [Deployment Guide](./deployment.md).

## 🔐 Security Checklist

- [ ] Change default admin password
- [ ] Configure HTTPS
- [ ] Set up proper file permissions
- [ ] Configure firewall rules
- [ ] Enable database backups
- [ ] Set up monitoring and logging

## 📞 Support

If you encounter issues during installation:

1. Check the [Troubleshooting Guide](./troubleshooting.md)
2. Review Laravel logs in `storage/logs/laravel.log`
3. Verify all prerequisites are met
4. Contact the development team

---

**Next Steps**: After installation, proceed to [Environment Configuration](./environment.md) for detailed configuration options. 