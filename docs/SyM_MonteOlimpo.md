SDI-ARQ-004 — Sistema documental vivo

**Estado:** 🧪 EN IMPLEMENTACIÓN

La documentación técnica de SDI debe mantenerse como un documento
vivo y accesible desde el propio sistema.

La fuente de verdad será:

# 🏛️ SDI — SISMONTEOLIMPO

**Sistema:** SyMsistema_MonteOlimpo
**Documento:** Mapa conceptual del Panteón SDI  
**Estado:** 🔵 VISIÓN / DISEÑO  
**Versión:** 0.1  
**Última actualización:** 2026-08-15

---

# 1. Propósito

SisMonteOlimpo representa la arquitectura conceptual futura de
los sistemas especializados que conformarán SDI.

Cada sistema tendrá una responsabilidad específica y deberá
mantener separación entre:

- información;
- conocimiento;
- desarrollo;
- infraestructura;
- seguridad;
- inteligencia artificial;
- ejecución;
- auditoría.

Esta arquitectura es una visión futura y no representa que todos
los componentes se encuentren actualmente implementados.

---

# 2. Principio fundamental

> Los sistemas pueden proporcionar información, orientación y
> propuestas, pero SDI mantiene el control sobre las operaciones
> que afectan al sistema.

La IA no debe convertirse en la autoridad final del sistema.

---

# 3. MonteOlimpo SDI

```text
                         🏛️ SDI
                           │
          ┌────────────────┼────────────────┐
          │                │                │
          ▼                ▼                ▼
      🦉 SisAtenea     🌊 SisPoseidon    ☀️ SisApolo
       HUMANOS             IA          DESARROLLADORES
          │                │                │
          └────────────────┼────────────────┘
                           │
                           ▼
                      ⚡ SisZeus
                       SEGURIDAD
                           │
                           ▼
                      🔐 CONTROL
                           │
                           ▼
                      ⚙️ SDI CORE
                           │
                           ▼
                       📋 LOGS

                  💀 SisAdes
                 INFRAESTRUCTURA

```

# 4. 🦉 SymAtenea

Sistema de información para humanos

SisAtenea representa la interfaz de conocimiento de SDI para
personas.

Su objetivo es permitir que los usuarios puedan comprender,
consultar y, según su nivel de autorización, modificar la
información del sistema.

La interfaz principal prevista será HTML/PHP.                 

# 6. 🌊 SisPoseidon
Sistema de información para inteligencia artificial

SisPoseidon será el sistema encargado de proporcionar
información y contexto a los agentes de inteligencia artificial.

Su objetivo será evitar que cada agente necesite conocer todo el
sistema.

Podrá proporcionar:

documentación relevante;
contexto arquitectónico;
decisiones técnicas;
conocimiento funcional;
estado autorizado del sistema;
información necesaria para una tarea.


# 7. ⚡ SisZeus
Sistema de leyes y protección

SisZeus representa la autoridad de seguridad del Panteón SDI.

Su responsabilidad principal será proteger al sistema frente a
operaciones no autorizadas.

Entre sus objetivos futuros se encuentra la protección contra:

prompt injection;
instrucciones maliciosas;
manipulación de agentes;
operaciones fuera de las rutas autorizadas;
modificaciones no autorizadas;
ejecución de acciones peligrosas;
abuso de herramientas.

# 11. Relación entre los sistemas

🦉 SisAtenea
     │
     │ información humana
     ▼
   HUMANO
     │
     ▼
☀️ SisApolo
     │
     │ orientación técnica
     ▼
 DESARROLLADOR
     │
     ▼
🌊 SisPoseidon
     │
     │ contexto para IA
     ▼
    🤖 IA
     │
     │ propuesta de acción
     ▼
⚡ SisZeus
     │
     │ autorización
     ▼
 SDI CORE
     │
     ├── filesystem
     ├── database
     ├── network
     └── servicios
     │
     ▼
📋 AUDITORÍA

# FIN
