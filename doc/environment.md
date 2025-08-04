# Environment Configuration

This document provides comprehensive information about environment variables and configuration settings for the Serendib Journeys application.

## 📋 Environment File Structure

The application uses a `.env` file for environment-specific configuration. Copy the example file to create your own:

```bash
cp .env.example .env
```

## 🔧 Core Application Settings

### Basic Application Configuration

```env
# Application
APP_NAME="Serendib Journeys"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=UTC
APP_LOCALE=en
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `APP_NAME` | Application name displayed throughout the app | "Serendib Journeys" | Yes |
| `APP_ENV` | Environment (local, production, staging) | local | Yes |
| `APP_KEY` | Laravel encryption key | - | Yes |
| `APP_DEBUG` | Enable debug mode | true | Yes |
| `APP_URL` | Application URL | http://localhost:8000 | Yes |
| `APP_TIMEZONE` | Application timezone | UTC | No |
| `APP_LOCALE` | Default locale | en | No |

## 🗄️ Database Configuration

### MySQL Database Settings

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serendib_journeys
DB_USERNAME=root
DB_PASSWORD=
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `DB_CONNECTION` | Database driver | mysql | Yes |
| `DB_HOST` | Database host | 127.0.0.1 | Yes |
| `DB_PORT` | Database port | 3306 | Yes |
| `DB_DATABASE` | Database name | serendib_journeys | Yes |
| `DB_USERNAME` | Database username | root | Yes |
| `DB_PASSWORD` | Database password | - | Yes |

### Database Connection Options

```env
# Database Options (Optional)
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
DB_PREFIX=
```

## 💳 Payment Configuration (Stripe)

### Stripe API Keys

```env
# Stripe Configuration
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret
```

| Variable | Description | Required |
|----------|-------------|----------|
| `STRIPE_KEY` | Stripe publishable key | Yes |
| `STRIPE_SECRET` | Stripe secret key | Yes |
| `STRIPE_WEBHOOK_SECRET` | Stripe webhook endpoint secret | Yes |

### Stripe Configuration Steps

1. **Create Stripe Account**: Sign up at [stripe.com](https://stripe.com)
2. **Get API Keys**: 
   - Go to Stripe Dashboard → Developers → API Keys
   - Copy Publishable Key and Secret Key
3. **Configure Webhook**:
   - Go to Stripe Dashboard → Developers → Webhooks
   - Add endpoint: `https://yourdomain.com/stripe/webhook`
   - Select events: `payment_intent.succeeded`, `payment_intent.payment_failed`
   - Copy webhook signing secret

## 📧 Mail Configuration

### SMTP Settings

```env
# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@serendibjourneys.com"
MAIL_FROM_NAME="${APP_NAME}"
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `MAIL_MAILER` | Mail driver (smtp, sendmail, mailgun) | smtp | Yes |
| `MAIL_HOST` | SMTP host | smtp.mailtrap.io | Yes |
| `MAIL_PORT` | SMTP port | 2525 | Yes |
| `MAIL_USERNAME` | SMTP username | - | Yes |
| `MAIL_PASSWORD` | SMTP password | - | Yes |
| `MAIL_ENCRYPTION` | Encryption (tls, ssl, null) | tls | Yes |
| `MAIL_FROM_ADDRESS` | From email address | noreply@serendibjourneys.com | Yes |
| `MAIL_FROM_NAME` | From name | APP_NAME | Yes |

### Popular Mail Providers

#### Gmail SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
```

#### Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your_domain.mailgun.org
MAILGUN_SECRET=your_mailgun_secret
```

#### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
```

## 📁 File Storage Configuration

### Local Storage

```env
# File Storage
FILESYSTEM_DISK=local
```

### AWS S3 Storage (Optional)

```env
# AWS S3 Configuration
AWS_ACCESS_KEY_ID=your_aws_access_key
AWS_SECRET_ACCESS_KEY=your_aws_secret_key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_bucket_name
AWS_URL=https://your_bucket.s3.amazonaws.com
AWS_USE_PATH_STYLE_ENDPOINT=false
```

## 🔐 Session and Cache Configuration

### Session Settings

```env
# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=
SESSION_SECURE_COOKIE=false
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `SESSION_DRIVER` | Session driver (file, database, redis) | file | Yes |
| `SESSION_LIFETIME` | Session lifetime in minutes | 120 | Yes |
| `SESSION_DOMAIN` | Session domain | - | No |
| `SESSION_SECURE_COOKIE` | Secure cookies (HTTPS only) | false | Yes |

### Cache Configuration

```env
# Cache Configuration
CACHE_DRIVER=file
CACHE_PREFIX=serendib_
```

## 🚀 Queue Configuration

### Queue Settings

```env
# Queue Configuration
QUEUE_CONNECTION=sync
QUEUE_FAILED_DRIVER=database-uuids
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `QUEUE_CONNECTION` | Queue driver (sync, database, redis) | sync | Yes |
| `QUEUE_FAILED_DRIVER` | Failed job storage | database-uuids | Yes |

