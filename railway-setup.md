# Railway Database Setup Guide

## 🚀 Quick Setup for Ecolage on Railway

### Step 1: Install Railway CLI
```bash
npm install -g @railway/cli
```

### Step 2: Login to Railway
```bash
railway login
```

### Step 3: Initialize Project
```bash
cd your-project-folder
railway init
```

### Step 4: Add PostgreSQL Database
```bash
railway add postgresql
```

### Step 5: Set Environment Variables
```bash
# Get database credentials
railway variables get

# Set application environment variables
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set BASE_URL=https://your-app-domain.railway.app
```

### Step 6: Deploy Application
```bash
# Push code to GitHub first, then:
railway up
```

### Step 7: Run Database Migration
Visit: `https://your-app-domain.railway.app/migrate.php`

## 📊 Database Schema

The following tables will be created automatically:

- `administration` - Admin users
- `type_compte` - Account types
- `compte` - User accounts  
- `niveau` - Academic levels
- `mention` - Academic mentions
- `etudiant` - Students
- `modepayement` - Payment methods
- `payement` - Payment records
- `payementetu` - Student payment details
- `verification` - Verification records

## 🔧 Default Credentials

**Admin Login:**
- Email: `admin@ecolage.com`
- Password: `admin123`

## 🛠️ Manual Database Setup

If automatic migration fails, you can manually import:

1. Get database URL: `railway variables get DATABASE_URL`
2. Connect using psql or any PostgreSQL client
3. Import the `database.sql` file

```bash
psql $DATABASE_URL < database.sql
```

## 🐛 Troubleshooting

### Database Connection Issues
- Verify environment variables are set correctly
- Check if PostgreSQL service is running
- Ensure database name matches configuration

### Migration Failures
- Check `database.sql` for syntax errors
- Verify database permissions
- Review Railway logs for detailed errors

### Application Errors
- Check PHP error logs
- Verify all required tables exist
- Ensure proper file permissions

## 📝 Environment Variables Required

```env
DB_HOST=railway-provided-host
DB_USERNAME=railway-provided-username  
DB_PASSWORD=railway-provided-password
DB_NAME=railway-provided-database
APP_ENV=production
APP_DEBUG=false
BASE_URL=https://your-app-domain.railway.app
```

## 🌐 Access Your Application

After successful deployment:
1. Railway will provide a public URL
2. Visit the URL to access your ecolage system
3. Login with default admin credentials
4. Update admin password immediately

## 🔄 Continuous Deployment

Your app will automatically redeploy when you:
- Push changes to the connected GitHub branch
- Modify environment variables in Railway dashboard
- Trigger a manual deployment via Railway CLI

## 📞 Support

If you encounter issues:
1. Check Railway logs: `railway logs`
2. Verify environment variables: `railway variables`
3. Review this documentation
4. Check Railway's official documentation
