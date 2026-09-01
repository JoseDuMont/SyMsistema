# 🦉 SyM_Atenea
## Documentación humana de SDI

**Sistema:** SyM / SDI  
**Documento:** SyM_Atenea.md  
**Propósito:** Documentación funcional y técnica accesible para humanos  
**Estado:** En desarrollo  
**Versión:** 0.1
z
---

# 1. ¿Qué es SDI?

SDI es un sistema de información diseñado para centralizar,
organizar y proteger información, documentos, procesos y
servicios utilizados por la organización.

El sistema está diseñado bajo una filosofía de:

- seguridad;
- trazabilidad;
- modularidad;
- separación de responsabilidades;
- auditoría;
- evolución progresiva.

SDI se encuentra actualmente en fase de desarrollo y laboratorio.

La arquitectura puede cambiar durante esta etapa.

---

# 2. Filosofía de SDI

SDI busca mantener una separación clara entre:

- usuarios;
- aplicación;
- documentación;
- auditoría;
- inteligencia artificial;
- seguridad;
- infraestructura.

Una decisión importante del proyecto es evitar que una sola
componente tenga control absoluto sobre el sistema.

La aplicación debe validar las acciones realizadas por los
usuarios y registrar las operaciones relevantes.

---

# 3. Usuarios

SDI utiliza diferentes niveles de usuario.

## Nivel 1 — Usuario común

El nivel 1 está destinado a usuarios que utilizan el sistema
sin conocimientos técnicos de programación.

Puede:

- consultar información;
- utilizar las funciones autorizadas;
- proporcionar notas;
- proporcionar retroalimentación;
- reportar problemas;
- proponer mejoras.

No debe tener acceso a funciones administrativas o de desarrollo.

---

## Nivel 2 — Desarrollador

El nivel 2 está destinado a usuarios técnicos.

Puede:

- consultar documentación técnica autorizada;
- proponer mejoras;
- modificar documentación autorizada;
- trabajar con nuevas ramas;
- desarrollar nuevas funcionalidades;
- realizar pruebas;
- participar en la evolución del sistema.

Los cambios de desarrollo deberán mantenerse separados mediante
ramas Git antes de incorporarse al código principal.

Los desarrolladores deben respetar las restricciones de seguridad
definidas por SDI.

---

## Nivel 0 — Administrador

El nivel 0 representa la máxima autoridad administrativa dentro
de la aplicación.

Puede:

- consultar la información autorizada;
- modificar documentación;
- revisar mejoras;
- administrar usuarios;
- supervisar operaciones;
- revisar auditoría;
- administrar las funciones administrativas disponibles.

Las operaciones críticas deberán continuar sujetas a las
restricciones de seguridad del sistema.

---

# 4. Autenticación

SDI utiliza autenticación mediante usuario y contraseña.

Las credenciales no deben almacenarse en texto plano.

Las contraseñas se almacenan mediante un hash seguro.

Durante el inicio de sesión se verifica:

1. existencia del usuario;
2. estado activo;
3. contraseña;
4. creación de sesión;
5. regeneración del identificador de sesión.

Imṕortante!!
Importante!!
## Dependencias y componentes externos
Ver dependencias!!
SDI utiliza un conjunto de dependencias orientadas a resolver
funciones específicas del sistema. Las dependencias se dividen
entre componentes directos y dependencias transitivas.

Entrar al contenedor de php

docker exec -it NOMBRE_DEL_CONTENEDOR sh
docker exec -it php sh

sudo docker exec -it php sh
# php -v
PHP 8.3.30 (cli) (built: Feb 24 2026 19:11:35) (NTS)
....

# composer --version
Composer version 2.10.1 2026-06-04 10:25:59
PHP version 8.3.30 (/usr/local/bin/php)...

# composer show ramsey/uuid
Composer could not detect the root package (root/symsistema) version, defaulting to '1.0.0'. See https://getcomposer.org/root-version
name     : ramsey/uuid
descrip. : A PHP library for generating and working with universally unique identifiers (UUIDs).
keywords : guid, identifier, uuid...

# composer show brick/math
Composer could not detect the root package (root/symsistema) version, defaulting to '1.0.0'. See https://getcomposer.org/root-version
name     : brick/math

# composer show ramsey/collection
Composer could not detect the root package (root/symsistema) version, defaulting to '1.0.0'. See https://getcomposer.org/root-version
name     : ramsey/collection...

# composer show --direct
Composer could not detect the root package (root/symsistema) version, defaulting to '1.0.0'. See https://getcomposer.org/root-version
phpmailer/phpmailer 7.1.1 PHPMailer is a full-featured email creation and transfer class for PHP
ramsey/uuid         4.9.3 A PHP library for generating and working with universally unique identifiers (UUIDs).

