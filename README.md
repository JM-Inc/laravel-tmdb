# Laravel TMDB
TMDB wrapper for Laravel.

## Installation

```bash
composer require jm-inc/laravel-tmdb
php artisan vendor:publish --provider="JM\TMDB\TMDBServiceProvider"
```

## Setup

Edit your `.env` file and add `TMDB_ACCESS_TOKEN=XXX`

## Example

```php
use JM\TMDB\Facades\TMDB;

$movie = TMDB::getMovie(123);
```