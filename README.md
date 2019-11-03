# Theory Test
## Installation
1) Configure environment variables
```bash
cp .env.example .env
```
2) Generate an application key
```bash
php artisan key:generate
```
3) Run migrations
```bash
php artisan migrate
```
4) Parse theory dataset and store in the database
```bash
php artisan dataset:parse
```
4) Run route link
```bash
php artisan route:link
```
