# Deployment Guide

This document provides comprehensive instructions for deploying the Serendib Journeys application to production environments.

## 🚀 Deployment Overview

### Deployment Options

1. **Shared Hosting**: Traditional web hosting
2. **VPS/Dedicated Server**: Full control over server
3. **Cloud Platforms**: AWS, DigitalOcean, Heroku
4. **Container Deployment**: Docker with orchestration

### Recommended Stack

- **Web Server**: Nginx or Apache
- **Application Server**: PHP-FPM
- **Database**: MySQL 8.0+
- **Cache**: Redis (optional)
- **SSL**: Let's Encrypt
- **CDN**: Cloudflare (optional)

## 📋 Pre-Deployment Checklist

### Development Preparation

- [ ] All tests passing
- [ ] Code review completed
- [ ] Environment variables configured
- [ ] Database migrations ready
- [ ] Assets compiled for production
- [ ] SSL certificates obtained
- [ ] Domain DNS configured

### Security Checklist

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Strong database passwords
- [ ] API keys secured
- [ ] File permissions set correctly
- [ ] Firewall configured
- [ ] Regular backups scheduled

## 🖥️ Server Setup

### System Requirements

**Minimum Requirements:**
- **CPU**: 2 cores
- **RAM**: 4GB
- **Storage**: 20GB SSD
- **OS**: Ubuntu 20.04 LTS or CentOS 8

**Recommended Requirements:**
- **CPU**: 4+ cores
- **RAM**: 8GB+
- **Storage**: 50GB+ SSD
- **OS**: Ubuntu 22.04 LTS

### Server Initial Setup

#### 1. Update System

```bash
# Ubuntu/Debian
sudo apt update && sudo apt upgrade -y

# CentOS/RHEL
sudo yum update -y
```

#### 2. Install Required Software

```bash
# Install PHP 8.0+
sudo apt install php8.0 php8.0-fpm php8.0-mysql php8.0-xml php8.0-mbstring php8.0-curl php8.0-zip php8.0-gd php8.0-bcmath

# Install MySQL
sudo apt install mysql-server

# Install Nginx
sudo apt install nginx

# Install Redis (optional)
sudo apt install redis-server

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
sudo apt-get install -y nodejs
```

#### 3. Configure MySQL

```bash
# Secure MySQL installation
sudo mysql_secure_installation

# Create database and user
sudo mysql -u root -p
```

```sql
CREATE DATABASE serendib_journeys CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'serendib_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON serendib_journeys.* TO 'serendib_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Configure PHP

```bash
# Edit PHP configuration
sudo nano /etc/php/8.0/fpm/php.ini
```

**Key PHP Settings:**
```ini
memory_limit = 256M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 300
date.timezone = UTC
```

#### 5. Configure Nginx

```bash
# Create Nginx configuration
sudo nano /etc/nginx/sites-available/serendib-journeys
```

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/serendib-journeys/public;
    index index.php index.html index.htm;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

    # Handle Laravel routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP processing
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Deny access to sensitive files
    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static assets
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/serendib-journeys /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

## 📦 Application Deployment

### 1. Clone Repository

```bash
# Create application directory
sudo mkdir -p /var/www/serendib-journeys
sudo chown $USER:$USER /var/www/serendib-journeys

# Clone repository
git clone https://github.com/your-username/serendib-journeys-web.git /var/www/serendib-journeys
cd /var/www/serendib-journeys
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
npm install

# Build assets for production
npm run build
```

### 3. Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Edit environment file
nano .env
```

**Production Environment Variables:**
```env
APP_NAME="Serendib Journeys"
APP_ENV=production
APP_KEY=base64:your_generated_key_here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serendib_journeys
DB_USERNAME=serendib_user
DB_PASSWORD=strong_password_here

STRIPE_KEY=pk_live_your_live_key
STRIPE_SECRET=sk_live_your_live_secret
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations

```bash
# Run migrations
php artisan migrate --force

# Seed database (optional)
php artisan db:seed --force
```

### 6. Set File Permissions

```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/serendib-journeys