# composer show --direct
Composer could not detect the root package (root/symsistema) version, defaulting to '1.0.0'. See https://getcomposer.org/root-version
phpmailer/phpmailer 7.1.1 PHPMailer is a full-featured email creation and transfer class for PHP
ramsey/uuid         4.9.3 A PHP library for generating and working with universally unique identifiers (UUIDs).
vlucas/phpdotenv    5.7.0 Loads environment variables from `.env` to `$_ENV` and `$_SERVER` automagically, and optionally to `getenv...




### Dependencias PHP directas

| Componente | Propósito |
|---|---|
| Ramsey UUID | Identificación única de entidades mediante UUID |
| PHP dotenv | Gestión de configuración y secretos mediante variables de entorno |
| PHPMailer | Servicios de correo electrónico |

### Dependencias transitivas

| Componente | Proporcionado por | Propósito |
|---|---|---|
| Ramsey Collection | Ramsey UUID | Manejo de colecciones |
| Brick Math | Ramsey UUID | Operaciones matemáticas de precisión arbitraria |

---

# 5. Sesiones

SDI utiliza sesiones para mantener el estado de autenticación.

La sesión identifica al usuario autenticado y permite aplicar
las restricciones correspondientes a su nivel.

Actualmente se controla:

- identificador de usuario;
- colaborador;
- nivel;
- dirección IP;
- agente de usuario;
- actividad de sesión.

Existe un tiempo máximo de inactividad configurado para evitar
sesiones abandonadas indefinidamente.

---

# 6. Seguridad de sesión

Durante el inicio de sesión se regenera el identificador de
sesión.

Esto ayuda a reducir riesgos relacionados con fijación de
sesiones.

Al cerrar sesión:

1. se registran los datos necesarios para auditoría;
2. se eliminan las variables de sesión;
3. se elimina la cookie correspondiente cuando aplica;
4. se destruye la sesión;
5. se redirige al usuario al inicio de sesión.

---

# 7. Usuarios, colaboradores y clientes.

La aplicación utiliza una tabla `users` para administrar las
cuentas.

Conceptualmente contiene:

- `id`;
- `uuid_collaborator`;
- `collaborator`;
- `password_hash`;
- `email`;
- `storage_folder`;
- `role`;
- `activo`;
- `created`;
- `last_login`;
- `last_ip`;
- `last_user_agent`;
- `failed_login_attempts`;
- `locked_until`.

El identificador interno del usuario es independiente del
identificador UUID utilizado para el colaborador.

---

¡Sí! Y creo que aquí conviene hacer algo mejor que un simple resumen. Como **`SyM_Atenea.md` es nuestro documento maestro de continuidad**, te preparo un bloque listo para incorporar, conservando la filosofía y nomenclatura que ya establecimos.

Puedes agregarlo como una nueva sección de actualización al final de `SyM_Atenea.md`, o reemplazar la sección anterior de continuidad de SDI-007 si ya existe.

---

# ACTUALIZACIÓN DE CONTINUIDAD — SDI-007.1

## Auditoría técnica y cierre de primera fase

**Fecha de actualización:** 15 de agosto de 2026
**Estado:** 🟢 SDI-007.1 funcional y estable
**Siguiente etapa:** SDI-007.2 — Evolución del sistema de logs

---

## 1. Contexto de continuidad

El desarrollo continúa desde el estado documentado previamente en SDI.

No se debe reiniciar, rediseñar ni sustituir la arquitectura existente simplemente por razones de elegancia.

La prioridad actual es:

> **Conservar lo que funciona, verificarlo técnicamente y evolucionarlo de forma incremental.**

La primera fase del sistema de auditoría, **SDI-007.1**, ya fue implementada y probada.

Se realizó una revisión específica de:

* `RequestContext`
* `LogService`
* `LogRepository`
* generación de UUID
* `request_id`
* `session_id`
* identificación del colaborador
* información HTTP
* `execution_ms`
* `metadata_json`
* `stack_trace`
* persistencia mediante PDO
* relación entre `users` y `logs`

La conclusión es que **no existe actualmente un problema estructural que obligue a rediseñar estos componentes**.

---

# 2. RequestContext

Archivo:

```text
app/Services/RequestContext.php
```

Implementación actual:

```php
<?php

namespace App\Services;

class RequestContext
{
    private static ?string $requestId = null;

    private static ?int $startedAt = null;

    /**
     * Inicializa el contexto de la petición.
     */
    public static function initialize(): void
    {
        if (self::$requestId !== null) {
            return;
        }

        self::$requestId = UuidService::generate();
        self::$startedAt = hrtime(true);
    }

    /**
     * UUID de la petición actual.
     */
    public static function requestId(): ?string
    {
        return self::$requestId;
    }

    /**
     * Tiempo transcurrido desde que inició la petición.
     */
    public static function executionTime(): float
    {
        if (self::$startedAt === null) {
            return 0;
        }

        return round(
            (hrtime(true) - self::$startedAt) / 1_000_000,
            2
        );
    }
}
```

### Decisiones

`RequestContext` mantiene dos datos globales durante la petición:

```text
requestId
startedAt
```

`initialize()` contiene una protección:

```php
if (self::$requestId !== null) {
    return;
}
```

Esto evita generar múltiples `request_id` dentro de una misma petición.

El `request_id` se genera mediante:

```php
UuidService::generate();
```

por lo que utiliza el sistema de UUID establecido por SDI.

El tiempo se obtiene mediante:

```php
hrtime(true)
```

y se convierte a milisegundos.

### Estado

🟢 **Correcto.**

No modificar por ahora.

La inicialización debe realizarse desde el punto central de entrada de la aplicación y no desde cada controlador.

---

# ACTUALIZACIÓN DE CONTINUIDAD — SDI-007.2

## Separación conceptual: colaboradores y clientes

**Fecha de actualización:** 18 de agosto de 2026
**Estado:** 🟢 SDI-007.2 funcional y estable

Se confirma una separación entre el ámbito personal del colaborador y el
ámbito de clientes.

Colaborador

El ámbito personal utiliza collaborator_id como referencia principal.

collaborator_id
      │
      └── Mis archivos
             │
             └── carpeta personal

Caso de prueba conservado:

collaborator_id = 1
folder_id      = 4138

La carpeta personal de Miguel queda sin modificaciones hasta completar
las pruebas de UI.

Cliente

La tabla clients identifica al cliente:

clients
├── IGSA-2025
└── TEST-001

Datos de prueba confirmados:

1 | IGSA-2025 | IGSA 2025 | active
2 | TEST-001 | Cliente Test | active

clients responde quién es el cliente.

No debe utilizarse como sustituto del sistema de autorización.

2. SisZeus como autoridad de acceso

La autorización de clientes se estructura mediante:

clients
   │
   ▼
zeus_client_roots
   │
   ▼
folders
   │
   ▼
zeus_permissions
   │
   ▼
collaborator_id + permission

Principio:

clients identifica; folders contiene; zeus_client_roots
relaciona; zeus_permissions autoriza.

Esto permite que un mismo cliente pueda tener una raíz documental y que
distintos colaboradores reciban permisos diferentes.

Cliente de prueba

Se confirmó:

Cliente:
IGSA-2025

code:
IGSA-2025

root folder:
4145

folder_uuid:
01a00e00-c0fe-7065-a333-83ffa24ebc20

real_path:
evento_final_pasado/igsa_2025

status:
active

deleted:
0

La consulta de autorización ya devuelve correctamente:

client_id
code
name_client
root_folder_id
root_folder_uuid
name_folder
real_path
collaborator_id
permission
permission_status

3. Regla de niveles

Los niveles establecen el techo de autoridad; Zeus determina el permiso
concreto.

Nivel 0
  └── administración / acceso amplio

Nivel 1
  └── operación controlada

Nivel 2
  └── desarrollo / operación técnica controlada

Invitado
  └── acceso temporal y limitado a un cliente o ámbito autorizado

El nivel no reemplaza los permisos de Zeus.

Ejemplo conceptual:

Nivel
  │
  ▼
techo de autoridad
  │
  ▼
Zeus
  │
  ▼
permiso concreto
  │
  ▼
recurso

Una modificación del nivel de un usuario no debe considerarse suficiente
por sí sola cuando exista una política de Zeus asociada. Las políticas
de autoridad y los registros documentales deberán mantenerse coherentes.

4. Arquitectura / documentación

Se decide agrupar visualmente:

Documentación + Auditoría
          ↓
     Arquitectura

La sección Arquitectura será una zona de consulta del sistema y podrá
servir como presentación técnica para un posible cliente.

La información sensible de seguridad, infraestructura interna o detalles
que faciliten ataques no debe exponerse automáticamente por el simple
hecho de mostrar documentación.

La visibilidad se determinará por nivel y por las reglas de Zeus.

La documentación existente contempla SisAtenea, SisAdes y SisMnemosine;
la estructura histórica de documentación y niveles ya está registrada en
la continuidad anterior. fileciteturn1file1

# 3. LogService

Archivo:

```text
app/Services/LogService.php
```

Responsabilidad:

> Construir el registro de auditoría y delegar su persistencia al repositorio.

Actualmente recibe:

```php
public function info(
    string $module,
    string $event,
    string $message,
    ?int $userId = null,
    ?string $entityType = null,
    ?string $entityUuid = null,
    ?string $entityName = null
)
```

### Cambio de nomenclatura acordado

Se detectó una inconsistencia semántica:

```text
$userId
```

termina almacenándose como:

```text
collaborator_id
```

El modelo de SDI utiliza el concepto de **collaborator**, por lo que se decidió cambiar únicamente el nombre interno del parámetro:

```php
?int $collaboratorId = null
```

y:

```php
'collaborator_id' => $collaboratorId,
```

### Importante

Esto **NO implica cambiar**:

```text
users.id
```

ni:

```text
logs.collaborator_id
```

ni las relaciones existentes.

La correspondencia oficial será:

```text
LogService
    ↓
