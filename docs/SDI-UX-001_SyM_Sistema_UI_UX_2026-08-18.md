# SDI-UX-001 --- SyM Sistema UI/UX

**Estado:** Diseño conceptual inicial\
**Fecha:** 2026-08-18\
**Versión objetivo:** SyM Sistema .0

------------------------------------------------------------------------

## 1. Objetivo

Crear una interfaz propia para SyM Sistema que combine:

-   claridad operacional;
-   identidad tecnológica;
-   profundidad visual;
-   navegación tipo workspace;
-   control dinámico mediante Zeus;
-   capacidad futura de interacción 3D.

La interfaz no debe convertirse en un simple conjunto de formularios
PHP.

------------------------------------------------------------------------

## 2. Navegación base

``` text
Dashboard
Mis archivos
Clientes
Cursos
Arquitectura
Lab
Administración
```

El menú será contextual.

La UI debe consultar el estado de autorización y representar únicamente
las zonas disponibles para el usuario.

La seguridad real permanece en backend/Zeus.

------------------------------------------------------------------------

## 3. Dashboard

Contenido inicial:

``` text
Información general
Metadatos
Accesos directos
Indicadores
Próximos eventos
Cursos disponibles
```

El Dashboard debe funcionar como la puerta principal y no como una
pantalla saturada.

------------------------------------------------------------------------

## 4. Mis archivos

Ámbito personal del colaborador.

Referencia:

``` text
collaborator_id
      │
      ▼
carpeta personal
```

La UI podrá evolucionar hacia un workspace con:

-   carpetas;
-   archivos;
-   pestañas;
-   drag & drop;
-   carga;
-   progreso;
-   acciones contextuales.

------------------------------------------------------------------------

## 5. Clientes

Ámbito documental autorizado por Zeus.

``` text
Cliente
  │
  └── raíz autorizada
        │
        └── árbol documental
```

La interfaz no debe asumir que todo colaborador puede ver todos los
clientes.

------------------------------------------------------------------------

## 6. Arquitectura

Se decide unir:

``` text
Documentación + Auditoría
             ↓
        Arquitectura
```

Será una sección con apariencia profesional, apta para:

-   colaboradores;
-   desarrolladores;
-   administradores;
-   demostraciones controladas;
-   posibles clientes.

La información mostrada debe seguir las políticas de Zeus.

------------------------------------------------------------------------

## 7. Cursos

Base UX:

``` text
Cursos
├── disponibles
├── crear curso
└── Moodle
```

Futuro:

``` text
Crear curso in situ
        │
        ▼
plantilla configurable
        │
        ▼
árbol de carpetas
        │
        ▼
evidencia gráfica
```

------------------------------------------------------------------------

## 8. Sistema de plantillas documentales

La estructura de cursos deberá ser configurable.

Ejemplo:

``` text
evento_actual/
└── cliente/
    └── curso_in_situ/
        ├── carpeta/
        └── evidencia_grafica/
```

El objetivo es que una plantilla pueda generar automáticamente la
estructura.

------------------------------------------------------------------------

## 9. Workspace

Concepto:

``` text
┌──────────────────────────────────────────────┐
│ Dashboard │ IGSA-2025 │ Archivos │ Curso │ + │
├──────────────────────────────────────────────┤
│                                              │
│                 contenido                    │
│                                              │
└──────────────────────────────────────────────┘
```

Las pestañas deberán poder:

-   abrir;
-   cerrar;
-   cambiar de posición;
-   eventualmente arrastrarse;
-   conservar estado cuando tenga sentido.

------------------------------------------------------------------------

## 10. Drag & Drop

Objetivo:

``` text
archivo
   │
   ▼
┌───────────────────┐
│   Soltar aquí     │
└───────────────────┘
   │
   ▼
backend
   │
   ▼
autorización Zeus
   │
   ▼
filesystem
```

La UI no debe escribir directamente en filesystem.

------------------------------------------------------------------------

## 11. Design System

Dirección visual:

``` text
SyM Design System
│
├── colores
├── tipografía
├── spacing
├── botones
├── tarjetas
├── formularios
├── tabs
├── modales
├── tablas
├── indicadores
├── estados
└── animaciones
```

