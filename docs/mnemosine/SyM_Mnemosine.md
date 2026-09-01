# SyM_Mnemosine.md

## Sistema SyM --- Mnemosine

### Registro de memoria, continuidad y fuentes del proyecto

**Fecha de actualización:** 2026-08-18\
**Proyecto:** SyM Sistema / SDI\
**Documento:** SyM_Mnemosine.md

------------------------------------------------------------------------

## 1. Propósito

Mnemosine es la capa de **memoria y continuidad documental** del
ecosistema SyM.

Su función es conservar:

-   decisiones importantes;
-   conversaciones de arquitectura;
-   cambios de diseño;
-   criterios técnicos;
-   decisiones de UX/UI;
-   relaciones entre componentes;
-   pendientes;
-   contexto histórico;
-   referencias a conversaciones relevantes.

Mnemosine **no sustituye** a Atenea ni a Ades.

### Separación conceptual

``` text
Atenea
  ↓
Qué es el sistema y cómo debe funcionar

Ades
  ↓
Cómo se implementa y opera técnicamente

Mnemosine
  ↓
Por qué llegamos a estas decisiones
y dónde está el contexto histórico

UX
  ↓
Cómo se presenta e interactúa con el sistema
```

------------------------------------------------------------------------

# 2. Registro de esta conversación

## Conversación: Evolución de SyM / Zeus / UX

**Fecha:** 2026-08-18

### Tema principal

Evolución de la arquitectura de SyM Sistema alrededor de:

-   Zeus;
-   permisos;
-   clientes;
-   carpetas;
-   arquitectura documental;
-   niveles de usuario;
-   UX/UI;
-   documentación;
-   cursos;
-   Moodle;
-   multimedia;
-   sincronización;
-   visión 3D;
-   estructura futura del sistema.

### Referencia de conversación

> **Esta conversación debe conservarse como fuente primaria de contexto
> para las decisiones registradas en esta actualización.**

**Enlace al chat:**