# Set permissions
sudo chmod -R 755 /var/www/serendib-journeys
sudo chmod -R 775 /var/www/serendib-journeys/storage
sudo chmod -R 775 /var/www/serendib-journeys/bootstrap/cache

# Create storage link
php artisan storage:link
```

### 7. Optimize Application

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

## 🔒 SSL Configuration

### Let's Encrypt SSL

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### Manual SSL Configuration

If using a different SSL provider:

```nginx
# Update Nginx configuration for SSL
server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    
    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;
    
    # SSL configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384;
    ssl_prefer_server_ciphers off;
    
    # Rest of configuration...
}
```

## 🔄 Deployment Automation

### Deployment Script

Create a deployment script for automated deployments:

```bash
#!/bin/bash
# deploy.sh

set -e

# Configuration
APP_DIR="/var/www/serendib-journeys"
BACKUP_DIR="/var/backups/serendib-journeys"
BRANCH="main"

echo "Starting deployment..."

# Backup current version
if [ -d "$APP_DIR" ]; then
    echo "Creating backup..."
    sudo cp -r $APP_DIR $BACKUP_DIR/$(date +%Y%m%d_%H%M%S)
fi

# Pull latest changes
cd $APP_DIR
git fetch origin
git reset --hard origin/$BRANCH

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Run migrations
php artisan migrate --force

# Clear and cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
sudo chown -R www-data:www-data $APP_DIR
sudo chmod -R 755 $APP_DIR
sudo chmod -R 775 $APP_DIR/storage
sudo chmod -R 775 $APP_DIR/bootstrap/cache

# Restart services
sudo systemctl restart php8.0-fpm
sudo systemctl restart nginx

echo "Deployment completed successfully!"
```

### GitHub Actions Workflow

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Deploy to server
      uses: appleboy/ssh-action@v0.1.4
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/serendib-journeys
          git pull origin main
          composer install --no-dev --optimize-autoloader
          npm install
          npm run build
          php artisan migrate --force
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          sudo systemctl restart php8.0-fpm
          sudo systemctl restart nginx
```

## 📊 Monitoring and Maintenance

### Application Monitoring

#### 1. Log Monitoring

```bash
# Monitor Laravel logs
tail -f /var/www/serendib-journeys/storage/logs/laravel.log

# Monitor Nginx logs
tail -f /var/log/nginx/access.log
tail -f /var/log/nginx/error.log

# Monitor PHP-FPM logs
tail -f /var/log/php8.0-fpm.log
```

#### 2. Performance Monitoring

```bash
# Install monitoring tools
sudo apt install htop iotop nethogs

# Monitor system resources
htop
iotop
nethogs
```

#### 3. Database Monitoring

```bash
# Monitor MySQL
sudo mysql -u root -p -e "SHOW PROCESSLIST;"
sudo mysql -u root -p -e "SHOW STATUS LIKE 'Threads_connected';"
```

### Backup Strategy

#### 1. Database Backup

```bash
#!/bin/bash
# backup_db.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/backups/database"
DB_NAME="serendib_journeys"

mkdir -p $BACKUP_DIR

# Create database backup
mysqldump -u serendib_user -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/backup_$DATE.sql

# Compress backup
gzip $BACKUP_DIR/backup_$DATE.sql

# Keep only last 7 days of backups
find $BACKUP_DIR -name "backup_*.sql.gz" -mtime +7 -delete

echo "Database backup completed: backup_$DATE.sql.gz"
```

#### 2. File Backup

```bash
#!/bin/bash
# backup_files.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/backups/files"
APP_DIR="/var/www/serendib-journeys"

mkdir -p $BACKUP_DIR

# Create file backup
tar -czf $BACKUP_DIR/files_$DATE.tar.gz -C $APP_DIR .

# Keep only last 7 days of backups
find $BACKUP_DIR -name "files_*.tar.gz" -mtime +7 -delete

echo "File backup completed: files_$DATE.tar.gz"
```

#### 3. Automated Backup Cron Job

