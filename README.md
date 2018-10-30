# Alquileres

Code challenge para Magnético

## Tecnología utilizada

```
Symfony 3.4
EasyAdmin 1.17
```

### Prerequisitos

```
PHP > 5.5.9
Composer
MySQL > 5
```

### Instalación

```
1. git clone https://github.com/dajuam/alquileres.git
2. cd alquileres
3. Crear base de datos para el proyecto, en consola:
   mysql -u<user> -p<pwd>
   CREATE DATABASE alquileres;
4. composer install
5. Completar los parámetros para la conexión (database_name, database_user, database_password)
6. bin/console doctrine:migrations:migrate (y)
7. bin/console doctrine:fixtures:load (y)
8. bin/console assets:install --symlink
9. bin/console server:run
10. Browsear http://127.0.0.1:8000/alquileres/
```

## Cómo correr los tests

```
./vendor/bin/simple-phpunit tests/AppBundle/Service/AlquilerServiceTest.php
```