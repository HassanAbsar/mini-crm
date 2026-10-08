# Mini CRM System

A lightweight but feature-rich Customer Relationship Management (CRM) system built with Laravel. Perfect for small businesses and startups to manage customers, leads, sales pipelines, and interactions.

---

## Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Frontend:** Bootstrap 5.3, Select2, DataTables, Toastr, Bootstrap Icons
- **Database:** MySQL 8.0+ / MariaDB 10.4+
- **Email:** SMTP-based email notifications
- **Queue:** Laravel queue system for background jobs
- **Theme:** Modern responsive design

---

## Installation

### 1. Clone Repository
```bash
git clone https://github.com/HassanAbsar/mini-crm.git mini-crm
cd mini-crm
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```env
APP_NAME="Mini CRM"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Email Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_16_digit_google_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Your Company Name"
```

#### Getting Google App Password
1. Enable 2-Step Verification on your Google Account
2. Go to Google Account Security Settings
3. Turn on 2-Step Verification
4. Generate an App Password:
   - In the Security section, click **App Passwords**
   - Sign in again if prompted
   - Under **Select App**, choose **Mail**
   - Under **Select Device**, choose your device or **Other (Custom)**
   - Click **Generate**
5. Copy the 16-character password and use it as `MAIL_PASSWORD` in `.env`

### 5. Queue Configuration
```env
QUEUE_CONNECTION=database
```

### 6. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 7. Run Queue Worker (in separate terminal)
```bash
php artisan queue:work
```

### 8. Clear Cache & Optimize
```bash
php artisan optimize:clear
```

### 9. Start Development Server
```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## Default Login

| Role | URL | Username | Password |
|------|-----|----------|----------|
| Admin | `/login` | `admin` | `admin123` |

> ⚠️ Change passwords immediately after first login!

---

## Module Overview

| Module | Route | Description |
|--------|-------|-------------|
| Dashboard | `/dashboard` | KPIs, pipeline overview, recent activities |
| Leads | `/leads` | Lead capture and management |
| Contacts | `/contacts` | Customer contact database |
| Companies | `/companies` | Company/organization management |
| Deals/Opportunities | `/deals` | Sales pipeline and opportunity tracking |
| Activities | `/activities` | Calls, meetings, tasks, emails |
| Products | `/products` | Product/service catalog |
| Quotes | `/quotes` | Generate quotations |
| Invoices | `/invoices` | Invoice management |
| Tasks | `/tasks` | Task assignment and tracking |
| Pipeline | `/pipeline` | Visual sales pipeline |
| Reports | `/reports` | Sales analytics and reports |
| Users | `/users` | Team member management |
| Settings | `/settings` | System configuration |

---

## Key Features

### Lead Management
- ✅ Lead capture forms
- ✅ Lead scoring
- ✅ Lead assignment
- ✅ Lead status tracking
- ✅ Lead conversion to deals

### Contact Management
- 📇 Contact database
- 📇 Company associations
- 📇 Contact history
- 📇 Communication tracking

### Sales Pipeline
- 🎯 Visual pipeline stages
- 🎯 Opportunity management
- 🎯 Deal amount tracking
- 🎯 Probability forecasting
- 🎯 Win/loss analysis

### Activity Tracking
- 📞 Call logs
- 📅 Meeting scheduler
- ✉️ Email tracking
- ✅ Task management
- 📝 Notes and comments

### Communication
- 📧 Email notifications
- 📧 Automated follow-ups
- 📧 Bulk messaging
- 📧 Email templates

### Reporting
- 📊 Sales reports
- 📊 Pipeline reports
- 📊 Revenue forecasting
- 📊 Team performance
- 📊 PDF/Excel export

---

## Activity Types

- **Call** — Customer phone calls
- **Meeting** — In-person or virtual meetings
- **Email** — Email communications
- **Task** — Assigned tasks
- **Note** — Internal notes

---

## Deal Stages

