# Foteaux

Foteaux is a safety-first photo sharing service

[![tests](https://github.com/amsoell/foteaux/actions/workflows/tests.yml/badge.svg)](https://github.com/amsoell/foteaux/actions/workflows/tests.yml)
[![static code analysis](https://github.com/amsoell/foteaux/actions/workflows/analysis.yml/badge.svg)](https://github.com/amsoell/foteaux/actions/workflows/analysis.yml)

## Social Networks Bad

[Several](https://www.researchgate.net/publication/344195460_Getting_Fewer_Likes_Than_Others_on_Social_Media_Elicits_Emotional_Distress_Among_Victimized_Adolescents) [studies](https://journals.sagepub.com/doi/abs/10.1177/0956797616645673) show that social media is a growing problem for adolescents, and the focus on getting the maximum number of likes and followers can lead to decreased happiness and quality of life. Foteaux is a service that allows users to share their photos, but cuts out the social aspects that can cause these negative effects.

Beyond that, Foteaux has been an excuse to implement some software skills that are of a particular interest to me:

+ [Laravel Livewire](https://laravel-livewire.com)
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

## API Access

Foteaux data can be accessed through a RESTful API

### Tokens

After logging into the web interface, API tokens can be generated at `/user/api-tokens` URI. After obtaining an API token, it should be included in all request headers as `Authorization: Bearer xyz`

### Documentation

Full API documentation can be generated with `php artisan l5-swagger:generate`. After running this command, documentation will be published to the `/api/v1` URI.