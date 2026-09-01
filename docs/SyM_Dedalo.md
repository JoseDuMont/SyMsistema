# SyM_Dédalo.md

## DÉDALO

## Laboratorio experimental de calidad y rendimiento

Dédalo es el laboratorio experimental de SyM destinado a medir,
comparar y validar el comportamiento de Front-End, Back-End y
bases de datos antes de incorporar nuevas tecnologías o
funcionalidades al sistema principal.

Su principio fundamental es:

> Medir antes de decidir.

Los experimentos realizados en Dédalo no forman parte
automáticamente del núcleo de SyM.

---

# Objetivo

Dédalo permite evaluar:

- rendimiento del Front-End;
- comportamiento de WebGL;
- carga de recursos;
- comportamiento de modelos 3D;
- rendimiento de panoramas 360;
- comportamiento responsive;
- rendimiento en dispositivos reales;
- comportamiento en red local;
- impacto de animaciones;
- comportamiento en segundo plano;
- posteriormente Back-End;
- posteriormente bases de datos.

El laboratorio debe permitir comparar tecnologías bajo
condiciones equivalentes.

---

# Filosofía

Dédalo no busca únicamente obtener un valor alto de FPS.

Debe permitir identificar:

- rendimiento sostenido;
- tiempos de frame;
- picos;
- interrupciones o stutter;
- tiempos de carga;
- comportamiento durante la interacción;
- comportamiento en dispositivos diferentes;
- comportamiento bajo diferentes resoluciones;
- diferencias entre dispositivo, servidor y Front-End.

Una prueba no debe considerarse concluyente basándose
únicamente en una medición.

---

# Principio de medición

El rendimiento observado puede depender de tres capas:

text
┌──────────────────────────┐
│       DISPOSITIVO        │
│ CPU / GPU / RAM / DPR    │
└────────────┬─────────────┘
             │
             ▼
┌──────────────────────────┐
│        FRONT-END         │
│ JS / WebGL / Three / AFX │
└────────────┬─────────────┘
             │
             ▼
┌──────────────────────────┐
│     SERVIDOR / RED       │
│ Nginx / Docker / WiFi    │
└──────────────────────────┘

## Propósito

Dédalo es el espacio experimental de SyM.

Su función es probar, medir y comparar tecnologías antes
de incorporarlas al sistema principal.

Una tecnología no entra al núcleo únicamente porque funcione:
debe demostrar rendimiento, estabilidad y compatibilidad con
la arquitectura de SyM.

---

# Trabajo pendiente de actualizar productos
Producto: Cliente X
Producción: jQuery 3.6.0
Estado: Estable
Prioridad: Baja
Acción: No modificar producción
Objetivo: Evaluar migración a jQuery 4.x
Ventana estimada: 2027
---

# Front Test Protocol

Todo experimento de frontend que implique renderizado,
animación o comportamiento visual debe probarse, cuando
sea posible, en diferentes entornos.
Aqui aparece 

DÉDALO-FE-001

Nombre:
Environment Engine — STANDARD

Framework:
Three.js

Experimento base:
3d_test_three.html

Integración:
fondo.html

Objetivo:
Panorama 360 para SyM

────────────────────────

PC HOST
Viewport:
DPR:
FPS:
Frame time:
Peak:
Carga:

────────────────────────

Viewport reducido
Viewport:
DPR:
FPS:
Frame time:
Carga:

────────────────────────

Android LAN
Viewport:
DPR:
FPS:
Frame time:
Carga:

────────────────────────

Problemas:

Soluciones:

Resultado:

Decisión:

## PC Host

Medición directa en el equipo servidor/desarrollo.

Registrar:

- sistema operativo;
- navegador;
- viewport;
- DPR;
- FPS;
- frame time;
- frame peak;
- tiempo de carga.

## Responsive

Los experimentos deben verificarse visualmente en:

- Desktop: resolución real del host;
- Tablet: viewport aproximado de 780 px;
- Mobile: viewport aproximado de 350 px.

Se deben observar:

- adaptación visual;
- elementos cortados;
- scroll inesperado;
- controles;
- interacción táctil cuando aplique.

## Android / Red local

Cuando sea posible, el experimento debe probarse también
desde un dispositivo Android conectado a la red local.

Registrar:

- dispositivo;
- navegador;
- viewport;
- DPR;
- tipo de conexión;
- FPS;
- frame time;
- frame peak;
- tiempo de carga.

Esta prueba permite evaluar conjuntamente:

Servidor
→ red local
→ dispositivo
→ navegador
→ renderizado.

---

## Principio

Una prueba visual no está completa únicamente porque funcione
en el PC host.

El comportamiento debe observarse tanto en el entorno local
de desarrollo como en dispositivos reales cuando estén
disponibles.

---

## Dimensiones de referencia

| Tipo | Referencia |
|---|---|
| Desktop | resolución real del host |
| Tablet | ~780 px de ancho |
| Mobile | ~350 px de ancho |

DÉDALO-F-001
Comparativa de panorama 360

ENGINE:
A-Frame 1.5.0

ESCENA:
Panorama 360
Giro automático
Sin cubo
Sin partículas
Sin efectos adicionales

--------------------------------

PC HOST

Viewport:
1387 × 924

DPR:
0.666

FPS:
59–60

Frame:
16.22–17.20 ms

Peak:
17.20 ms

Load:
0.34 s

Resultado:
Estable

--------------------------------

PC HOST · VIEWPORT REDUCIDO

Viewport:
778 × 616

DPR:
1

FPS:
59–60

Frame:
16.22–17.20 ms

Peak:
17.20 ms

Load:
0.28 s

Resultado:
Estable

--------------------------------

ANDROID · RED LOCAL

Viewport:
484 × 927

DPR:
1.48

FPS:
89–90

Frame:
~11.20 ms

Peak:
~11.30 ms

Load:
2.83 s

Resultado:
Renderizado estable.
Carga significativamente mayor que en PC.

--------------------------------

OBSERVACIONES

- El PC mantiene una animación estable
  cercana a la frecuencia de 60 Hz.

- Android mantiene una animación estable
  cercana a 90 FPS, posiblemente relacionada
  con una pantalla de alta frecuencia.

- El tiempo de carga en Android requiere
  investigación separada de la fluidez.

- El viewport reducido no mostró una diferencia
  relevante de rendimiento en el PC host.

ESTADO:
A-Frame supera la primera prueba básica.
