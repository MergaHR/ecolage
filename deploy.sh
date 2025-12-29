#!/bin/bash

# Railway Database Setup Script for Ecolage

echo "🚀 Setting up Ecolage Database on Railway..."

# Check if Railway CLI is installed
if ! command -v railway &> /dev/null; then
    echo "❌ Railway CLI not found. Installing..."
    npm install -g @railway/cli
fi

# Login to Railway (if not already logged in)
echo "📝 Please login to Railway..."
railway login

# Create or select project
echo "📁 Setting up Railway project..."
railway init

# Add PostgreSQL database service
echo "🗄️ Adding PostgreSQL database..."
railway add postgresql

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 30

# Get database connection details
echo "🔗 Getting database connection details..."
DB_URL=$(railway variables get DATABASE_URL)
DB_HOST=$(railway variables get PGHOST)
DB_PORT=$(railway variables get PGPORT)
DB_USERNAME=$(railway variables get PGUSER)
DB_PASSWORD=$(railway variables get PGPASSWORD)
DB_NAME=$(railway variables get PGDATABASE)

# Set environment variables for the application
echo "🔧 Setting environment variables..."
railway variables set DB_HOST="$DB_HOST"
railway variables set DB_USERNAME="$DB_USERNAME"
railway variables set DB_PASSWORD="$DB_PASSWORD"
railway variables set DB_NAME="$DB_NAME"
railway variables set DB_PORT="$DB_PORT"
railway variables set APP_ENV="production"
railway variables set APP_DEBUG="false"

# Import database schema
echo "📊 Importing database schema..."
if [ -n "$DB_URL" ]; then
    # Use DATABASE_URL if available
    psql "$DB_URL" < database.sql
else
    # Use individual variables
    PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d "$DB_NAME" < database.sql
fi

echo "✅ Database setup complete!"
echo "🌐 Your application will be available at: $(railway domains)"
echo "📚 Don't forget to update your application's database configuration!"