$collaboratorId
    ↓
logs.collaborator_id
    ↓
users.id
```

El cambio es únicamente de nomenclatura interna para hacer el código coherente con el modelo de datos.

Las llamadas existentes mediante argumentos posicionales continúan funcionando:

```php
$logService->info(
    'auth',
    'login_success',
    'Inicio de sesión exitoso',
    $user['id']
);
```

El cuarto argumento continúa siendo el ID interno de `users`.

---

# 4. Datos generados por LogService

Cada evento genera:

```text
uuid
request_id
session_id
level
module
event
message
collaborator_id
entity_type
entity_uuid
entity_name
ip
method
uri
user_agent
execution_ms
metadata_json
stack_trace
```

### UUID del log

Cada registro obtiene un UUID independiente:

```php
'uuid' => UuidService::generate()
```

Por tanto:

```text
UUID del log ≠ request_id
```

Son identidades diferentes.

### request_id

Identifica la petición completa:

```php
'request_id' => RequestContext::requestId()
```

Esto permitirá agrupar posteriormente diferentes eventos pertenecientes a una misma petición.

### session_id

Se obtiene mediante:

```php
session_id() ?: null
```

Esto permite registrar eventos con o sin sesión.

---

# 5. Identificación del colaborador

La arquitectura mantiene:

```text
users.id
```

como clave primaria interna.

El log utiliza:

```text
logs.collaborator_id
```

como referencia.

Además, el usuario posee:

```text
uuid_collaborator
```

El modelo conceptual es:

```text
users
├── id                  → identidad interna MySQL
├── uuid_collaborator   → identidad UUID permanente
└── collaborator        → identificación del colaborador
```

Mientras que:

```text
logs
└── collaborator_id     → referencia a users.id
```

### Regla

No cambiar `users.id` por `collaborator_id`.

No cambiar `logs.collaborator_id`.

No eliminar `uuid_collaborator`.

La nomenclatura debe mantenerse consistente con el concepto **collaborator**.

---

# 6. Información HTTP

Actualmente LogService obtiene:

```php
'ip' => $_SERVER['REMOTE_ADDR'] ?? 'CLI',

'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',

'uri' => $_SERVER['REQUEST_URI'] ?? 'CLI',

'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'CLI',
```

Esto permite que el mismo servicio funcione tanto para peticiones HTTP como para procesos CLI.

Por ejemplo:

```bash
php bin/scan_files.php
```

podrá generar:

```text
method = CLI
uri = CLI
ip = CLI
user_agent = CLI
```

### Estado

🟢 Correcto.

No modificar actualmente.

---

# 7. execution_ms

Actualmente:

```php
'execution_ms' => RequestContext::executionTime(),
```

representa:

> Tiempo transcurrido desde el inicio de la petición hasta el momento en que se genera el registro.

No debe interpretarse todavía como:

> tiempo exclusivo de ejecución del evento.

Ejemplo:

```text
execution_ms = 18.42
```

significa aproximadamente que han transcurrido 18.42 ms desde el inicio de la petición.

### Estado

🟢 Correcto.

Debe documentarse este significado para evitar interpretaciones incorrectas en futuros dashboards o análisis.

---

# 8. metadata_json

Actualmente:

```php
'metadata_json' => null,
```

### Decisión

Mantenerlo en `null` mientras no exista una necesidad concreta.

No utilizar:

```text
$_POST completo
$_GET completo
$_REQUEST completo
$_SESSION completo
```

como metadata automática.

La metadata deberá ser:

> controlada, explícita y filtrada.

Nunca deberá convertirse en un mecanismo para almacenar información sensible indiscriminadamente.

### Estado

🟢 Correcto.

---

# 9. stack_trace

Actualmente:

```php
'stack_trace' => null,
```

Esto es intencional.

No se implementará todavía captura automática de stack traces.

La gestión avanzada de excepciones queda para una fase posterior.

### Estado

🟢 Correcto.

---

# 10. LogRepository

Archivo:

```text
app/Repositories/LogRepository.php
```

Responsabilidad:

> Persistir los registros de auditoría en MySQL.

El repositorio recibe:

```php
array $log
```

y ejecuta un `INSERT` mediante PDO preparado.

No contiene reglas de negocio.

La arquitectura queda:

```text
Controller
    ↓
