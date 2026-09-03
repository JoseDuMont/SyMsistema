# 🧩 SyM_Dependencias

## Inventario de dependencias de SDI

Este documento registra las dependencias utilizadas por SDI,
sus versiones, propósito, origen y función dentro del sistema.

---

## 1. Entorno PHP

| Componente | Versión | Función |
|---|---:|---|
| PHP | 8.3.30 | Runtime principal |
| Composer | 2.10.1 | Gestión de dependencias |

---

## 2. Dependencias PHP directas

| Paquete | Versión | Propósito |
|---|---:|---|
| ramsey/uuid | 4.9.3 | Generación y gestión de UUID |
| vlucas/phpdotenv | 5.7.0 | Gestión de variables de entorno |
| phpmailer/phpmailer | 7.1.1 | Envío de correo mediante SMTP |

---

## 3. Dependencias PHP transitivas

| Paquete | Proporcionado por | Propósito |
|---|---|---|
| ramsey/collection | ramsey/uuid | Manejo de colecciones |
| brick/math | ramsey/uuid | Operaciones matemáticas de precisión arbitraria |

Estas dependencias son instaladas y administradas por Composer
como consecuencia de las dependencias directas.

No deben instalarse manualmente salvo que una necesidad
arquitectónica futura lo requiera.

---

## 4. Componentes frontend

| Componente | Versión | Ubicación | Propósito |
|---|---:|---|---|
| jQuery | 4.0.0 | public/assets/vendor | Funciones frontend |
| Three.js | 0.160.1 | public/assets/vendor | Renderizado y experimentación 3D |
| A-Frame | 1.5.0 | public/assets/vendor | Experimentación con entornos 3D/VR |

---

## 5. Gestión mediante Composer

Las dependencias PHP se definen mediante:

- `composer.json`
- `composer.lock`

La carpeta `vendor/` no forma parte del repositorio Git.

Se encuentra excluida mediante `.gitignore`.

Para reconstruir las dependencias en un entorno nuevo:

```bash
composer install
