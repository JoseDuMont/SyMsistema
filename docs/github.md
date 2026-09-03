# 🐙 SyM Sistema — GitHub

## 1. Propósito

Este documento registra el proceso utilizado para integrar
SDI (SyM Sistema) con Git y GitHub.

El objetivo es mantener un historial controlado de cambios,
facilitar la trazabilidad del desarrollo y establecer una base
para futuras colaboraciones y despliegues.

GitHub funciona como repositorio del código fuente y de la
documentación técnica de SDI.

---

## 2. Repositorio

| Propiedad | Valor |
|---|---|
| Proyecto | SDI — SyM Sistema |
| Repositorio | JoseDuMont/SyMsistema |
| Rama principal | `main` |
| Autenticación | SSH |
| Remote | `git@github.com:JoseDuMont/SyMsistema.git` |
| Visibilidad actual | Private |

---

## 3. Inicialización del repositorio

El repositorio Git se inicializó directamente sobre el proyecto
SDI.

bash
git init

Posteriormente se verificó el estado del proyecto:

git status

##4. Control de archivos mediante .gitignore

Antes de realizar el primer commit se establecieron reglas para
evitar que información sensible, datos de clientes o dependencias
generadas fueran incorporadas al repositorio.

Entre las principales exclusiones se encuentran:

/vendor/
/public/site/

.env
.env.*
!.env.example

*.log
/logs/

*.tmp
*.temp
*.swp
*~

*.bak
*.backup

.DS_Store
Thumbs.db
.idea/
.vscode/
Archivos excluidos por seguridad
.env

Contiene información sensible relacionada con:

Base de datos.
SMTP.
Credenciales.
Variables de configuración.

Por este motivo nunca debe formar parte del repositorio.

/public/site/

Contiene información y archivos correspondientes a clientes.

Este contenido permanece únicamente en el entorno de ejecución
de SDI y no debe compartirse mediante GitHub.

/vendor/

Contiene las dependencias instaladas por Composer.

No se almacena directamente en Git.

Las dependencias pueden reconstruirse mediante:

composer install

utilizando composer.json y composer.lock.

##5. Archivo .env.example

Para documentar las variables requeridas por el sistema se utiliza:

.env.example

Este archivo contiene únicamente valores de referencia.

No contiene credenciales reales.

Su propósito es permitir que un nuevo entorno conozca las
variables necesarias para ejecutar SDI.

##6. Revisión antes del primer commit

Antes de realizar el commit inicial se revisaron los archivos
preparados para Git:

git status

También se verificaron los archivos ignorados:

git status --short --ignored

Esto permitió confirmar que:

.env estaba excluido.
/vendor/ estaba excluido.
/public/site/ estaba excluido.
Los archivos temporales estaban excluidos.
Los datos de clientes no formaban parte del commit.
##7. Primer commit

Una vez validado el contenido se realizó el primer commit:

git add .

git commit -m "feat: initial SDI system"

Commit inicial:

c24124a feat: initial SDI system

Este commit representa la primera versión controlada del
sistema SDI.

##8. Rama principal

La rama inicial creada por Git fue renombrada a:

main

Comando utilizado:

git branch -M main

La rama main representa actualmente la línea principal de
desarrollo de SDI.

##9. Configuración de autenticación SSH

Para evitar utilizar credenciales directamente en cada operación
con GitHub se configuró autenticación mediante una llave SSH.

La conexión fue validada mediante:

ssh -T git@github.com

Resultado obtenido:

Hi JoseDuMont! You've successfully authenticated,
but GitHub does not provide shell access.

La respuesta confirma que la autenticación SSH con GitHub fue
establecida correctamente.

##10. Configuración del repositorio remoto

El repositorio remoto fue configurado utilizando SSH:

git remote add origin git@github.com:JoseDuMont/SyMsistema.git

La configuración puede verificarse mediante:

git remote -v

Resultado esperado:

origin  git@github.com:JoseDuMont/SyMsistema.git (fetch)
origin  git@github.com:JoseDuMont/SyMsistema.git (push)
##11. Primer Push

El contenido inicial del proyecto fue enviado a GitHub mediante:

git push -u origin main

La operación estableció la relación entre la rama local:

main

y la rama remota:

origin/main

A partir de este momento Git puede utilizar el repositorio remoto
como origen principal del historial del proyecto.

##12. Flujo de trabajo

El flujo básico para futuros cambios será:

1. Revisar cambios
git status
2. Revisar diferencias
git diff
3. Agregar archivos
git add .

o, preferentemente, archivos específicos:

git add archivo.php
4. Crear commit
git commit -m "tipo: descripción del cambio"
5. Enviar cambios
git push
##13. Convención de commits

SDI utilizará mensajes de commit descriptivos.

Ejemplos:

feat: add authentication service
fix: correct folder authorization
docs: update dependency documentation
refactor: improve log service
test: add mail service test

Tipos principales:

Tipo	Uso
feat	Nueva funcionalidad
fix	Corrección de errores
docs	Documentación
refactor	Reestructuración sin cambio funcional
test	Pruebas
chore	Mantenimiento técnico
##14. Reglas de seguridad

Nunca realizar commit de:

Contraseñas.
Tokens.
API keys.
Credenciales SMTP.
Credenciales de base de datos.
Archivos .env.
Información de clientes.
Datos personales.
Backups.
Logs con información sensible.

Antes de cada commit se debe verificar:

git status

y, cuando sea necesario:

git diff --cached
##15. Estado actual

SDI cuenta actualmente con:

Repositorio Git inicializado.
Rama principal main.
Repositorio remoto en GitHub.
Autenticación SSH configurada.
Primer commit realizado.
Primer push completado.
.gitignore configurado.
Archivos sensibles excluidos.
Dependencias Composer administradas mediante composer.json
y composer.lock.
##16. Relación con la documentación de SDI

GitHub forma parte de la estrategia de documentación y
trazabilidad del proyecto.

La documentación técnica se mantiene dentro de:

docs/

Entre los documentos principales se encuentran:

docs/SyM_Atenea.md
docs/SyM_Dependencias.md
docs/github.md
SyM_Atenea

Documento principal de conocimiento humano y arquitectura de SDI.

SyM_Dependencias

Inventario de dependencias, versiones y componentes externos.

github.md

Documento que registra la estrategia y procedimiento de control
de versiones utilizado por el proyecto.

##17. Principio de trazabilidad

Cada cambio significativo de SDI debe poder relacionarse con:

Requerimiento
      ↓
Implementación
      ↓
Commit
      ↓
Historial Git
      ↓
Repositorio GitHub

Esto permite mantener una trazabilidad técnica del desarrollo y
facilita la revisión futura del sistema.

##18. Estado del repositorio

El repositorio GitHub representa una copia controlada del código
fuente y documentación seleccionada de SDI.

No representa una copia completa del entorno de producción.

Los datos operativos, secretos, archivos de clientes y contenido
generado permanecen fuera del repositorio.

Documento: github.md
Proyecto: SDI — SyM Sistema
Control de versiones: Git + GitHub
Rama principal: main