```bash
# Add to crontab
crontab -e

# Daily database backup at 2 AM
0 2 * * * /var/www/serendib-journeys/scripts/backup_db.sh

# Weekly file backup on Sunday at 3 AM
0 3 * * 0 /var/www/serendib-journeys/scripts/backup_files.sh
```

### Maintenance Tasks

#### 1. Regular Maintenance Script

```bash
#!/bin/bash
# maintenance.sh

echo "Starting maintenance tasks..."

# Clear old logs
find /var/www/serendib-journeys/storage/logs -name "*.log" -mtime +30 -delete

# Clear old cache
php artisan cache:clear
php artisan config:clear

# Optimize database
mysql -u serendib_user -p$DB_PASSWORD -e "OPTIMIZE TABLE bookings, tours, users, payments;"

# Update Composer dependencies
composer update --no-dev

# Restart services
sudo systemctl restart php8.0-fpm
sudo systemctl restart nginx

echo "Maintenance completed!"
```

#### 2. Health Check Script

```bash
#!/bin/bash
# health_check.sh

# Check if application is responding
if curl -f http://localhost > /dev/null 2>&1; then
    echo "Application is running"
else
    echo "Application is down!"
    # Send notification
    echo "Application is down!" | mail -s "Serendib Journeys Alert" admin@yourdomain.com
fi

# Check disk space
DISK_USAGE=$(df / | awk 'NR==2 {print $5}' | sed 's/%//')
if [ $DISK_USAGE -gt 80 ]; then
    echo "Disk space is running low: ${DISK_USAGE}%"
fi

# Check memory usage
MEMORY_USAGE=$(free | awk 'NR==2{printf "%.2f", $3*100/$2}')
if (( $(echo "$MEMORY_USAGE > 80" | bc -l) )); then
    echo "Memory usage is high: ${MEMORY_USAGE}%"
fi
```

## 🚨 Troubleshooting

### Common Issues

#### 1. 500 Internal Server Error

```bash
# Check Laravel logs
tail -f /var/www/serendib-journeys/storage/logs/laravel.log

# Check Nginx error logs
tail -f /var/log/nginx/error.log

# Check file permissions
ls -la /var/www/serendib-journeys/storage
ls -la /var/www/serendib-journeys/bootstrap/cache
```

#### 2. Database Connection Issues

```bash
# Test database connection
mysql -u serendib_user -p -e "SELECT 1;"

# Check MySQL status
sudo systemctl status mysql

# Check MySQL logs
tail -f /var/log/mysql/error.log
```

#### 3. Performance Issues

```bash
# Check PHP-FPM status
sudo systemctl status php8.0-fpm

# Check Nginx status
sudo systemctl status nginx

# Monitor resource usage
htop
```

### Emergency Procedures

#### 1. Rollback Deployment

```bash
# Rollback to previous version
cd /var/www/serendib-journeys
git log --oneline -10
git reset --hard <previous_commit_hash>

# Restore from backup
sudo cp -r /var/backups/serendib-journeys/$(ls -t /var/backups/serendib-journeys/ | head -1) /var/www/serendib-journeys

# Restart services
sudo systemctl restart php8.0-fpm
sudo systemctl restart nginx
```

#### 2. Database Recovery

```bash
# Restore database from backup
mysql -u serendib_user -p serendib_journeys < /var/backups/database/backup_YYYYMMDD_HHMMSS.sql
```

## 📈 Performance Optimization

### 1. PHP Optimization

```ini
; /etc/php/8.0/fpm/php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

### 2. Nginx Optimization

```nginx
# /etc/nginx/nginx.conf
worker_processes auto;
worker_connections 1024;
keepalive_timeout 65;
gzip on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
```

### 3. MySQL Optimization

```ini
; /etc/mysql/mysql.conf.d/mysqld.cnf
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
query_cache_size = 64M
max_connections = 200
```

---

This deployment guide provides comprehensive instructions for deploying the Serendib Journeys application to production environments with proper security, monitoring, and maintenance procedures. 