LogService
    ↓
LogRepository
    ↓
PDO
    ↓
MySQL
    ↓
logs
```

### Seguridad SQL

Se utilizan:

```php
$pdo->prepare($sql);
```

y:

```php
$stmt->execute([...]);
```

No se concatenan directamente los valores recibidos en el SQL.

### Estado

🟢 Correcto.

---

# 11. Manejo de PDOException

Actualmente existe:

```php
try {

    ...

} catch (PDOException $e) {

    throw $e;

}
```

El `catch` actualmente vuelve a lanzar exactamente la misma excepción.

Por lo tanto, funcionalmente equivale a permitir que la excepción se propague.

### Decisión

No modificar durante el cierre de SDI-007.1.

Marcar como:

🟡 **Mejora de limpieza futura**

Podrá revisarse cuando se diseñe el manejo avanzado de errores y excepciones de SDI-007.2.

No representa actualmente un fallo funcional.

---

# 12. Seguridad de los logs

Los logs **NO deben almacenar**:

```text
contraseñas
password_hash
tokens
cookies
credenciales
sesiones completas
información sensible innecesaria
$_POST completo
$_REQUEST completo
```

`metadata_json` solamente debe utilizarse con información explícitamente controlada.

Esta regla permanece vigente.

---

# 13. Estado confirmado de SDI-007.1

Actualmente están comprobados:

```text
login_failed       ✅
login_success      ✅
logout             ✅
RequestContext     ✅
LogService         ✅
LogRepository      ✅
MySQL logs         ✅
```

### login_failed

Puede registrar el identificador/nombre introducido aunque todavía no exista un usuario autenticado.

### login_success

Relaciona el evento con:

```text
users.id
uuid_collaborator
session_id
request_id
```

### logout

El evento se registra **antes de destruir la sesión**.

Por tanto conserva:

```text
user_id / collaborator_id
uuid_collaborator
collaborator
session_id
request_id
IP
User-Agent
```

Posteriormente:

```php
$_SESSION = [];
session_destroy();
```

y se redirige a:

```text
/login
```

---

# 14. Clasificación de la revisión técnica

| Componente            | Estado | Decisión                      |
| --------------------- | ------ | ----------------------------- |
| RequestContext        | 🟢     | No modificar                  |
| UUID de petición      | 🟢     | Correcto                      |
| execution_ms          | 🟢     | Documentar significado        |
| LogService            | 🟢     | Mantener                      |
| `$userId`             | 🟡     | Renombrar a `$collaboratorId` |
| `collaborator_id`     | 🟢     | Mantener                      |
| `users.id`            | 🟢     | Mantener                      |
| session_id            | 🟢     | Mantener                      |
| información HTTP      | 🟢     | Mantener                      |
| metadata_json         | 🟢     | Mantener `null`               |
| stack_trace           | 🟢     | Mantener `null`               |
| LogRepository         | 🟢     | Mantener                      |
| PDO preparado         | 🟢     | Correcto                      |
| catch/rethrow         | 🟡     | Revisar posteriormente        |
| catálogo de eventos   | 🕒     | SDI-007.2                     |
| niveles avanzados     | 🕒     | SDI-007.2                     |
| excepciones avanzadas | 🕒     | SDI-007.2                     |

---

# 15. Cierre oficial de SDI-007.1

Después de la revisión:

> 🟢 **SDI-007.1 — Primera fase funcional y estable**

se considera **cerrado**.

No se deben agregar funcionalidades por ahora solamente para "mejorarlo".

La siguiente etapa será:

# SDI-007.2 — Evolución del sistema de logs

Pero antes de comenzar dicha etapa se debe revisar la integración del sistema:

```text
public/index.php
       ↓
RequestContext::initialize()
       ↓
Controller
       ↓
LogService
       ↓
LogRepository
       ↓
MySQL
```

La siguiente revisión debe centrarse especialmente en `public/index.php`, ya que el código de `RequestContext`, `LogService` y `LogRepository` ya fue revisado.

---

# 16. Filosofía de desarrollo reafirmada

El desarrollo de SDI debe continuar bajo estas reglas:

1. Explicar primero qué problema se resuelve.
2. Explicar por qué la solución encaja en la arquitectura.
3. Determinar si es necesaria ahora o puede esperar.
4. Evitar sobreingeniería.
5. Respetar lo que ya funciona.
6. No modificar varias capas simultáneamente sin necesidad.
7. Explicar primero cualquier mejora propuesta.
8. Mantener las decisiones documentables.
9. Priorizar seguridad.
10. Registrar explícitamente las decisiones arquitectónicas futuras.
11. No rehacer componentes funcionales únicamente por razones de elegancia.
12. Diferenciar claramente laboratorio/test de producción.

---

## 🧭 Punto exacto de continuidad

```text
SDI
 │
 ├── SDI-007
 │    │
 │    ├── SDI-007.1
 │    │    ├── RequestContext       ✅
 │    │    ├── LogService           ✅
 │    │    ├── LogRepository        ✅
 │    │    ├── login_failed         ✅
 │    │    ├── login_success        ✅
 │    │    ├── logout               ✅
 │    │    └── MySQL logs           ✅
 │    │
 │    └── SDI-007.2                 ⏳
 │         └── pendiente
 │
 └── SDI-ARQ-001                    ⏳
      └── Núcleo Único de Operaciones
```

**Próximo paso inmediato:**

> Revisar `public/index.php` y confirmar que `RequestContext` se inicializa correctamente en el punto central de entrada.

Después de esa revisión podremos declarar **SDI-007.1 completamente documentado y cerrado** y comenzar, con calma, **SDI-007.2**.


# 8. Roles

Los roles actuales son:

```text
nivel0
nivel1
nivel2

La aplicación utiliza estos niveles para determinar las
operaciones disponibles.

La interfaz HTML debe mostrar solamente las funciones que
correspondan al nivel del usuario.

La autorización real debe realizarse también en el servidor.

Ocultar un botón no constituye una medida de seguridad suficiente.

9. Auditoría

