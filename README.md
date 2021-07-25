# Seenit

## Installation

- ```composer install && npm i```
- copier ``.env.example`` dans `.env` & configurer la db comme vous le souhaitez (ou le laisser tel quel pour utiliser le docker compose)

### Faire tourner en local

Une fois le .env configuré:

- `php artisan migrate:fresh --seed`
- `php artisan storage:link`
- `php artisan serve`

### Utiliser Docker (avec Laravel Sail mais moins stable)

A la racine du projet et avec le .env exactement égal au .env.example:

- `./vendor/bin/sail up -d`
- `./vendor/bin/sail artisan migrate:fresh --seed`
- `./vendor/bin/sail artisan storage:link`

⚠️ Le storage risque de ne pas marcher sur Sail

Et aller sur `0.0.0.0:80`
