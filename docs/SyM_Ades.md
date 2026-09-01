## Infraestructura de transferencia
Estamos desarrollando el Sistema Documental Inteligente (SDI), una plataforma documental privada, modular, escalable y orientada a software libre.

Filosofía del proyecto
Linux es la fuente de verdad.
MySQL funciona como índice documental y repositorio de metadatos.
El Full Scan es completamente idempotente.
La IA nunca modifica directamente el filesystem.
Todas las decisiones importantes se documentan antes de implementarse.
La arquitectura prioriza simplicidad, rendimiento, seguridad y mantenibilidad.
Ningún proceso automático elimina físicamente registros; la preservación de la información es un principio del sistema.
Infraestructura
Ubuntu Desktop
Docker
Traefik
Nginx
PHP 8.3
MySQL
Cloudflare Tunnel
Syncthing (infraestructura entre servidores)
Ollama
n8n

Hardware:

Intel Core i5-3320M
8 GB RAM
### FileBrowser
### Syncthing
Sincronización futura

La idea de un "OneDrive propio" se registra como una línea futura.

Conceptualmente:

SyM Workspace
      │
      ├── UI
      ├── Drag & Drop
      ├── Upload
      ├── Tabs
      └── Estado
             │
             ▼
       backend controlado
             │
             ▼
          filesystem
             │
             ▼
     sincronización futura

Syncthing puede servir como referencia tecnológica, pero no debe
convertirse en autoridad de permisos.
### rsync
### Full Scan

Se mantiene la decisión existente:

bin/
├── scan_folders.php
└── scan_files.php

Ejecución:

php bin/scan_folders.php
php bin/scan_files.php

El Full Scan se considera principalmente una operación inicial o
controlada de indexación.

No se debe convertir prematuramente en un mecanismo permanente de
sincronización. La visión futura es un sistema propio inspirado
conceptualmente en Syncthing. fileciteturn1file7
### Estrategia ante apagones
### Recuperación de transferencias
### Red local / Internet
### Volúmenes
### Persistencia
### Logs técnicos
Logs y auditoría

La infraestructura de auditoría ya dispone de:

RequestContext
      ↓
LogService
      ↓
LogRepository
      ↓
PDO
      ↓
MariaDB

El sistema actual registra eventos de autenticación y dispone de
request_id, session_id, identidad del colaborador y datos técnicos
de la petición. fileciteturn1file9

La futura UI de Auditoría deberá consumir estos datos mediante una capa
controlada.

No se debe exponer directamente la tabla logs al navegador.

5. Seguridad de logs

No registrar:

contraseñas;

password_hash;

tokens;

cookies;

credenciales;

sesiones completas;

POST/REQUEST sin filtrar;

información sensible innecesaria.

La política ya documentada debe mantenerse. fileciteturn1file6

6. UUID

Se mantiene:

id
  = clave interna MySQL

uuid
  = identidad permanente

UuidService utiliza UUID v7.

Los UUID se utilizan en entidades relevantes como:

users
folders
files
logs

Esta separación no debe modificarse por motivos de UX.
fileciteturn1file8
### Monitoreo
### MVC
1. Regla de separación de capas

La nueva UX no modifica la autoridad del backend.

UI
 │
 ▼
Rutas / Controllers
 │
 ▼
Servicios
 │
 ▼
Zeus / autorización
 │
 ▼
Repositorio / PDO
 │
 ▼
MariaDB

La interfaz puede ocultar elementos según permisos, pero la protección
real debe existir en las rutas y operaciones del backend.

2. Clientes y filesystem

La relación documental mantiene:

clients
   │
   ▼
zeus_client_roots
   │
   ▼
folders
   │
   ▼
files

La UI no debe construir rutas físicas arbitrariamente.

El real_path registrado en folders funciona como referencia
documental/indexada.

La operación real sobre filesystem debe continuar pasando por servicios
controlados del sistema.

La carga 3D será responsabilidad del cliente/navegador, no del servidor
PHP.

Objetivo:

Servidor
  └── entrega recursos

Navegador
  ├── render 3D
  ├── animación
  ├── Acrylic
  └── interacción

Se deberán considerar posteriormente:

tamaño del GLB;

compresión;

lazy loading;

fallback;

GPU;

dispositivos móviles;

accesibilidad;

consumo de memoria.
