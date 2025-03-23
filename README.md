
Proyecto Laravel - Sistema de Tarifas y Carrito de Compras

Este proyecto es una aplicación basada en Laravel 11 que permite gestionar productos, calcular tarifas de envío y mantener un historial de consultas. Utiliza Docker con Laravel Sail para su ejecución.

📌 Requisitos

Windows 11

WSL 2 (subsistema de Windows para Linux) - Recomendado Ubuntu

Docker Desktop instalado y corriendo con WSL 2

Git instalado

Composer instalado en WSL

🚀 Instalación y Configuración

1️⃣ Clonar el Repositorio

# Abrir una terminal en WSL y ejecutar:
git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio

2️⃣ Configurar Variables de Entorno

.env.example .env

#agregar autenticación para el JWT
AMPLIFICA_USERNAME=emailValido@gmail.com
AMPLIFICA_PASSWORD=12345

3️⃣ Levantar el Contenedor con Docker y Sail

./vendor/bin/sail up -d

Esto iniciará los servicios de Laravel en segundo plano.

4️⃣ Instalar Dependencias

./vendor/bin/sail composer install

5️⃣ Generar la Clave de la Aplicación (si no se genero automaticamente con sail)

./vendor/bin/sail artisan key:generate

6️⃣ Ejecutar Migraciones y Seeders

./vendor/bin/sail artisan migrate --seed

o por separado

./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

Esto creará la base de datos y generará datos de prueba.

7️⃣ Ejecutar el Servidor de Desarrollo

./vendor/bin/sail up

Acceder a la aplicación en: http://localhost:8080/destinos

📌 Comandos Útiles

Reiniciar contenedor

./vendor/bin/sail down && ./vendor/bin/sail up -d

Ejecutar Tinker (Consola interactiva de Laravel)

./vendor/bin/sail artisan tinker

Correr Pruebas (phpunit)

./vendor/bin/sail artisan test --filter=ApiTest


📌 Funcionalidades Principales

Autenticación con JWT mediante AmplificaService

Productos generados por los seeds (CRUD con Laravel ORM)

Carrito de Compras

Cálculo de Tarifas consumiendo la API /getRate

Historial de Tarifas para persistencia de consultas con la cantidad de consultas (generar algunas consultas para tener data a mostrar)

Sistema de Roles y Permisos con Laravel Gates (solo ejemplo en rutas)

Pruebas automatizadas para api

Optimización del rendimiento en las consultas guardando la respuesta de la api para evitar multiples consultas innecesarias





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
