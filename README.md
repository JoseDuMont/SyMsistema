# 🦉 SDI — SyM Sistema

> Sistema Documental Inteligente para gestión, autorización,
> trazabilidad y entrega controlada de archivos.

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![Git](https://img.shields.io/badge/Git-GitHub-F05032?logo=git&logoColor=white)](https://git-scm.com/)

---

## 🚀 Sobre el proyecto

**SDI (SyM Sistema)** es un sistema web desarrollado para
gestionar documentos y archivos dentro de un entorno empresarial,
manteniendo una separación entre código, configuración, datos
operativos y recursos de los clientes.

El proyecto integra conceptos de:

- Desarrollo backend.
- Gestión documental.
- Control de autorización.
- Trazabilidad de operaciones.
- Gestión de archivos.
- Servicios de correo.
- Identificación mediante UUID.
- Arquitectura basada en servicios.
- Contenedores Docker.
- Experimentación frontend y 3D.

SDI se desarrolla mediante iteraciones documentadas y controladas
utilizando Git.

---

## 🎯 Objetivo

El objetivo de SDI es proporcionar una plataforma capaz de:

- Administrar recursos documentales.
- Controlar quién puede acceder a cada recurso.
- Registrar operaciones relevantes.
- Separar la identidad técnica de las entidades de su identificador
  interno de base de datos.
- Mantener los datos de clientes fuera del código fuente.
- Facilitar la automatización de procesos.
- Proporcionar una base para futuras aplicaciones web y móviles.

---

# 🧠 Arquitectura

SDI utiliza una arquitectura modular donde las operaciones
relacionadas con archivos son controladas por el backend.

```text
                         ┌──────────────────┐
                         │      Usuario     │
                         └────────┬─────────┘
                                  │
                                  ▼
                         ┌──────────────────┐
                         │      Nginx       │
                         └────────┬─────────┘
                                  │
                                  ▼
                         ┌──────────────────┐
                         │   PHP / Backend  │
                         └────────┬─────────┘
                                  │
             ┌────────────────────┼────────────────────┐
             │                    │                    │
             ▼                    ▼                    ▼
      ┌─────────────┐      ┌─────────────┐      ┌─────────────┐
      │    ZEUS     │      │  Services   │      │Controllers  │
      │ Authorization│      │             │      │             │
      └─────────────┘      └──────┬──────┘      └─────────────┘
                                  │
                                  ▼
                           ┌─────────────┐
                           │ Repositories│
                           └──────┬──────┘
                                  │
                    ┌─────────────┴─────────────┐
                    │                           │
                    ▼                           ▼
             ┌─────────────┐             ┌─────────────┐
             │    MySQL    │             │   Storage   │
             └─────────────┘             └─────────────┘


```
Una de las decisiones arquitectónicas principales es impedir que
los componentes de automatización o IA accedan directamente al
filesystem.

Las operaciones sobre archivos pasan por el backend y sus
mecanismos de autorización.

SDI mantiene una separación explícita entre:

Código fuente
     │
     ├── Configuración
     │
     ├── Secretos
     │
     ├── Datos de clientes
     │
     └── Dependencias

Los datos sensibles no forman parte del repositorio.

##Exclusiones principales

.env
/vendor/
/public/site/
logs/
backups
archivos temporales

Las variables de entorno se documentan mediante:

.env.example

Los valores reales permanecen únicamente en el entorno de
ejecución.

##🛡️ ZEUS — Autorización

ZEUS representa la capa de autorización de SDI.

Su responsabilidad es controlar el acceso a recursos y operaciones
del sistema.

La autorización se considera una parte independiente de la lógica
funcional, permitiendo mantener una separación entre:

Identidad
    ↓
Autenticación
    ↓
Autorización
    ↓
Recurso
    ↓
Operación

##🆔 UUID

SDI utiliza UUID v7 para la identificación de entidades.

La arquitectura mantiene separado:

ID interno MySQL
        ≠
UUID expuesto por SDI

Esto permite conservar el identificador interno de base de datos
para operaciones técnicas, mientras que el sistema utiliza UUID
como identificador externo.

La generación y administración de UUID se realiza mediante:

ramsey/uuid

##📋 Trazabilidad y Logging

SDI incorpora componentes destinados al registro de eventos.

Entre ellos:

LogRepository
LogService
RequestContext

RequestContext permite mantener información asociada a una
solicitud durante su procesamiento.

Los servicios de logging proporcionan una base para registrar
operaciones relevantes y facilitar posteriormente la auditoría
del sistema.

##✉️ Servicios de correo

SDI incorpora:

PHPMailer

para el envío de correo mediante SMTP.

La configuración SMTP se realiza mediante variables de entorno,
evitando almacenar credenciales directamente en el código fuente.

🛠️ Stack tecnológico
Backend
PHP 8.3
Composer
MySQL 8.0
PHPMailer
PHP dotenv
Ramsey UUID
Frontend
HTML5
CSS3
JavaScript
jQuery
Three.js
A-Frame
Infraestructura
Docker
Docker Compose
Nginx
Traefik
Cloudflare Tunnel
Control de versiones
Git
GitHub
SSH


##🧩 Dependencias

Las dependencias PHP se administran mediante Composer.

composer.json
composer.lock
      │
      ▼
   Composer
      │
      ▼
   /vendor/

La carpeta vendor/ no se almacena en Git.

Para reconstruir las dependencias:

composer install

El inventario completo de dependencias y versiones se encuentra
en:

docs/SyM_Dependencias.md


##🧪 Laboratorio tecnológico

SDI también funciona como laboratorio de experimentación
tecnológica.

Durante su desarrollo se han evaluado tecnologías como:

Three.js.
A-Frame.
Entornos 3D.
Visualización panorámica.
Interfaces interactivas.
Integración de componentes frontend.

Estas pruebas permiten evaluar tecnologías antes de incorporarlas
a funcionalidades definitivas.

##📚 Documentación

La documentación técnica se encuentra dentro de:

docs/
##🦉 SyM_Atenea

Documento principal de conocimiento humano y arquitectura de SDI.

docs/SyM_Atenea.md

Contiene decisiones, conceptos, componentes y evolución
arquitectónica del sistema.

##🧩 SyM_Dependencias

Inventario de dependencias y componentes externos.

docs/SyM_Dependencias.md
🐙 github.md

Documentación del proceso de control de versiones e integración
con GitHub.

docs/github.md
📁 Estructura principal
SyMsistema/
│
├── app/
│   ├── Repositories/
│   ├── Services/
│   ├── controllers/
│   ├── middleware/
│   ├── config/
│   └── views/
│
├── bin/
│   ├── scan_files.php
│   ├── scan_folders.php
│   └── generate_uuid.php
│
├── docs/
│   ├── SyM_Atenea.md
│   ├── SyM_Dependencias.md
│   └── github.md
│
├── public/
│
├── storage/
│
├── composer.json
├── composer.lock
├── .env.example
└── .gitignore


##🧱 Principios de diseño

SDI se desarrolla siguiendo algunos principios fundamentales:

Separación de responsabilidades

Los controladores, servicios y repositorios mantienen
responsabilidades diferenciadas.

Seguridad por diseño

Los secretos y datos de clientes permanecen fuera del repositorio.

Backend como frontera de seguridad

Las operaciones sensibles pasan por el backend.

Trazabilidad

Las operaciones importantes deben poder relacionarse con una
solicitud y posteriormente con registros de auditoría.

Documentación como parte del desarrollo

Las decisiones técnicas importantes se documentan junto con
el código.

Evolución controlada

Las modificaciones importantes se realizan mediante Git y quedan
registradas en el historial del proyecto.


##🚧 Estado del proyecto

SDI se encuentra en desarrollo activo.

El sistema evoluciona mediante iteraciones que incluyen:

Diseño
  ↓
Implementación
  ↓
Pruebas
  ↓
Documentación
  ↓
Commit
  ↓
GitHub

##👨‍💻 Autor
José Miguel Pérez García
Nombre Producto: SyMsistema
Desarrollador de software.

SDI forma parte de mi proceso de desarrollo profesional y funciona
como proyecto práctico para aplicar conocimientos de:

PHP.
MySQL.
JavaScript.
Arquitectura backend.
APIs.
Docker.
Git/GitHub.
Seguridad.
Gestión documental.
Automatización.
📌 Nota

Este repositorio contiene únicamente código, documentación y
recursos seleccionados del proyecto.

Los datos de clientes, credenciales, configuraciones sensibles y
contenido operativo permanecen fuera del repositorio.
