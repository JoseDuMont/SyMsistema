# MNEM-SRC-001 — Arquitectura documental y memoria de SDI

## Fuente

Proveedor: ChatGPT
Tipo: Conversación
Fecha: 2026-08-16

URL:
https://chatgpt.com/c/6a4b5412-ade0-83e8-864c-cd73c7cd4410

## Tema

Arquitectura documental y creación de SisMnemosine.

## Contexto

...

## Decisiones

...

## Alternativas consideradas

...

## Relación con SDI

- SyM_Atenea
- SyM_Ades
- SisPoseidón
- SisZeus
- SisApolo

## Estado

🟢 DECISIÓN ARQUITECTÓNICA


----------------------oranizar----------------------------

# MNEM-SRC-002 — Arquitectura documental y memoria de SDI

## Fuente

Proveedor: ChatGPT
Tipo: Conversación
Fecha: 2026-08-16

URL:
https://chatgpt.com/c/6a49ed5d-08b4-83e8-9086-98f88c02aa41

## Tema

Arquitectura documental y creación de SisMnemosine.

## Contexto

Continuación del Proyecto — Sistema Documental Inteligente (SDI)

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
Estado actual
Sistema base
MVC
Login / Logout
Dashboard
Roles
Middleware
Router centralizado
Indexador

Completado:

✅ scan_folders.php
✅ scan_files.php
✅ Configuración mediante storage.php
✅ Detección de carpetas
✅ Detección de archivos
✅ parent_folder
✅ folder_id
✅ MIME Type

El cálculo de SHA256 permanece pospuesto para el momento en que el SDI modifique archivos (subir, reemplazar o editar), nunca durante el Full Scan.

SDI-005 — UUID (COMPLETADO)

Se integró Composer y la librería ramsey/uuid.

Se creó:

App\Services\UuidService

Funciones:

Generación de UUID v7
Validación de UUID
Verificación de versión

Se integró correctamente en:

✅ scan_folders.php
✅ scan_files.php

Ahora cada carpeta y archivo recibe un UUID v7 únicamente durante el INSERT.

Los UUID nunca vuelven a modificarse.

Los id continúan siendo las claves internas de MySQL.

Los UUID serán utilizados por:

API
IA
Flutter
URLs
Logs
Compartición de recursos
Base de datos

Las tablas folders y files ya incluyen:

uuid
status

La tabla folders además incluye:

deleted
deleted_at
Filosofía del estado

status representa el estado operativo e interoperable del recurso (filesystem, Syncthing, FileBrowser, API, etc.).

Ejemplos previstos:

active
missing
locked
deleted

deleted y deleted_at pertenecen exclusivamente a la lógica interna del SDI para gestionar eliminaciones lógicas realizadas desde el propio sistema.

No se realizan eliminaciones físicas automáticas.

Filesystem UI

Diseño conceptual terminado.

Solo usuarios de nivel 2.

Características:

Vista tipo Windows
Vista Lista
Vista Iconos
Breadcrumb
Navegación por carpetas
Solo lectura
Vista previa:
imágenes
PDF
videos
Office mostrará únicamente icono y nombre.
Descarga segura.
IA

La IA será un asistente documental.

No sustituirá la interfaz gráfica.

Ejemplo:

"Muéstrame el contrato del cliente."

La IA localizará el recurso y abrirá la Filesystem UI correspondiente.

Flutter

Cliente oficial del SDI.

Funciones:

Capturar fotografías
Capturar videos
Adjuntar archivos
Cola local SQLite
Reintentos automáticos
Sincronización mediante API
Subida por chunks para archivos grandes

Flutter no sincronizará discos completos.

Solo contenido nuevo.

SDI-006 (Pendiente)

Antes de avanzar con nuevos módulos, revisar:

Verificar índices UNIQUE sobre folders.uuid.
Verificar índices UNIQUE sobre files.uuid.
Revisar índices de rendimiento (real_path, parent_folder, folder_id).
Documentar el modelo actualizado de la base de datos.
Definir oficialmente el catálogo de estados (status) y su comportamiento.

Recordatorio: No es necesario implementar toda la lógica de missing, locked o deleted ahora. Por el momento basta con dejar la estructura preparada y documentada.

Próximo módulo
SDI-007 — Sistema de Logs

Diseñar un sistema centralizado de auditoría.

Objetivos:

Registrar acciones del indexador.
Registrar actividad de usuarios.
Registrar eventos de la API.
Registrar acciones de Flutter.
Registrar eventos de la IA.
Registrar procesos automáticos.
Permitir auditoría y diagnóstico.

La idea es construir un sistema de logs reutilizable por todos los módulos del SDI.

Objetivo final

Construir una plataforma documental inteligente, completamente documentada, segura, reproducible y publicada como software libre.

## Decisiones

...

## Alternativas consideradas

...

## Relación con SDI

- SyM_Atenea
- SyM_Ades
- SisPoseidón
- SisZeus
- SisApolo

## Estado

🟢 DECISIÓN ARQUITECTÓNICA
