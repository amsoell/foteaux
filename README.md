# Foteaux

Foteaux is a safety-first photo sharing service

[![tests](https://github.com/amsoell/foteaux/actions/workflows/tests.yml/badge.svg)](https://github.com/amsoell/foteaux/actions/workflows/tests.yml)
[![static code analysis](https://github.com/amsoell/foteaux/actions/workflows/analysis.yml/badge.svg)](https://github.com/amsoell/foteaux/actions/workflows/analysis.yml)

## Social Networks Bad

[Several](https://www.researchgate.net/publication/344195460_Getting_Fewer_Likes_Than_Others_on_Social_Media_Elicits_Emotional_Distress_Among_Victimized_Adolescents) [studies](https://journals.sagepub.com/doi/abs/10.1177/0956797616645673) show that social media is a growing problem for adolescents, and the focus on getting the maximum number of likes and followers can lead to decreased happiness and quality of life. Foteaux is a service that allows users to share their photos, but cuts out the social aspects that can cause these negative effects.

Beyond that, Foteaux has been an excuse to implement some software skills that are of a particular interest to me:

+ [Laravel Livewire](https://laravel-livewire.com)
+ [Laravel Sail](https://laravel.com/docs/sail)
+ [Laravel Jetstream](https://jetstream.laravel.com)
+ [PHPUnit tests](https://phpunit.de)
+ [OpenAPI documentation](https://swagger.io/resources/open-api/)
+ [Tailwind CSS](https://tailwindcss.com)

## Setup

```
composer install
yarn install
yarn dev
php artisan migrate
```

## Docker Development

Foteaux can be run in a Docker environment as well.

```
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

On initial setup, you will need to do a couple of things:
1. Add the `minio` hostname do your local dns pointing to localhost
2. create the appropriate bucket in minio. Navigate to http://minio:8900/buckets and create a new bucket called `foteaux`

After this, the development environment should be accessible at http://0.0.0.0
