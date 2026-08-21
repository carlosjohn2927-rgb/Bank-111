# Grand Chase Banking

A traditional PHP MVC rebuild based on the recorded Grand Chase public banking and manager portal flows. The application uses **CodeIgniter 3** and **MySQL/MariaDB**.

## Modules
- Public marketing pages and account registration
- Customer sign-in, account dashboard, cards, transfer form, and profile
- Manager portal: client management, KYC, deposits, loans, cards, card applications, and managers

## Local setup
1. Install PHP 7.3–8.1 with `mysqli` enabled, plus MySQL/MariaDB.
2. Create the database: `mysql -u root -p < database/schema.sql`.
3. Configure credentials using `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS`, or update `application/config/database.php`.
4. Set `APP_URL` to the application URL and set a unique `APP_KEY`.
5. Point the web root at this directory, or run `php -S 0.0.0.0:8000 index.php`.

For a first manager account, create a user with `role = 'manager'` and a password generated with PHP `password_hash()`.

> Reference recordings are intentionally ignored by Git.

## Production checklist
- Serve over HTTPS and set `cookie_secure` to `TRUE` in `application/config/config.php`.
- Use a long random `APP_KEY`; do not retain the development fallback.
- Set `ENVIRONMENT` to `production`, use non-root database credentials, and back up the database.
- Keep `database/schema.sql`, recordings, logs, and configuration secrets outside the public web root where possible.
