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
3. Crear base de datos para el proyecto
4. composer install
5. Completar los parámetros para la conexión
6. bin/console doctrine:migrations:migrate
7. bin/console assets:install --symlink
8. bin/console server:start
9. Browsear http://127.0.0.1:8000/alquileres/
```

## Cómo correr los tests

```
./vendor/bin/phpunit tests/AppBundle/Service/AlquilerServiceTest.php
```