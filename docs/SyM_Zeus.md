🔱 SYM_ZEUS — Estado al cierre de hoy
Usuarios identificados
Usuario	collaborator_id	Nivel
Miguel	1	nivel0
Invitado	2	nivel1
Salvador	3	nivel2
Carpetas privadas identificadas
Carpeta	folder_id	Propietario
Miguel	4138	Miguel (1)
Salvador	4141	Salvador (3)
Permisos establecidos
Miguel    → Miguel    → VIEW ✅
Salvador  → Salvador  → VIEW ✅


Salvador  → Miguel    → DENEGADO 🔱
Invitado  → Miguel    → DENEGADO 🔱
Invitado  → Salvador  → DENEGADO 🔱

Y una decisión arquitectónica importante:

La ausencia de un permiso activo significa DENEGADO.

No estamos creando una lista de "todo lo que está prohibido". Zeus trabaja bajo deny by default.

🧠 La tabla zeus_permissions

También corregimos el problema que encontramos:

permission no debe ser UNIQUE por sí mismo.

Ahora la unicidad lógica es:

collaborator_id
       +
folder_id
       +
permission

mediante:

uq_zeus_permission

Esto permitirá posteriormente:

Salvador → carpeta → view
Salvador → carpeta → edit
Salvador → carpeta → version
Salvador → carpeta → delete

sin duplicar accidentalmente la misma autorización.

📚 ¿Qué MD actualizamos?

Como acordamos, SYM_Zeus.md pasa a ser el primer documento "vivo" de esta arquitectura.

Y debemos actualizar los documentos históricos solamente como referencia, no como autoridad actual:

🔱 SyM_Zeus.md

Agregar:

nacimiento de SYM_ZEUS;
propósito del sistema;
zeus_permissions;
relación collaborator_id;
relación folder_id;
permisos view/edit/delete/version;
estados active/revoked;
principio deny by default;
prueba realizada hoy;
usuarios y carpetas de prueba;
resultado Salvador → Miguel = DENEGADO;
corrección del índice UNIQUE;
siguiente etapa: integración con PHP/UI.
