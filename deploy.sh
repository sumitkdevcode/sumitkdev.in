#!/bin/bash
# Deployment Script for Portfolio Application
# Run this script on your production server after initial setup

set -e

echo "🚀 Starting deployment process..."

# Enter maintenance mode
echo "📝 Entering maintenance mode..."
(php artisan down --message 'The app is being quickly updated. Please try again in a minute.') || true

# Update codebase from Git
echo "📦 Pulling latest code from repository..."
git pull origin main

# Install/Update Composer dependencies
echo "📚 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

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

echo ""
echo "✨ Deployment completed successfully!"
echo "🌐 Your application is now live!"
echo ""