[Continuar conversación en ChatGPT](https://chatgpt.com/)

> **Nota:** si la instalación de ChatGPT proporciona un enlace
> específico de esta conversación, sustituir el enlace anterior por la
> URL permanente de este chat.

------------------------------------------------------------------------

# 3. Decisiones arquitectónicas registradas

## 3.1 Zeus como autoridad

Zeus se consolida como la capa encargada de determinar:

-   quién puede acceder;
-   qué puede consultar;
-   sobre qué carpeta;
-   sobre qué cliente;
-   qué nivel de administración posee;
-   qué elementos de la interfaz deben mostrarse.

La interfaz no debe convertirse en la autoridad.

``` text
Usuario
   ↓
UI
   ↓
Zeus
   ↓
Permisos
   ↓
Recursos autorizados
```

------------------------------------------------------------------------

## 3.2 Identidad de colaborador vs identidad de cliente

Se mantiene una separación clara:

### Colaborador

Identificado mediante:

``` text
collaborator_id
```

Utilizado para permisos internos, especialmente en:

``` text
zeus_permissions
```

### Cliente

Identificado mediante:

``` text
client_id
```

Utilizado para controlar los recursos pertenecientes a una
organización/cliente.

La estructura permite que un colaborador pueda tener permisos sobre
determinados clientes o carpetas sin mezclar las dos identidades.

------------------------------------------------------------------------

# 4. Zeus Client Roots

Se estableció:

``` text
zeus_client_roots
```

como relación entre un cliente y su carpeta raíz.

La relación relevante es:

``` text
client
   │
   └── zeus_client_roots
           │
           └── folder_uuid
                  │
                  └── folders
```

Ejemplo registrado:

``` text
IGSA-2025
   ↓
igsa_2025
   ↓
evento_final_pasado/igsa_2025
```

------------------------------------------------------------------------

# 5. Zeus Permissions

Se confirmó la estructura:

``` text
zeus_permissions
```

con permisos asociados a:

``` text
collaborator_id
folder_id
permission
status
```

La combinación única utilizada actualmente es:

``` text
collaborator_id
folder_id
permission
```

mediante:

``` text
uq_zeus_permission
```

Se probó exitosamente el permiso:

``` text
collaborator_id = 3
permission = view
```

sobre una carpeta determinada.

------------------------------------------------------------------------

# 6. Consulta de acceso a clientes

La consulta validada permite obtener el cliente y su carpeta raíz
mediante Zeus:

``` sql
SELECT
    c.id AS client_id,
    c.code,
    c.name_client,
    c.description,

    zcr.folder_uuid AS root_folder_uuid,

    f.id AS root_folder_id,
    f.name_folder AS root_folder_name,
    f.real_path AS root_real_path,

    zp.permission,
    zp.status AS permission_status

FROM zeus_permissions zp

INNER JOIN folders f
    ON f.id = zp.folder_id

INNER JOIN zeus_client_roots zcr
    ON zcr.folder_uuid = f.uuid

INNER JOIN clients c
    ON c.id = zcr.client_id

WHERE zp.collaborator_id = 2
  AND zp.permission = 'view'
  AND zp.status = 'active'
  AND c.status = 'active'
  AND f.status = 'active'
  AND f.deleted = 0;
```

Esta prueba confirmó que Zeus puede resolver correctamente:

``` text
colaborador
    ↓
permiso
    ↓
carpeta raíz
    ↓
cliente
```

------------------------------------------------------------------------

# 7. Carpeta personal

Se mantiene deliberadamente la carpeta personal de:

``` text
collaborator_id = 1
```

asociada a:

``` text
folder_id = 4138
```

### Regla actual

**No modificar esta relación hasta probar la UI.**

Esto es importante porque la interfaz debe validarse primero con el
modelo actual antes de introducir nuevas abstracciones.

------------------------------------------------------------------------

# 8. Niveles de usuario

Se estableció conceptualmente:

``` text
Nivel 0
   ↓
Administración total / acceso libre controlado

Nivel 1
   ↓
Administración operativa

Nivel 2
   ↓
Operación especializada

Invitado
   ↓
Acceso temporal y limitado
```

El nivel no debe interpretarse únicamente como una propiedad visual.

Debe existir coherencia entre:

``` text
nivel del colaborador
        +
configuración de Zeus
        +
permisos
        +
UI
```

### Principio importante

Cambiar el nivel de un usuario **sin actualizar la configuración de
Zeus** puede producir incoherencia entre la interfaz y la autoridad
real.

------------------------------------------------------------------------

# 9. Perfil Invitado

Se decidió conservar el perfil:

``` text
Invitado
```

pero como un perfil **controlado y temporal**.

Su objetivo es permitir que personas externas puedan consultar:

-   un cliente;
-   una demostración;
-   una presentación;
-   determinados recursos.

No debe convertirse en un acceso genérico al sistema.

------------------------------------------------------------------------

# 10. Arquitectura como sección pública controlada

Se decidió fusionar conceptualmente:

``` text
Documentación
+
Auditoría
```

en:

``` text
Arquitectura
```

La intención es que una persona pueda comprender:

-   qué es SyM;
-   cómo está organizado;
-   qué tecnologías utiliza;
-   cómo se relacionan sus componentes;
-   qué principios de seguridad utiliza.

Esto puede funcionar como una **ventana comercial/técnica** para
posibles clientes.

### Restricción

No toda la documentación debe quedar expuesta.

Los niveles superiores de acceso podrán consultar documentación interna
de:

``` text
Atenea
Ades
Zeus
Mnemosine
otros documentos internos
```

------------------------------------------------------------------------

# 11. Auditoría

Se mantiene la idea de que los logs de auditoría no deben exponerse
indiscriminadamente.

La UI pública debe mostrar, en su caso:

``` text
información técnica resumida
```

mientras que los registros sensibles deben permanecer bajo control
administrativo.

------------------------------------------------------------------------

# 12. Estructura UX actual

La navegación conceptual quedó encaminada hacia:

``` text
Dashboard
│
├── Info general
├── Metadatos
├── Indicadores
├── Enlaces directos
├── Próximos eventos
└── Cursos disponibles
│
├── Mis archivos
│
├── Clientes
│
├── Arquitectura
│
├── Cursos / Moodle
│
├── Administración
│
└── Lab
```

### Lab

Área destinada a:

-   experimentos;
-   prototipos;
-   componentes generados por desarrolladores;
-   nuevas tecnologías;
-   pruebas antes de incorporarlas al núcleo.

------------------------------------------------------------------------

# 13. UX como capa independiente

Se decidió que las decisiones visuales deben comenzar a documentarse
separadamente.

Documento relacionado:

``` text
SDI-UX-001
```

Su responsabilidad incluye:

-   navegación;
-   UI;
-   UX;
-   diseño visual;
-   componentes;
-   interacción;
-   animaciones;
-   drag & drop;
-   diseño responsive;
-   rendimiento visual.

------------------------------------------------------------------------

# 14. Dirección visual

La identidad visual se inspira en:

-   Windows Vista;
-   Windows 11 Acrylic;
-   transparencia;
-   profundidad;
-   paneles;
-   capas;
-   superficies;
-   iluminación;
-   elementos tridimensionales.

La referencia visual utilizada incluye el concepto Acrylic de Windows y
el estilo visual desarrollado previamente para el CV del proyecto.

La intención no es copiar Windows, sino utilizarlo como **referencia
estética**.

------------------------------------------------------------------------

# 15. Visión 3D

Se planteó un sistema visual centralizado basado en un modelo:

``` text
GLB
```

El modelo ya fue probado en HTML.

### Concepto

Durante una carga:

``` text
        [ MODELO 3D ]
             ↓
           centro
```

Posteriormente:

``` text
[ fondo 3D ]
        +
[ objeto GLB ]
        ↓
   esquina / zona UI
```

El objeto puede continuar girando y responder visualmente al fondo.

### Estado

Esto pertenece al:

``` text
roadmap UX/UI
```

y **no debe convertirse todavía en requisito estructural de la versión
.0**.

------------------------------------------------------------------------

# 16. Workspace

Se planteó una interfaz inspirada parcialmente en un sistema operativo:

``` text
┌──────────────────────────────┐
│ pestaña 1 │ pestaña 2 │ +   │
├──────────────────────────────┤
│                              │
│       área de trabajo        │
│                              │
│       drag & drop            │
│                              │
└──────────────────────────────┘
```

Posibles capacidades:

-   pestañas;
-   arrastrar archivos;
-   soltar archivos;
-   vistas múltiples;
-   paneles;
-   previsualización;
-   acciones contextuales.

------------------------------------------------------------------------

# 17. Sincronización

Se mantiene como visión futura una solución tipo:

``` text
OneDrive privado
```

utilizando tecnologías como:

``` text
Syncthing
```

o alternativas equivalentes.

La sincronización debe permanecer separada del núcleo de autoridad de
Zeus.

------------------------------------------------------------------------

# 18. Cursos configurables

Se planteó posteriormente un sistema donde niveles autorizados puedan
crear un curso directamente desde SyM.

Ejemplo:

``` text
evento_actual/
└── cliente1/
    └── curso_in_situ/
        ├── carpeta/
        ├── evidencia_grafica/
        └── ...
```

La estructura debe poder ser configurable.

------------------------------------------------------------------------

# 19. Automatización de evidencias

El flujo futuro contempla:

``` text
curso
   ↓
estructura automática
   ↓
captura de evidencias
   ↓
fotografías / vídeos
   ↓
procesamiento
   ↓
reducción / conversión
   ↓
site estático
   ↓
presentación de evidencias
```

La intención es reducir automáticamente:

-   tamaño de fotografías;
-   tamaño de vídeos;
-   formatos;
-   estructura de publicación.

------------------------------------------------------------------------

# 20. Moodle

Se decidió considerar Moodle como parte del ecosistema.

La intención futura es integrar:

``` text
SyM
   +
Moodle
   +
IA
```

sin convertir Moodle en autoridad sobre los archivos.

Moodle funcionaría principalmente como plataforma educativa, mientras
que Zeus/SyM conservaría la autoridad documental.

------------------------------------------------------------------------

# 21. IA

Se mantiene la filosofía:

``` text
IA
 ↓
solicita acciones
 ↓
backend
 ↓
Zeus / servicios autorizados
 ↓
filesystem
```

La IA no debe recibir acceso directo indiscriminado al filesystem.

------------------------------------------------------------------------

# 22. Versionado del proyecto

Se estableció una distinción conceptual:

``` text
Versión .0
   ↓
construcción / definición de la base

Versiones posteriores
   ↓
estabilización
   ↓
evolución
   ↓
especialización
```

También se contempla que puedan existir versiones diferentes de SyM
para:

-   clientes;
-   demostraciones;
-   captación comercial;
-   laboratorio;
-   desarrollo interno.

------------------------------------------------------------------------

# 23. Principio de diseño

La arquitectura debe permitir elegir diferentes tecnologías dependiendo
de:

-   número de usuarios;
-   cantidad de llamadas;
-   capacidad del servidor;
-   carga multimedia;
-   complejidad de la interfaz;
-   necesidad de procesamiento;
-   propósito de la versión.

No se debe adoptar una tecnología únicamente por tendencia.

------------------------------------------------------------------------

# 24. Decisiones pendientes

Estas decisiones se conservan deliberadamente abiertas:

-   React vs JavaScript tradicional;
-   Tailwind u otro sistema CSS;
-   arquitectura definitiva del Workspace;
-   motor definitivo de procesamiento multimedia;
-   sistema definitivo de sincronización;
-   integración profunda con Moodle;
-   generación automática de cursos;
-   estructura configurable de cursos;
-   publicación automática del site de evidencias;
-   comportamiento avanzado del objeto 3D;
-   estrategia definitiva de versiones comerciales/demo.

------------------------------------------------------------------------

# 25. Regla de Mnemosine

Toda decisión importante debe poder responder:

``` text
¿Qué decidimos?
¿Por qué lo decidimos?
¿Qué problema resolvía?
¿Qué alternativas consideramos?
¿Qué quedó pendiente?
¿En qué conversación se discutió?
```

Mnemosine debe conservar el **contexto**, no solamente el resultado.

------------------------------------------------------------------------

## Estado al 2026-08-18

SyM se encuentra en una etapa especialmente importante:

``` text
                    SYM SISTEMA
                         │
        ┌────────────────┼────────────────┐
        │                │                │
     ATENEA            ADES          MNEMOSINE
        │                │                │
     lógica          infraestructura   memoria
     autoridad       implementación     contexto
        │                │                │
        └────────────────┼────────────────┘
                         │
                      ZEUS
                         │
                    seguridad
                         │
                        UX
                         │
                 experiencia humana
```

La siguiente etapa debe priorizar:

1.  consolidación de UX;
2.  definición de UI;
3.  prueba de permisos reales;
4.  prueba de navegación por niveles;
5.  validación de `collaborator_id = 1` y carpeta `4138`;
6.  definición del Design System;
7.  posteriormente, integración visual avanzada.

------------------------------------------------------------------------

# Registro de continuidad

**Última actualización:** 2026-08-18\
**Fuente:** conversación de desarrollo SyM/SDI\
**Estado:** vigente\
**Documento relacionado:** `SyM_Atenea.md`\
**Documento relacionado:** `SyM_Ades.md`\
**Documento relacionado:** `SDI-UX-001`

> Este documento debe actualizarse cuando una conversación produzca una
> decisión arquitectónica, UX, de seguridad o de producto que afecte al
> ecosistema SyM.
