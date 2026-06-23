#!/bin/bash
# Deployment Script for Portfolio Application
# Run this script on your production server after initial setup

set -e

echo "🚀 Starting deployment process..."

# Enter maintenance mode
echo "📝 Entering maintenance mode..."
(php artisan down --retry=60) || true

# Update codebase from Git
echo "📦 Pulling latest code from repository..."
git pull origin main

# Auto-detect composer path
if command -v composer &> /dev/null; then
    COMPOSER_CMD="composer"
elif [ -f "$HOME/composer.phar" ]; then
    COMPOSER_CMD="php $HOME/composer.phar"
elif [ -f "$HOME/bin/composer" ]; then
    COMPOSER_CMD="$HOME/bin/composer"
elif [ -f "composer.phar" ]; then
    COMPOSER_CMD="php composer.phar"
else
    echo "❌ Composer not found! Please install composer or set the path."
    exit 1
fi

echo "📚 Installing Composer dependencies (using: $COMPOSER_CMD)..."
$COMPOSER_CMD install --no-dev --optimize-autoloader --no-interaction

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Rebuild caches for production
echo "⚡ Building production caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install and build frontend assets
echo "🎨 Building frontend assets..."
npm ci --production=false
npm run build

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Optimize application
echo "⚙️  Optimizing application..."
php artisan optimize

# Set proper permissions
echo "🔒 Setting file permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Exit maintenance mode
echo "✅ Exiting maintenance mode..."
php artisan up

# Warm up the cache so the first visitor doesn't experience a slow load
echo "🔥 Warming up application cache..."
php artisan cache:warmup
curl -s -o /dev/null "https://sumitkdev.in" || true

echo ""
echo "✨ Deployment completed successfully!"
echo "🌐 Your application is now live!"
echo ""
