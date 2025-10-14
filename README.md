# Docker (Mysql)
    docker compose up -d
    
# Run Laravel Project

1. **Install Dependencies**
    ```bash
    composer install
    ```

2. **Copy `.env` File**
    ```bash
    cp .env.example .env
    ```

3. **Configure Environment**
    - Edit `.env` with your database credentials

    -   DB_CONNECTION=mysql
    -   DB_HOST=127.0.0.1
    -   DB_PORT=3306
    -   DB_DATABASE=backra
    -   DB_USERNAME=root
    -   DB_PASSWORD=root

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**
    ```bash
    php artisan migrate
    ```

6. **Run Seeders**
    ```bash
    php artisan db:seed
    ```

7. **Start Development Server**
    ```bash
    php artisan serve
    ```
