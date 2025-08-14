## 🚀 Project Setup

### 1️⃣ Clone Repository
```bash
1: git clone https://github.com/HassanAbsar/mini-crm.git
2: cd yourproject

3: composer update 

4: copy & paste .env.example and rename it to .env

5: db connection in .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=

6: email connection in .env 

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_16_digit_google_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Your Name"

7: How to Get a 16-Digit Google App Password

Enable 2-Step Verification on your Google Account.
Go to Google Account Security Settings
Turn on 2-Step Verification.
Generate an App Password:
In the Security section, click App Passwords.
Sign in again if prompted.
Under Select App, choose Mail.
Under Select Device, choose your device or Other (Custom).
Click Generate.
Copy the 16-character password and use it as MAIL_PASSWORD in .env

8: Queue Setup 
in .env file
QUEUE_CONNECTION=database 

after that run this php artisan queue:work

9: php artisan migrate

10: php artisan optimize:clear   