### Redis Configuration (Optional)

```env
# Redis Configuration
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## 🔍 Logging Configuration

### Log Settings

```env
# Logging Configuration
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
```

| Variable | Description | Default | Required |
|----------|-------------|---------|----------|
| `LOG_CHANNEL` | Log channel (stack, single, daily) | stack | Yes |
| `LOG_DEPRECATIONS_CHANNEL` | Deprecation log channel | null | No |
| `LOG_LEVEL` | Log level (debug, info, warning, error) | debug | Yes |

## 🌐 Broadcasting Configuration

### Broadcasting Settings

```env
# Broadcasting Configuration
BROADCAST_DRIVER=log
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1
```

## 🔧 Application-Specific Settings

### Custom Application Settings

```env
# Application Settings
SITE_TITLE="Serendib Journeys - Explore Sri Lanka"
SITE_DESCRIPTION="Discover the beauty of Sri Lanka with expert tour guides"
CONTACT_EMAIL=info@serendibjourneys.com
CONTACT_PHONE=+94 11 234 5678
```

## 🛡️ Security Configuration

### Security Settings

```env
# Security Configuration
SESSION_SECURE_COOKIE=false
SESSION_SAME_SITE=lax
SANCTUM_STATEFUL_DOMAINS=localhost:3000
```

## 📊 Monitoring Configuration

### Application Monitoring

```env
# Monitoring Configuration
SENTRY_LARAVEL_DSN=
SENTRY_TRACES_SAMPLE_RATE=1.0
```

## 🔄 Environment-Specific Configurations

### Development Environment

```env
# Development Settings
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
DB_DATABASE=serendib_journeys_dev
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
LOG_LEVEL=debug
```

### Staging Environment

```env
# Staging Settings
APP_ENV=staging
APP_DEBUG=false
APP_URL=https://staging.serendibjourneys.com
DB_DATABASE=serendib_journeys_staging
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
LOG_LEVEL=info
```

### Production Environment

```env
# Production Settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://serendibjourneys.com
DB_DATABASE=serendib_journeys_prod
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true
```

## 🔧 Configuration Validation

### Required Environment Variables

The following variables are required for the application to function:

```env
# Required Variables
APP_NAME=
APP_ENV=
APP_KEY=
APP_URL=
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
```

### Configuration Validation Script

Create a validation script to check required variables:

```bash
#!/bin/bash
# validate_env.sh

required_vars=(
    "APP_NAME"
    "APP_ENV"
    "APP_KEY"
    "APP_URL"
    "DB_CONNECTION"
    "DB_HOST"
    "DB_PORT"
    "DB_DATABASE"
    "DB_USERNAME"
    "DB_PASSWORD"
    "STRIPE_KEY"
    "STRIPE_SECRET"
    "STRIPE_WEBHOOK_SECRET"
    "MAIL_MAILER"
    "MAIL_HOST"
    "MAIL_PORT"
    "MAIL_USERNAME"
    "MAIL_PASSWORD"
    "MAIL_FROM_ADDRESS"
)

for var in "${required_vars[@]}"; do
    if [ -z "${!var}" ]; then
        echo "Error: $var is not set"
        exit 1
    fi
done

echo "All required environment variables are set"
```

## 🚨 Security Best Practices

### Environment Security

1. **Never commit `.env` files** to version control
2. **Use strong passwords** for database and external services
3. **Rotate API keys** regularly
4. **Use environment-specific configurations**
5. **Limit access** to production environment variables

### Production Security Checklist

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] `SESSION_SECURE_COOKIE=true`
- [ ] Strong database passwords
- [ ] HTTPS enabled
- [ ] API keys secured
- [ ] Webhook secrets configured

## 🔧 Configuration Commands

### Generate Application Key

```bash
php artisan key:generate
```

### Clear Configuration Cache

```bash
php artisan config:clear
php artisan config:cache
```

### Validate Configuration

```bash
php artisan config:show
```

## 📝 Environment File Template

Complete `.env` template:

```env
# Application
APP_NAME="Serendib Journeys"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=UTC
APP_LOCALE=en

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serendib_journeys
DB_USERNAME=root
DB_PASSWORD=

# Stripe
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@serendibjourneys.com"
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=debug

# Broadcasting
BROADCAST_DRIVER=log

# File Storage
FILESYSTEM_DISK=local
```

---

This environment configuration guide provides comprehensive coverage of all settings needed to properly configure the Serendib Journeys application for different environments. 