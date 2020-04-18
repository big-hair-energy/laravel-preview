# Laravel Preview

Middleware that requires a secret key to view a Laravel site.

## Installation

```
composer require big-hair-energy/laravel-preview
```

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```
BigHairEnergy\Preview\ServiceProvider::class,
```

You'll also want to inject the preview middleware by adding it your app/Http/Kernal.php file.

```
\BigHairEnergy\Preview\Middleware\RequirePreviewAuth::class,
```

### Database Migrations

The migration will create the databases for preview mode options and users.

```
php artisan migrate
```

If you want to prevent the migrations from running use `ignoreMigrations` in the register method of your app service provider.

```
use BigHairEnergy\Preview\Preview;

Preview::ignoreMigrations();
```

You can export the default migration with:

```
php artisan vendor:publish --tag=preview-migrations
```

Running this install command will add the preview controller, templates, and routes needed to display the preview auth.

```
php artisan preview:install
```

## Configuration

### Enabling

You can enable preview mode at any time by adding it to your environment file

```
PREVIEW_ENABLED=true
```

## Usage

### Preview Mode Status

```
php artisan preview:status

Output: Preview mode is (dis|en)abled.
```

### Preview User

```
php artisan preview:user hurley@example.com

Output: User with email hurley@example.com has secret key e0199a5f-03c5-48bf-94d0-ab521aa123ac and last known IP address is 69.89.31.226
```

### Add Preview User

```
php artisan preview:user hurley@example.com

Output: User with email hurley@example.com was added with the secret key e0199a5f-03c5-48bf-94d0-ab521aa123ac
```

### Remove Preview User

```
php artisan preview:user --delete hurley@example.com

Output: User with email hurley@example.com was removed
```

### List All Users

```
php artisan preview:users

Output:
+--------------------+--------------------------------------+---------------+
| Email              | Secret key                           | Last known IP |
+--------------------+--------------------------------------+---------------+
| hurley@example.com | e0199a5f-03c5-48bf-94d0-ab521aa123ac | 69.89.31.226  |
| freyja@example.com | 91c09a97-56ec-49c3-a3bf-56ce4989d870 | none          |
+--------------------+--------------------------------------+---------------+
```

### Send Email Invitations to All Users

This will generate secret keys and send invitations to all users in the table.

```
php artisan preview:invite

Output: Email invitations to preview example.com with secret keys have been sent to all users
```

### Send Email Invitation to User

This will generate a secret key and send an invitation to a user. If the user does not exist it will get created.

```
php artisan preview:invite hurley@example.com

Output: User with email hurley@example.com has been sent an invite to preview example.com with the secret key e0199a5f-03c5-48bf-94d0-ab521aa123ac
```