SDI dispone de un sistema de auditoría basado en la tabla logs.

El objetivo es registrar acontecimientos relevantes del sistema.

La auditoría permite relacionar una operación con:

usuario;
sesión;
petición;
módulo;
evento;
entidad;
dirección IP;
método HTTP;
URI;
agente de usuario;
tiempo de ejecución;
información adicional.
10. Tabla logs

La tabla logs contiene actualmente información como:

id;
uuid;
level;
module;
event;
entity_type;
entity_uuid;
entity_name;
collaborator_id;
request_id;
session_id;
method;
uri;
ip;
user_agent;
message;
execution_ms;
metadata_json;
stack_trace;
created_at. 

11. Niveles de auditoría

Los eventos pueden utilizar diferentes niveles de importancia.

Entre ellos:

debug;
info;
notice;
warning;
error;
critical.

La clasificación permite diferenciar información normal de
situaciones que requieren atención.

12. LogService

LogService representa la capa de servicio encargada de generar
registros de auditoría desde la aplicación.

El servicio prepara información como:

UUID del evento;
request ID;
session ID;
nivel;
módulo;
evento;
mensaje;
colaborador;
entidad;
IP;
método;
URI;
user agent;
tiempo de ejecución.

Posteriormente delega la persistencia al repositorio.

13. LogRepository

LogRepository representa la capa encargada de persistir los
registros en la base de datos.

Su responsabilidad principal es insertar registros en la tabla
logs.

El repositorio utiliza PDO y consultas preparadas.

La aplicación no debe construir consultas SQL concatenando
directamente valores proporcionados por el usuario.

14. RequestContext

RequestContext proporciona información asociada a la petición.

Actualmente mantiene:

requestId;
tiempo de inicio de la petición.

El requestId permite relacionar diferentes operaciones que
ocurren durante una misma petición.

Esto será especialmente importante cuando SDI tenga más módulos
y servicios.

15. UUID

SDI utiliza UUID para identificar determinados elementos del
sistema.

Los UUID permiten disponer de identificadores que pueden
utilizarse fuera del contexto del identificador numérico interno.

16. Arquitectura de aplicación

SDI utiliza una separación conceptual entre:

Controller
    ↓
Service
    ↓
Repository
    ↓
Database
Controller

Recibe y procesa la petición.

Service

Contiene lógica de aplicación.

Repository

Se encarga de la persistencia.

Database

Almacena la información.

Esta separación permite mantener responsabilidades claras y
facilitar futuras modificaciones.

17. Base de datos

La aplicación utiliza una base de datos relacional.

La conexión se realiza mediante PDO.

Las operaciones de base de datos deben utilizar consultas
preparadas.

La información de conexión no debe formar parte de la
documentación pública de usuario.

18. Rutas de la aplicación

Actualmente SDI utiliza rutas como:

/
 /login
 /dashboard
 /files
 /logout
 /cursos
 /micuenta
 /docs
 /api/logs

Las rutas se resuelven desde el punto de entrada de la aplicación.

19. Login

El flujo actual de autenticación es:

Usuario
   ↓
/login
   ↓
LoginController
   ↓
login()
   ↓
buscar usuario
   ↓
verificar contraseña
   ↓
regenerar sesión
   ↓
crear sesión
   ↓
login_success
   ↓
/dashboard

Los inicios de sesión correctos son registrados mediante
auditoría.

20. Login fallido

Cuando las credenciales no son válidas, el sistema rechaza el
inicio de sesión.

Los intentos pueden registrarse en auditoría.

La auditoría permite conservar información útil para identificar
intentos de acceso y comportamiento anómalo.

21. Logout

El cierre de sesión elimina el estado autenticado.

El flujo conceptual es:

Usuario
   ↓
/logout
   ↓
registrar logout
   ↓
limpiar sesión
   ↓
destruir sesión
   ↓
/login

El evento de cierre de sesión también puede formar parte de la
auditoría.

22. API de auditoría

SDI dispone de un endpoint destinado a consultar los registros
de auditoría.

Ruta:

/api/logs

La API devuelve información en formato JSON.

El acceso está restringido según el nivel de autorización
establecido por la aplicación.

Actualmente se utiliza principalmente para supervisión y pruebas
del sistema.

23. Panel de auditoría

SDI dispone de una interfaz HTML para consultar los eventos de
auditoría.

El panel puede actualizar la información periódicamente sin
necesidad de recargar manualmente toda la página.

El objetivo es permitir observar eventos como:

login_success
login_failed
logout
documentation_updated

en tiempo cercano al real.

24. Auditoría en vivo

El sistema fue probado mediante una conexión desde un dispositivo
Android utilizando la red local.

Las entradas y salidas realizadas desde el dispositivo pudieron
observarse desde el panel de auditoría del servidor.

Esto demostró que:

Dispositivo
    ↓
SDI
    ↓
LogService
    ↓
logs
    ↓
API
    ↓
Panel HTML

puede utilizarse para observar eventos del sistema.

25. Seguridad de salida HTML

Durante las pruebas de seguridad se realizó una prueba XSS
introduciendo contenido HTML/JavaScript en un registro.

La prueba confirmó la importancia de escapar correctamente el
contenido antes de introducirlo en HTML.

Cuando se utiliza contenido procedente de la base de datos, debe
evitarse insertar directamente contenido no confiable mediante
innerHTML.

La aplicación debe utilizar mecanismos de escape adecuados.

26. Documentación viva

SDI utiliza archivos Markdown como fuente documental.

Los documentos principales utilizan la convención:

SyM_Atenea.md
SyM_MonteOlimpo.md
SyM_Poseidon.md
SyM_Zeus.md
SyM_Apolo.md
SyM_Ades.md
27. SisAtenea

SyM_Atenea.md representa la documentación destinada
principalmente a humanos.

Es el documento vivo que puede evolucionar mediante la interfaz
documental de SDI.

La intención es evitar que los usuarios tengan que modificar
directamente los archivos en el servidor.

28. Editor documental

SDI dispone de una interfaz HTML para modificar
SyM_Atenea.md.

El flujo es:

Usuario autorizado
       ↓
/docs
       ↓
DocsController
       ↓
leer SyM_Atenea.md
       ↓
editar
       ↓
guardar
       ↓
