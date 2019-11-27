# Theory Test

## Installation

1. Configure environment variables

```bash
cp .env.example .env
```

2. Generate an application key

```bash
php artisan key:generate
```

3. Generate JWT secret key

```bash
php artisan jwt:secret
```

4. Run migrations

```bash
php artisan migrate
```

5. Parse theory dataset and store in the database

```bash
php artisan dataset:parse
```

6. Run route link

```bash
php artisan storage:link
```
