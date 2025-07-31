## CyberDude Opinions

CyberDude forum for tutorials, opinions, and discussions.

### Features

- User authentication
- Add suggestions and request tutorials
- Upvote and downvote suggestions
- Comment on suggestions
- Discord bot integration
- Admin panel to manage suggestions and users
- Custom deployment script
-

### Technologies

- Laravel
- MySQL
- Livewire
- Tailwind CSS
- Alpine.js
- Discord API

### Installation Guide

#### Prerequisites

- PHP 8.x
- Composer
- Node.js and npm
- MySQL or any other supported database

#### Steps

1. **Clone the repository**:
    ```sh
    git clone https://github.com/yourusername/cyberdude-opinions.git
    cd cyberdude-opinions
    ```

2. **Install PHP dependencies**:
    ```sh
    composer install
    ```

3. **Install Node.js dependencies**:
    ```sh
    npm install
    ```

4. **Set up environment variables**:
    - Copy the `.env.example` file to `.env`:
        ```sh
        cp .env.example .env
        ```
    - Update the `.env` file with your database and other configurations.

5. **Generate application key**:
    ```sh
    php artisan key:generate
    ```

6. **Run database migrations**:
    ```sh
    php artisan migrate
    ```

7. **Build assets**:
    ```sh
    npm run build
    ```

8. **Start the development server**:
    ```sh
    php artisan serve
    ```

### Cron Job

To ensure the `php artisan discord:run` command runs continuously, set up a cron job:

```sh
/usr/bin/php /project-path/artisan discord:run >> /dev/null 2>&1
```

### Deployment

To automate the deployment process, use the custom Artisan command:

```sh
php artisan deploy
```

### Additional scripts

```sh
php artisan sync:production-data #sync production data to local
php artisan discord:run #run discord bot
php artisan deploy #deploy the application
```

This command will guide you through the deployment process interactively, including enabling maintenance mode, pulling
the latest changes, installing dependencies, running migrations, and more.

### License

Copyrighted by @CyberDude Networks. Check [LICENSE](./LICENSE) file.

### Author

- Anbuselvan Annamalai (CyberDude Networks)