LogService
       ↓
documentation_updated

La aplicación utiliza una ruta de archivo controlada.

El usuario no puede proporcionar arbitrariamente la ruta del
archivo que desea modificar.

29. Permisos documentales

Actualmente la aplicación PHP puede escribir en el directorio
documental mediante los permisos configurados para el servicio
web.

Esta implementación es funcional para la fase actual.

La separación mediante una identidad propia para el servicio
symsistema queda definida como mejora futura de infraestructura.

Los detalles de esa implementación pertenecen a:

SyM_Ades.md
30. Git y documentación

La evolución futura de la documentación deberá integrarse con
Git.

Los desarrolladores podrán trabajar mediante ramas para
proponer cambios.

Conceptualmente:

main
 │
 ├── feature/
 ├── fix/
 └── docs/

Los cambios deberán poder revisarse antes de incorporarse a la
rama principal.

31. Inteligencia artificial

SDI está diseñado para poder incorporar inteligencia artificial
sin depender de un único proveedor.

Las opciones contempladas incluyen:

Ollama local;
Ollama en otro equipo;
APIs externas;
otros proveedores de modelos.

La IA deberá permanecer desacoplada de la aplicación principal.

32. Arquitectura de IA

La arquitectura futura contempla separar:

Agente
   ↓
Proveedor IA
   ↓
Modelo
   ↓
Herramientas SDI
   ↓
Autorización
   ↓
Ejecución
   ↓
Auditoría

La IA no debe tener acceso directo e irrestricto al sistema.

Las operaciones sensibles deberán pasar por mecanismos de
control.

33. Panteón SDI

El proyecto contempla una arquitectura conceptual denominada
Panteón SDI.

Sus componentes principales son:

🦉 SisAtenea
🌊 SisPoseidon
⚡ SisZeus
☀️ SisApolo
💀 SisAdes

Cada uno representa una responsabilidad diferente.

34. SisAtenea

Información para humanos.

Responsabilidades:

documentación;
interfaz humana;
edición documental;
retroalimentación;
experiencia de usuario.
35. SisPoseidon

Información para inteligencia artificial.

Su función futura será proporcionar contexto y conocimiento
estructurado a los agentes de IA.

36. SisZeus

Sistema futuro de reglas y protección.

Entre sus objetivos se encuentra:

protección contra prompt injection;
validación de operaciones;
aplicación de restricciones;
protección de recursos;
control de acciones realizadas por agentes.

La IA podrá proponer una acción.

La autorización deberá permanecer bajo control de SDI.

37. SisApolo

Sistema de apoyo al desarrollador.

Su función futura será proporcionar:

reglas de desarrollo;
buenas prácticas;
arquitectura;
pruebas;
orientación técnica;
documentación para desarrolladores.
38. SisAdes

Sistema de infraestructura.

Su documentación incluirá aspectos como:

Ubuntu;
Docker;
servicios;
redes;
almacenamiento;
usuarios del sistema;
PHP-FPM;
Nginx;
bases de datos;
Ollama;
infraestructura de IA.

Estos detalles no forman parte de la documentación humana
general de SisAtenea.

39. Principio de seguridad

SDI debe aplicar defensa por capas.

Usuario
   ↓
Autenticación
   ↓
Autorización
   ↓
Aplicación
   ↓
Validación
   ↓
Operación
   ↓
Auditoría

Ninguna interfaz visual debe considerarse una barrera de
seguridad suficiente.

Las restricciones importantes deben existir en el servidor.

40. Principio de mínimo privilegio

Cada componente debe disponer únicamente de los permisos que
necesita para cumplir su función.

Este principio se aplicará progresivamente a:

usuarios;
módulos;
servicios;
infraestructura;
agentes IA.
41. Prompt Injection

La protección específica contra prompt injection pertenece al
diseño futuro de SisZeus.

La documentación actual reconoce el riesgo, pero SisZeus todavía
no debe considerarse implementado.

La protección futura deberá evitar que una instrucción recibida
por una IA pueda convertirse automáticamente en una operación
peligrosa sobre SDI.

42. Auditoría como memoria del sistema

Una de las características fundamentales de SDI es conservar
trazabilidad.

La filosofía es:

La aplicación ejecuta.
La seguridad controla.
La auditoría recuerda.

Los registros permiten reconstruir acontecimientos importantes
del sistema.

43. Crecimiento de logs

La auditoría puede generar grandes cantidades de información.

Por este motivo, SDI deberá definir posteriormente una estrategia
para:

retención;
archivado;
rotación;
limpieza;
índices;
almacenamiento;
consultas eficientes.

Este punto deberá contemplarse tanto en la aplicación como en
la infraestructura.

La implementación de infraestructura correspondiente deberá
documentarse en SyM_Ades.md.

44. Estado actual del proyecto

Actualmente se encuentran implementados o en desarrollo:

autenticación;
sesiones;
usuarios;
roles;
login;
logout;
auditoría;
LogService;
LogRepository;
RequestContext;
API de auditoría;
panel de auditoría;
documentación Markdown;
editor HTML de SisAtenea.

45. Estado futuro

Se contempla posteriormente:

editor Markdown avanzado;
vista previa;
historial de cambios;
integración Git;
ramas desde la interfaz;
sistema de notas;
retroalimentación de usuarios;
SisPoseidon;
SisZeus;
SisApolo;
agentes de IA;
infraestructura IA desacoplada.
46. Regla de evolución

SDI se encuentra en laboratorio y desarrollo.

Las decisiones actuales pueden ser modificadas cuando exista
evidencia técnica suficiente para justificar una mejora.

Toda modificación importante deberá procurar:

mantener la seguridad;
mantener la trazabilidad;
evitar romper funcionalidades existentes;
documentar la decisión;
permitir evolución futura.

47. Principio final

SDI no busca solamente funcionar.

Busca poder explicar cómo funciona,
quién puede utilizarlo,
qué ocurrió,
por qué ocurrió
y cómo puede evolucionar sin perder el control.

48. Navegación UX inicial

Se define como base de la navegación:

