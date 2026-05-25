---
description: How to deploy the Laravel application to production
---

Follow these steps to deploy the application to a production server (Linux/Ubuntu recommended).

### 1. Server Requirements
Ensure your server has:
- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Nginx or Apache
- MySQL or PostgreSQL

### 2. Deployment Script
You can use this automated script for deployment. Create a `deploy.sh` on your server:

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

# Exit maintenance mode
php artisan up

echo "✅ Application deployed!"
```

### 3. Production .env Checklist
Make sure these values are set in your production `.env` file:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY` (generated via `php artisan key:generate`)
- `APP_URL=https://your-domain.com`
- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=your_db_name`
- `DB_USERNAME=your_db_user`
- `DB_PASSWORD=your_db_password`

### 4. Direct Terminal Commands
If you want to run these manually now to prepare:

// turbo
php artisan storage:link
// turbo
php artisan config:clear
// turbo
php artisan route:clear
// turbo
php artisan view:clear
