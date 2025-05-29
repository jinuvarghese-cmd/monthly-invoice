# Laravel monthly mail

Laravel based project sending invoices to large number of customers every month

## Tech Stack

- Laravel
- MySQL

---

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/jinuvarghese-cmd/monthly-invoice.git
   
   cd monthly-invoice
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   

4. **Update `.env` with your DB details**
   ```env
   DB_DATABASE=invoice
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

   > **Note:** To enable email features (like order confirmation or password reset), configure your `.env` with [Mailtrap](https://mailtrap.io/) or any SMTP service:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"
 ```

5. **Clear Cache**
   ```bash
   php artisan optimize
   ```

6. **Run migrations**
   ```bash
   php artisan migrate db:seed
   ```
   
7. **Run queue worker (for invoice generation & email jobs)**
   ```bash
   php artisan queue:work --memory=512 --queue=invoices --tries=3
   php artisan queue:work --memory=512 --queue=emails --tries=3
   ```

   > Generated invoices will be stored in `storage/app/public/invoices/`.

8. **Run scheduler (for running monthly email command)**
   ```bash
   php artisan schedule:work
   ```


9. **Serve the application**
   ```bash
   php artisan serve
   ```

10 Test the command (optional - if you need to test functonality right now)
    ```bash
    php artisan invoices:send          
    ```
