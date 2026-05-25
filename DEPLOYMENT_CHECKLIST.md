# 🚀 Deployment Checklist for Portfolio Application

## ✅ Pre-Deployment Tasks Completed

- [x] Storage link created
- [x] Configuration cache cleared
- [x] Route cache cleared
- [x] View cache cleared
- [x] Application optimized

---

## 📋 Production Server Setup Checklist

### 1. Server Requirements
Ensure your production server has:
- [ ] PHP >= 8.0
- [ ] BCMath PHP Extension
- [ ] Ctype PHP Extension
- [ ] Fileinfo PHP Extension
- [ ] JSON PHP Extension
- [ ] Mbstring PHP Extension
- [ ] OpenSSL PHP Extension
- [ ] PDO PHP Extension
- [ ] Tokenizer PHP Extension
- [ ] XML PHP Extension
- [ ] GD or Imagick PHP Extension (for image processing)
- [ ] Nginx or Apache web server
- [ ] MySQL or PostgreSQL database
- [ ] Composer installed
- [ ] Node.js and NPM installed
- [ ] Git installed

---

## 🔧 Production .env Configuration

Create a `.env` file on your production server with these settings:

```env
APP_NAME="Your Portfolio Name"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_production_database
DB_USERNAME=your_production_user
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail Configuration (Update with your SMTP provider)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Important Notes:
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false` (CRITICAL for security)
- [ ] Generate new `APP_KEY` using: `php artisan key:generate`
- [ ] Update `APP_URL` to your actual domain
- [ ] Configure database credentials
- [ ] Configure mail settings for contact form

---

## 📦 Deployment Steps

### Option A: Automated Deployment (Recommended)

1. **SSH into your server**
   ```bash
   ssh user@your-server-ip
   ```

2. **Navigate to your application directory**
   ```bash
   cd /var/www/your-app
   ```

3. **Create deployment script**
   ```bash
   nano deploy.sh
   ```

4. **Paste this script:**
   ```bash
   #!/bin/bash
   set -e

   echo "🚀 Deploying application..."

   # Enter maintenance mode
   (php artisan down --message 'The app is being quickly updated. Please try again in a minute.') || true

   # Update codebase
   git pull origin main

   # Install dependencies
   composer install --no-dev --optimize-autoloader

   # Run database migrations
   php artisan migrate --force

   # Clear and cache config/routes/views
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache

   # Install and build frontend assets
   npm install
   npm run build

   # Create storage link if not exists
   php artisan storage:link || true

   # Set proper permissions
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache

   # Exit maintenance mode
   php artisan up

   echo "✅ Application deployed!"
   ```

5. **Make script executable and run**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

### Option B: Manual Deployment

1. **Upload files to server** (via FTP/SFTP or Git)
   ```bash
   git clone https://github.com/yourusername/portfolio.git
   cd portfolio
   ```

2. **Install Composer dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Set up environment file**
   ```bash
   cp .env.example .env
   nano .env  # Edit with production values
   php artisan key:generate
   ```

4. **Run database migrations**
   ```bash
   php artisan migrate --force
   ```

5. **Create storage link**
   ```bash
   php artisan storage:link
   ```

6. **Install and build frontend assets**
   ```bash
   npm install
   npm run build
   ```

7. **Optimize application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

8. **Set proper permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

---

## 🌐 Web Server Configuration

### Nginx Configuration Example

Create file: `/etc/nginx/sites-available/your-domain`

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/your-app/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Enable the site:**
```bash
sudo ln -s /etc/nginx/sites-available/your-domain /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Apache Configuration Example

Create file: `/etc/apache2/sites-available/your-domain.conf`

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/your-app/public

    <Directory /var/www/your-app/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

**Enable the site:**
```bash
sudo a2ensite your-domain.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

---

## 🔒 SSL Certificate (HTTPS)

Install Let's Encrypt SSL certificate:

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

For Apache:
```bash
sudo apt install certbot python3-certbot-apache
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

---

## 🔐 Security Checklist

- [ ] `APP_DEBUG=false` in production .env
- [ ] `APP_ENV=production` in production .env
- [ ] Strong database password set
- [ ] SSL certificate installed (HTTPS)
- [ ] Proper file permissions (775 for storage, 644 for files)
- [ ] `.env` file not accessible via web
- [ ] Git repository not accessible via web
- [ ] Regular backups configured
- [ ] Firewall configured (UFW or similar)
- [ ] Only necessary ports open (80, 443, 22)

---

## 📊 Post-Deployment Verification

After deployment, verify:

- [ ] Homepage loads correctly
- [ ] Admin panel accessible at `/admin`
- [ ] Login functionality works
- [ ] Blog posts display correctly
- [ ] Portfolio items display correctly
- [ ] Contact form sends emails
- [ ] Image uploads work
- [ ] All CSS/JS assets load
- [ ] No console errors in browser
- [ ] Mobile responsiveness works
- [ ] SEO meta tags present

---

## 🔄 Database Seeding (Optional)

If you need to seed initial data:

```bash
php artisan db:seed --force
```

---

## 📝 Maintenance Commands

### Clear all caches:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Rebuild caches:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Enter/Exit maintenance mode:
```bash
php artisan down --message "Maintenance in progress"
php artisan up
```

---

## 🐛 Troubleshooting

### Issue: 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Verify file permissions
- Check web server error logs
- Ensure `.env` file exists and is configured

### Issue: Images not loading
- Run: `php artisan storage:link`
- Check file permissions on `storage` directory
- Verify `FILESYSTEM_DISK=public` in `.env`

### Issue: CSS/JS not loading
- Run: `npm run build`
- Clear browser cache
- Check `APP_URL` in `.env` matches your domain

### Issue: Database connection error
- Verify database credentials in `.env`
- Ensure database exists
- Check database server is running

---

## 📞 Support

For issues during deployment, check:
- Laravel logs: `storage/logs/laravel.log`
- Web server logs: `/var/log/nginx/error.log` or `/var/log/apache2/error.log`
- PHP-FPM logs: `/var/log/php8.1-fpm.log`

---

## ✨ Your Application is Ready!

All pre-deployment optimizations have been completed. Follow the checklist above to deploy your portfolio to production.

**Last Updated:** December 29, 2025
