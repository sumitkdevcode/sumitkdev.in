# Pre-Deployment Verification Script
# Run this before deploying to production

Write-Host "🔍 Running pre-deployment checks..." -ForegroundColor Cyan
Write-Host ""

# Check PHP version
Write-Host "✓ Checking PHP version..." -ForegroundColor Yellow
php -v | Select-String "PHP"

# Check Composer
Write-Host "`n✓ Checking Composer..." -ForegroundColor Yellow
composer --version

# Check Node and NPM
Write-Host "`n✓ Checking Node.js..." -ForegroundColor Yellow
node --version
Write-Host "✓ Checking NPM..." -ForegroundColor Yellow
npm --version

# Check Laravel installation
Write-Host "`n✓ Checking Laravel..." -ForegroundColor Yellow
php artisan --version

# Check database connection
Write-Host "`n✓ Testing database connection..." -ForegroundColor Yellow
try {
    php artisan migrate:status
    Write-Host "Database connection successful!" -ForegroundColor Green
} catch {
    Write-Host "Database connection failed!" -ForegroundColor Red
}

# Check for pending migrations
Write-Host "`n✓ Checking migration status..." -ForegroundColor Yellow
php artisan migrate:status

# Check storage permissions
Write-Host "`n✓ Checking storage directory..." -ForegroundColor Yellow
if (Test-Path "storage") {
    Write-Host "Storage directory exists" -ForegroundColor Green
} else {
    Write-Host "Storage directory missing!" -ForegroundColor Red
}

# Check if storage link exists
Write-Host "`n✓ Checking storage link..." -ForegroundColor Yellow
if (Test-Path "public/storage") {
    Write-Host "Storage link exists" -ForegroundColor Green
} else {
    Write-Host "Storage link missing - run: php artisan storage:link" -ForegroundColor Red
}

# Check .env file
Write-Host "`n✓ Checking .env file..." -ForegroundColor Yellow
if (Test-Path ".env") {
    Write-Host ".env file exists" -ForegroundColor Green
    
    # Check critical .env variables
    $envContent = Get-Content .env -Raw
    
    if ($envContent -match "APP_KEY=base64:") {
        Write-Host "  ✓ APP_KEY is set" -ForegroundColor Green
    } else {
        Write-Host "  ✗ APP_KEY is not set - run: php artisan key:generate" -ForegroundColor Red
    }
    
    if ($envContent -match "DB_DATABASE=") {
        Write-Host "  ✓ Database configured" -ForegroundColor Green
    } else {
        Write-Host "  ✗ Database not configured" -ForegroundColor Red
    }
} else {
    Write-Host ".env file missing!" -ForegroundColor Red
}

# Check composer dependencies
Write-Host "`n✓ Checking Composer dependencies..." -ForegroundColor Yellow
if (Test-Path "vendor") {
    Write-Host "Vendor directory exists" -ForegroundColor Green
} else {
    Write-Host "Vendor directory missing - run: composer install" -ForegroundColor Red
}

# Check node modules
Write-Host "`n✓ Checking Node modules..." -ForegroundColor Yellow
if (Test-Path "node_modules") {
    Write-Host "Node modules installed" -ForegroundColor Green
} else {
    Write-Host "Node modules missing - run: npm install" -ForegroundColor Red
}

# Check if assets are built
Write-Host "`n✓ Checking built assets..." -ForegroundColor Yellow
if (Test-Path "public/build") {
    Write-Host "Assets are built" -ForegroundColor Green
} else {
    Write-Host "Assets not built - run: npm run build" -ForegroundColor Yellow
}

Write-Host "`n" -NoNewline
Write-Host "================================================" -ForegroundColor Cyan
Write-Host "Pre-deployment check complete!" -ForegroundColor Green
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "📋 Next steps:" -ForegroundColor Yellow
Write-Host "1. Review DEPLOYMENT_CHECKLIST.md" -ForegroundColor White
Write-Host "2. Update env.production.template with your production values" -ForegroundColor White
Write-Host "3. Upload files to your production server" -ForegroundColor White
Write-Host "4. Run deploy.sh on your production server" -ForegroundColor White
Write-Host ""