Referencia estética:

-   Windows 11 Acrylic;
-   profundidad inspirada en Windows Vista/Aero;
-   identidad visual del CV;
-   fondo oscuro;
-   acentos verdes;
-   superficies translúcidas;
-   sombras;
-   capas;
-   paneles flotantes.

No se copiará la interfaz de Windows.

------------------------------------------------------------------------

## 12. CSS

Dirección inicial:

``` text
Tailwind CSS
```

Tailwind será una herramienta.

El lenguaje visual seguirá siendo propiedad de SyM.

------------------------------------------------------------------------

## 13. JavaScript

Primera etapa:

``` text
JavaScript
├── navegación
├── tabs
├── drag & drop
├── modales
├── formularios
├── estados
├── indicadores
├── upload
└── comunicación con API
```

React queda como opción futura por módulo.

No se introduce un framework si JavaScript y el stack actual resuelven
correctamente el problema.

------------------------------------------------------------------------

## 14. 3D

Recurso disponible:

``` text
modelo 3D .glb
```

Ya probado en HTML.

Concepto:

### Estado de carga

``` text
              objeto 3D
                 ↻
              CENTRO
```

### Estado normal

``` text
┌────────────────────────────────────┐
│                              ↻ 3D  │
│                                    │
│          contenido                 │
│                                    │
│                                    │
└────────────────────────────────────┘
```

El objeto:

1.  aparece centrado;
2.  gira;
3.  termina la carga;
4.  se desplaza hacia una esquina;
5.  continúa girando;
6.  interactúa visualmente con un fondo 3D.

------------------------------------------------------------------------

## 15. Fondo 3D

Futuro:

``` text
WebGL / renderer
       │
       ▼
fondo 3D
       │
       ├── profundidad
       ├── movimiento
       └── iluminación
              │
              ▼
          objeto GLB
```

Debe existir sincronización visual entre fondo y objeto.

------------------------------------------------------------------------

## 16. Rendimiento

El efecto 3D debe ser progresivo.

Prioridad:

``` text
UX
 ↓
rendimiento
 ↓
estética
```

Nunca:

``` text
estética
 ↓
servidor inutilizable
```

Se considerarán posteriormente:

-   lazy loading;
-   compresión;
-   reducción de polígonos;
-   fallback 2D;
-   dispositivos móviles;
-   GPU;
-   accesibilidad;
-   `prefers-reduced-motion`.

------------------------------------------------------------------------

## 17. OneDrive propio / sincronización

Concepto futuro:

``` text
SyM Workspace
      │
      ├── archivos
      ├── tabs
      ├── drag & drop
      ├── sincronización
      └── estado
```

La sincronización será una capa independiente de la UX.

Syncthing sirve como referencia conceptual.

Zeus seguirá siendo la autoridad de permisos.

------------------------------------------------------------------------

## 18. Principio UX

SyM Sistema debe sentirse como:

> **un entorno de trabajo**, no como una colección de páginas.

La experiencia deberá ser:

-   coherente;
-   rápida;
-   visual;
-   segura;
-   modular;
-   escalable.

------------------------------------------------------------------------

## 19. Roadmap visual

### .0

-   Dashboard
-   navegación
-   Mis archivos
-   Clientes
-   Arquitectura
-   Cursos
-   Administración
-   Design System inicial

### .1+

-   Workspace
-   tabs avanzadas
-   drag & drop
-   uploads avanzados
-   cursos configurables
-   procesamiento multimedia
-   Moodle
-   sincronización

### Futuro

-   fondo 3D
-   objeto GLB
-   transición central → esquina
-   interacción entre objeto y fondo
-   experiencias inmersivas

------------------------------------------------------------------------

## 20. Regla final

No construir la espectacularidad antes de construir la estructura.

Primero:

``` text
UX sólida
   ↓
arquitectura estable
   ↓
seguridad Zeus
   ↓
interacción
   ↓
3D
```

El objetivo no es hacer una demo bonita.

El objetivo es que **SyM Sistema sea un producto reconocible por su
experiencia**.