SyM Sistema
│
├── Dashboard
│   ├── Información general
│   ├── Indicadores
│   ├── Próximos eventos
│   ├── Cursos disponibles
│   └── Accesos directos
│
├── Mis archivos
│
├── Clientes
│   ├── Mis clientes
│   └── Eventos
│
├── Cursos
│   ├── Cursos disponibles
│   ├── Crear curso
│   └── Moodle
│
├── Arquitectura
│   ├── Documentación
│   └── Auditoría
│
├── Lab
│
└── Administración
    ├── Usuarios
    ├── Colaboradores
    ├── Clientes
    ├── Permisos Zeus
    ├── Carpetas
    └── Sistema

El menú debe ser dinámico.

Ocultar una opción en la interfaz no constituye autorización. La
ruta y la operación deben validar nuevamente mediante Zeus.

6. Filosofía de UX

La interfaz se construirá por experiencia de usuario y no por
acumulación de módulos.

Primero:

puerta de entrada;

Dashboard;

navegación;

Mis archivos;

Clientes;

Arquitectura;

Cursos;

Administración.

Después se incorporarán operaciones avanzadas.

7. Sistema visual SyM UI

Se inicia la definición de un lenguaje visual propio.

Referencias:

Windows 11 Acrylic;

sensación de profundidad inspirada en Windows Vista/Aero;

identidad visual del CV del desarrollador;

base oscura;

acentos verdes;

superficies translúcidas;

profundidad;

sombras suaves;

paneles flotantes;

navegación tipo workspace.

La referencia visual no implica copiar Windows. Se utilizará como
inspiración estética para crear una identidad propia de SyM Sistema.

Elementos 3D --- visión futura

Se confirma que ya existe un modelo 3D .glb, probado previamente en
HTML.

Concepto UX:

                 CARGA
                   │
                   ▼
             ┌─────────┐
             │   3D    │
             │  objeto  │
             │ girando  │
             └────┬────┘
                  │
                  ▼
          transición hacia
             una esquina
                  │
                  ▼
       fondo 3D + objeto 3D
       con movimiento coordinado

Objetivo:

objeto 3D central durante carga;

animación de giro;

transición hacia una posición periférica;

fondo 3D;

coordinación visual entre objeto y fondo;

rendimiento controlado.

Esto es una visión de UX, no una implementación actual.

8. CSS y JavaScript

La dirección inicial propuesta es:

Tailwind CSS
     +
JavaScript
     +
PHP / HTML existente

Tailwind se utilizará como herramienta de composición visual, no como
identidad del producto.

Se evitará introducir React únicamente por moda.

La decisión de utilizar React u otro framework se tomará por módulo
cuando exista una necesidad real de complejidad interactiva.

49. Workspace y archivos --- visión futura

Se propone una experiencia de archivos basada en pestañas:

Dashboard | IGSA-2025 | Mis archivos | Curso 01 | +

Las pestañas podrán evolucionar hacia:

arrastrar y soltar;

abrir recursos;

mover archivos;

carga de archivos;

progreso;

vistas de carpetas;

trabajo simultáneo con varios recursos.

Esto se documenta como visión UX futura, no como funcionalidad
terminada.

Se mantiene como visión futura un sistema propio inspirado
conceptualmente en Syncthing.

No se convierte todavía en el mecanismo principal de sincronización.

El Full Scan y los scripts scan_folders / scan_files continúan
siendo operaciones de indexación, no una solución definitiva de
sincronización. Esta dirección ya estaba documentada en la continuidad
de SDI. fileciteturn1file7

50. Curso in situ y estructura documental

Visión futura:

evento_actual/
└── cliente/
    └── curso_in_situ/
        ├── carpeta/
        └── evidencia_grafica/
            ├── fotos
            └── videos

La estructura deberá poder ser configurable.

Un nivel 0 o nivel 2 podrá posteriormente crear un curso in situ y
generar automáticamente su árbol documental.

La evidencia gráfica deberá poder alimentar posteriormente un sitio
estático optimizado, utilizando fotografías y videos reducidos.

51. Moodle

Moodle queda incorporado como componente de la visión de plataforma.

La integración con IA se considera futura y deberá respetar:

seguridad;

permisos Zeus;

separación entre IA y filesystem;

APIs o servicios controlados.

No se implementa todavía como parte de la UX base.

52. 




____________________________________
____________________________________
------------------------------------
_________________________________-_
# SDI-ALM — Gestión de productos e inventario

## Estado

SDI-ALM se encuentra actualmente en fase de laboratorio utilizando:

- Excel
- VBA
- Power Query

La lógica validada en este entorno servirá posteriormente como referencia para la migración hacia HTML/PHP/MySQL.

---

## 1. Fuentes de información

SDI-ALM utiliza dos fuentes principales:

### 1.1 INVIZT01

Contiene la información proveniente del PNR.

Representa principalmente:

- almacén
- ubicación
- código original
- descripción
- unidad
- existencias
- código normalizado

La existencia física registrada en PNR se expresa en **cajas equivalentes** y puede contener valores decimales.

---

### 1.2 catalogo_maestro

Representa el catálogo conocido de productos.

Columnas actuales:

