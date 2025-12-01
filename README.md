# 🏎️ Simracing Team Project

Sistema web para la gestión de un equipo de Simracing, desarrollado como proyecto final para la materia de Programación para Internet.

![Estado del Proyecto](https://img.shields.io/badge/Estado-En_Desarrollo_(85%25)-yellow)
![Laravel](https://img.shields.io/badge/Laravel-v10-FF2D20?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-v8.1-777BB4?logo=php)

## 📋 Descripción

Este proyecto es una aplicación web dinámica construida con el framework **Laravel** y el motor de plantillas **Blade**. Su objetivo es administrar la información vital de un equipo de carreras virtual (Simracing), permitiendo la visualización de pilotos, gestión de setups y calendario de carreras.

## 🚀 Tecnologías Utilizadas

* **Lenguaje:** PHP 8
* **Framework:** Laravel (Arquitectura MVC)
* **Frontend:** Blade Templates, HTML5, CSS3, JavaScript
* **Entorno de Desarrollo:** Visual Studio Code
* **Control de Versiones:** Git / GitHub

## ✅ Estado de los Requisitos

Actualmente, el proyecto cubre un **85%** de los requisitos establecidos:

- [x] Estructura de carpetas y organización MVC.
- [x] Rutas y Controladores en Laravel.
- [x] Vistas dinámicas con Blade.
- [x] Gestión de base de datos (Migraciones/Modelos).
- [ ] Módulo de correos electrónicos (Pendiente).
- [x] Pruebas de rendimiento y validación.

## 🧪 Testing y Calidad (QA)

Se han realizado auditorías de rendimiento, accesibilidad y buenas prácticas utilizando **Google Lighthouse**.

### 📊 Reporte Lighthouse
*El sitio cumple con los estándares de rendimiento web y SEO.*

> <img width="1365" height="657" alt="image" src="https://github.com/user-attachments/assets/ab5bd25c-3949-4ba6-9ed5-c1541150d3ae" />

## 🛠️ Instalación y Configuración

Si deseas correr este proyecto localmente, sigue estos pasos:

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/javpulmez/simracing-team.git](https://github.com/javpulmez/simracing-team.git)
    cd simracing-team
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Configurar entorno:**
    * Duplicar el archivo `.env.example` y renombrarlo a `.env`.
    * Configurar las credenciales de base de datos en el archivo `.env`.

4.  **Generar clave de aplicación:**
    ```bash
    php artisan key:generate
    ```

5.  **Ejecutar migraciones:**
    ```bash
    php artisan migrate
    ```

6.  **Iniciar servidor local:**
    ```bash
    php artisan serve
    ```
    Visita `http://localhost:8000` en tu navegador.

## ✒️ Autor

* **Javier Meza (javpulmez)** - [Perfil de GitHub](https://github.com/javpulmez)

---
*Proyecto desarrollado siguiendo los lineamientos del repositorio [samuelmg/programacion-internet](https://github.com/samuelmg/programacion-internet).*


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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
