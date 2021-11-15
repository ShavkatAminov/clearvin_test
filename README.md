# Vehicle

## Installation

### Pre-requisites

- `PHP >=7.4`
- `Composer`
- `npm`
- `PostgreSQL`

### Step 1: Install packages and build

- Install `composer` and `node` packages
    ```shell
    composer install
    npm install
    ```
- Build `Vue` application
    ```shell
    npm run build
    ```

### Step 2: Setup PostgreSQL configuration

- Copy `.env.example` file to `.env`
    ```shell
    cp .env.example.example .env.example
    ```
- Change `db_user`, `db_password` and `db_name` in `.env` file

### Step 3: Execute database migrations

- Create database
    ```shell
    php bin/console doctrine:database:create
    ```
- Create tables
    ```shell
    php bin/console doctrine:migrations:migrate
    ```

### Step 4: Insert initial data
- Insert
    ```shell
    php bin/console doctrine:fixtures:load 
    ```
### Step 5: Run application

- Run following command and open [http://localhost:8000](http://localhost:8000)
    ```shell
    symfony server:start
    ```

