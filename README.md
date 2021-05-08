
# Culturiste API

Api and back-office of the Culturiste project about frech regions.

## Wiki

[Wiki](https://github.com/Culturistes/api/wiki)

  
## Installation 

Require PHP 7.4

### Configure .env

Configure database URL in your .env.local file

### install dependencies and database

```bash 
  composer install
  php bin/console doctrine:migration:migrate
```
    
## Prod

[https://api.culturiste.remiruc.fr/](https://api.culturiste.remiruc.fr/)

### Deployment

To deploy this project in prod

1. pull the project
```bash
  git pull
```
2. Also : If new dependencies installed
```bash
  composer install
```

3. Also : If database modified
```bash
  php bin/console doctrine:migration:migrate
```

  