```text
codigo
descripcion
cajas_tarima
cajas_cama
piezas_caja
personalizado

personalizado es un campo auxiliar utilizado para adaptar el código a los procesos de Power Query y facilitar su correspondencia con los datos de existencias.

La búsqueda funcional de VBA utiliza principalmente:

codigo
2. InvExist

InvExist representa la información que consume actualmente la interfaz VBA.

Columnas:

almacen
ubicacion
codigo_original
descripcion
unidad
existencias
codigo
cajas_tarima
cajas_cama
piezas_caja

La intención arquitectónica es que InvExist integre:

INVIZT01
    +
catalogo_maestro
    ↓
InvExist
    ↓
VBA / CAPTURA

Por lo tanto:

PNR aporta las existencias.
catálogo_maestro aporta la configuración logística del producto.
VBA no debe depender de que el operador introduzca manualmente estos datos durante el conteo.
3. Identificación de productos

La búsqueda de productos se realiza desde:

CAPTURA!H3

El flujo actual es:

CAPTURA!H3
      ↓
BuscarProducto
      ↓
ObtenerProducto
      ↓
InvExist

Si el producto existe:

InvExist
   ↓
MostrarProducto
   ↓
CAPTURA

Se muestran:

descripcion
existencias
cajas_tarima
cajas_cama
piezas_caja
4. Búsqueda secundaria en catálogo

Si el producto no existe en InvExist, SDI-ALM realiza una segunda búsqueda:

InvExist
   ↓
NO ENCONTRADO
   ↓
catalogo_maestro

Esto permite distinguir dos situaciones diferentes.

Producto desconocido

No existe en:

InvExist

ni en:

catalogo_maestro

Resultado:

Producto no encontrado en el catálogo maestro.
Producto conocido pero sin existencias

Existe en:

catalogo_maestro

pero no en:

InvExist

Resultado:

El producto existe en el catálogo maestro,
pero no está registrado en existencias.

Este caso NO debe interpretarse como producto desconocido.

Representa un producto conocido por el sistema que actualmente no aparece en las existencias provenientes del PNR.

5. Regla de negocio: producto sin existencias

Actualmente, cuando un producto existe en catalogo_maestro pero no en InvExist, el operador no inicia directamente el conteo.

El flujo actual es:

Buscar producto
      ↓
¿Está en InvExist?
      │
     NO
      ↓
¿Está en catalogo_maestro?
      │
     SÍ
      ↓
Producto conocido
pero sin existencias
      ↓
Detener captura

La posibilidad de agregar posteriormente este producto a inventario será una evolución posterior del sistema.

6. Normalización de códigos

SDI-ALM utiliza una normalización mínima de 7 caracteres numéricos.

Ejemplo:

34400
↓
0034400
123456
↓
0123456
1234567
↓
1234567

Los códigos con más de 7 caracteres no se recortan.

La normalización permite que diferentes formas de captura del mismo código sean comparables.

7. Captura física

La hoja CAPTURA contiene:

H14 → Tarimas
H15 → Camas
H16 → Cajas
H17 → Piezas

Actualmente estos campos aceptan únicamente:

números enteros >= 0

La validación se realiza mediante Worksheet_Change.

Todavía no se realiza el cálculo del total.

8. Unidad base del inventario

La unidad utilizada para comparar existencias es:

CAJA EQUIVALENTE

existencias puede contener valores decimales.

Las piezas representan una fracción de caja.

Ejemplo:

piezas_caja = 10

1 pieza = 0.1 caja
5 piezas = 0.5 caja

El modelo previsto para el cálculo físico es:

tarimas × cajas_tarima
+
camas × cajas_cama
+
cajas
+
(piezas / piezas_caja)

El resultado representa cajas equivalentes.

9. Regla de negocio: cajas por cama

cajas_cama representa la cantidad de cajas que físicamente pueden acomodarse por cama para un producto.

Este valor puede variar entre productos debido a sus dimensiones y características físicas.

Ejemplo:

Producto A → 8 cajas/cama
Producto B → 12 cajas/cama
Producto C → 6 cajas/cama

En la versión actual:

cajas_cama debe estar configurado antes de realizar el conteo físico.

Si el producto no tiene cajas_cama configurado:

DETENER CAPTURA

El operador debe informar al responsable.

El responsable modifica:

catalogo_maestro

Posteriormente se actualiza Power Query y el operador vuelve a consultar el producto.

No se permitirá que el operador estime o introduzca temporalmente el valor durante el conteo.

10. Separación de responsabilidades

La arquitectura actual mantiene las siguientes responsabilidades:

Power Query
    ↓
Integración y transformación de datos
modProductos
    ↓
Búsqueda e identificación de productos
modCaptura
    ↓
Presentación y limpieza de información
Hoja CAPTURA
    ↓
Interacción del operador
modUtilidades
    ↓
Funciones reutilizables
    ↓
NormalizarCodigo
    ↓
ValidarCantidad

La lógica matemática de inventario se implementará posteriormente en:

modCalculos
11. Flujo actual de SDI-ALM
                    CAPTURA
                       │
                       ▼
                  Código H3
                       │
                       ▼
                BuscarProducto
                       │
                       ▼
                ┌──────────────┐
                │   InvExist   │
                └──────┬───────┘
                       │
                 ¿Encontrado?
                  /          \
                SÍ            NO
                │              │
                ▼              ▼
        MostrarProducto   Buscar catálogo
                │              │
                │        ┌─────┴─────┐
                │        │           │
                │       NO          SÍ
                │        │           │
                │        ▼           ▼
                │    Producto    Producto
                │    desconocido conocido
                │                    │
                │                    ▼
                │              Sin existencias
                │
                ▼
        Validar cajas_cama
                │
          ┌─────┴─────┐
          │           │
         NO          SÍ
          │           │
          ▼           ▼
       DETENER     Captura física
       CAPTURA
12. Estado funcional actual
Funcionando
Búsqueda de producto en InvExist.
Búsqueda secundaria en catalogo_maestro.
Normalización de códigos.
Mostrar información del producto.
Limpieza de captura.
Validación de cantidades físicas.
Detección de productos sin cajas_cama.
Detención de captura cuando falta configuración.
Pendiente inmediato
modCalculos
    ↓
CalcularTotal
    ↓
Diferencia
    ↓
Semáforo

Posteriormente:

Captura
    ↓
Base Captura
    ↓
Movimientos
    ↓
Historial
    ↓
Dashboard
Decisión arquitectónica importante

SDI-ALM no debe confundir "producto sin existencias" con "producto inexistente".

La distinción es:

NO está en catálogo
        =
Producto desconocido

mientras que:

SÍ está en catálogo
+
NO está en InvExist
        =
Producto conocido sin existencia registrada

Esta distinción deberá conservarse cuando SDI-ALM migre de Excel/VBA hacia HTML/PHP/MySQL.


### Yo lo colocaría dentro de Atenea como

```text
SDI
├── SDI-Sistema
├── SDI-Arquitectura
├── SDI-ALM
│   ├── Fuentes de datos
│   ├── Inventario
│   ├── Captura física
│   ├── Reglas de negocio
│   └── Flujo de búsqueda
└── ...

Y marcaría este bloque como SDI-ALM v0.2, porque ya no estamos simplemente haciendo macros: acabamos de definir reglas de negocio que después tendrán que sobrevivir a la migración a PHP/MySQL.

Eso es precisamente lo que hace que SyM_Atenea.md sea útil como documento de arquitectura y no simplemente como una bitácora de lo que hicimos.


FIN — SyM_Atenea.md