- Prospect
- Qualification
- Proposal
- Negotiation
- Won
- Lost
- Closed

---

## Queue Jobs

The system uses Laravel Queue for background processing:
- Email notifications
- Automated follow-ups
- Report generation
- Data exports
- Bulk operations

**Run:** `php artisan queue:work`

---

## Requirements

- PHP 8.2+
- MySQL 8.0+ or MariaDB 10.4+
- Composer 2.x
- Node.js 18+ (for assets)
- SMTP server (Gmail recommended)

---

## File Structure

```
app/
├── Http/Controllers/
│   ├── LeadController.php
│   ├── ContactController.php
│   ├── DealController.php
│   ├── ActivityController.php
│   ├── QuoteController.php
│   ├── ReportController.php
│   └── ...
├── Models/
│   ├── Lead.php
│   ├── Contact.php
│   ├── Deal.php
│   ├── Activity.php
│   ├── User.php
│   └── ...
├── Jobs/
│   ├── SendEmailNotification.php
│   └── ...

database/
├── migrations/
└── seeders/

resources/views/
├── layouts/
├── dashboard/
├── leads/
├── contacts/
├── deals/
├── activities/
├── quotes/
├── reports/
└── ...

routes/
└── web.php
```

---

## Configuration

### Email Templates
Navigate to `/settings/email-templates` to:
- Create custom email templates
- Set default reply-to addresses
- Configure email signature

### Lead Settings
- Lead source categories
- Lead status options
- Lead scoring rules
- Auto-assignment rules

### Pipeline Settings
- Custom deal stages
- Probability settings
- Forecast accuracy weights

---

## Usage Workflows

### Create a Lead
1. Click **New Lead** from dashboard
2. Fill in lead information
3. Select source and status
4. Assign to team member
5. Click **Save**

### Convert Lead to Deal
1. Open lead details
2. Click **Convert to Deal**
3. Select deal stage
4. Add deal amount and timeline
5. Confirm conversion

### Track Activity
1. Go to **Activities**
2. Click **New Activity**
3. Select type (Call, Email, Meeting, etc.)
4. Link to contact/company
5. Log details and save

### Generate Report
1. Navigate to **Reports**
2. Select report type
3. Choose date range
4. Apply filters
5. Download PDF or Excel

---

## Security Features

- User authentication & authorization
- Role-based access control
- Password encryption (bcrypt)
- CSRF protection
- SQL injection prevention
- XSS protection
- Activity audit logging

---

## Performance Tips

1. **Run Queue Worker:** Ensures email notifications don't block requests
2. **Clear Cache Regularly:** `php artisan cache:clear`
3. **Optimize Database:** Index frequently searched fields
4. **Use Pagination:** For large data sets
5. **Enable Query Caching:** In production

---

## Troubleshooting

### Emails Not Sending
- Check `.env` MAIL_* configuration
- Verify Google App Password is correct
- Ensure 2-Step Verification is enabled
- Check spam folder
- Run: `php artisan queue:work` in separate terminal

### Database Errors
- Ensure MySQL is running
- Check database credentials in `.env`
- Run: `php artisan migrate:fresh --seed` (⚠️ resets data)

### Permission Issues
- Run: `chmod -R 755 storage/`
- Run: `chmod -R 755 bootstrap/cache/`

### Asset Compilation
- Run: `npm run dev` or `npm run build`
- Clear cache: `php artisan view:clear`

---

## Support & Development

For issues, features, or questions:
- Create an issue on GitHub
- Review Laravel documentation
- Check FAQ in repository

---

## Future Enhancements

- 🔄 CRM mobile app
- 📱 WhatsApp integration
- 🔔 Real-time notifications
- 📈 Advanced analytics
- 🤖 AI-powered lead scoring
- 💬 Live chat support
- 📧 Mailchimp/HubSpot integration

---

*Mini CRM System · Built with Laravel · For Growing Businesses*
