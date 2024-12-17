
### **Sistema de Gestión de Proyectos**

El Sistema de Gestión de Proyectos permite a los equipos organizar, supervisar y gestionar proyectos de manera eficiente, dividiendo tareas y asignando responsabilidades. Además, asegura un control adecuado sobre la seguridad y el acceso a la información según los roles y permisos definidos para cada usuario.

---

### **Reglas de Negocio**

1. **Gestión de Proyectos**  
   - Un proyecto debe tener un líder asignado. **(Listo)**
   - Solo los usuarios asignados a un proyecto pueden interactuar con él.
   - Los proyectos pueden estar en diferentes estados: *Activo*, *En Progreso*, *Completado* o *Archivado*. **(Listo)**

2. **Gestión de Tareas**  
   - Cada tarea debe estar vinculada a un proyecto. **(Listo)**
   - Las tareas tienen estados: *Pendiente*, *En Curso*, *Bloqueada* o *Finalizada*. **(Listo)**
   - Una tarea puede tener uno o más responsables asignados.
   - Solo el creador o un usuario con permisos adecuados puede modificar una tarea.

3. **Roles y Permisos**
   - **Admin**: Control total sobre la aplicación, incluyendo la gestión de proyectos, tareas y usuarios.
   - **Líder**: Control sobre los proyectos y tareas asignados, con la capacidad de gestionar miembros.
   - **Miembro**: Acceso limitado para visualizar y trabajar en las tareas asignadas.

4. **Acceso Controlado**  
   - Ningún usuario podrá acceder a proyectos o tareas a los que no esté asignado.
   - Los proyectos y tareas archivados serán visibles únicamente para administradores.

5. **Auditoría**  
   - Todos los cambios significativos (creación, edición o eliminación de proyectos/tareas) se registran para fines de auditoría.

6. **Integraciones**
   - La API debe generar tokens únicos para integraciones con herramientas externas (como Jira, Slack, etc.).
   - Los tokens generados estarán restringidos a los permisos del usuario que los creó.

---

### **Funciones por Rol**

#### **Admin**

- **Proyectos**:
    - Crear, editar y eliminar cualquier proyecto.
    - Asignar o cambiar el líder de un proyecto.
    - Archivar proyectos.
- **Tareas**:
    - Crear, editar y eliminar cualquier tarea.
    - Cambiar el estado de las tareas.
- **Usuarios**:
    - Crear, editar y eliminar usuarios.
    - Asignar roles y permisos a los usuarios.
- **Otros**:
    - Acceder a la auditoría de todos los proyectos y tareas.
    - Generar y revocar tokens para integraciones externas.

---

#### **Líder**

- **Proyectos**:
    - Crear proyectos.
    - Editar proyectos asignados.
    - Archivar proyectos propios, siempre que no estén vinculados a otros activos.
- **Tareas**:
    - Crear y asignar tareas dentro de sus proyectos.
    - Editar o eliminar tareas dentro de los proyectos que lidera.
    - Cambiar el estado de tareas propias o asignadas.
- **Usuarios**:
    - Asignar y gestionar miembros dentro de sus proyectos.
- **Otros**:
    - Acceder a reportes de progreso de los proyectos que lidera.

---

#### **Miembro**

- **Proyectos**:
    - Ver los proyectos asignados.
- **Tareas**:
    - Ver las tareas asignadas.
    - Cambiar el estado de sus tareas a *En curso* o *Finalizada*.
- **Otros**:
    - Recibir notificaciones sobre cambios en las tareas o proyectos a los que está asignado.

---

### **Flujo de Permisos**

1. **Crear Proyecto**  
   - Solo los Admin o Líderes pueden crear proyectos.
   
2. **Asignar Miembros**  
   - El Admin o el Líder del proyecto pueden agregar o eliminar miembros en un proyecto.

3. **Modificar Proyecto**  
   - Solo el Admin o el Líder asignado pueden editar un proyecto.

4. **Gestionar Tareas**  
   - Los Admin, Líderes y Miembros asignados pueden interactuar con las tareas, de acuerdo con su rol.

5. **Generar Tokens**  
   - Los tokens son generados por los usuarios según su rol, y están limitados al acceso que su rol tiene sobre los recursos.

---

### **EndPoints Representativos**

| Método  | EndPoint                        | Controlador                          |
|---------|----------------------------------|--------------------------------------|
| GET     | /                                | ...                                  |
| POST    | api/login                        | App\Auth\Adapters\Controlador       |
| POST    | api/logout                       | App\Auth\Adapters\Controlador       |
| GET     | api/me                           | App\Auth\Adapters\Controller        |
| GET     | api/projects                     | ProjectsController@index            |
| POST    | api/projects                     | ProjectsController@store            |
| POST    | api/projects/group/{id}          | App\ProjectsController@addGroup     |
| GET     | api/projects/{id}/members        | App\ProjectsController@members      |
| GET     | api/projects/{project}           | ProjectsController@show             |
| PUT/PATCH | api/projects/{project}          | ProjectsController@update           |
| DELETE  | api/projects/{project}           | ProjectsController@destroy          |
| GET     | api/tasks                        | TasksController@index              |
| POST    | api/tasks                        | TasksController@store              |
| GET     | api/tasks/{task}                 | TasksController@show               |
| PUT/PATCH | api/tasks/{task}                | TasksController@update             |
| DELETE  | api/tasks/{task}                 | TasksController@destroy            |
| GET     | api/users                        | UsersController@index              |
| POST    | api/users                        | UsersController@store              |
| GET     | api/users/{user}                 | UsersController@show               |
| PUT/PATCH | api/users/{user}                | UsersController@update             |
| DELETE  | api/users/{user}                 | UsersController@destroy            |
| POST    | login                            | App\Auth\Adapters\Controller       |
| POST    | logout                           | App\Auth\Adapters\Controller       |
| GET     | me                               | App\Auth\Adapters\Controller       |
| GET     | sanctum/csrf-cookie              | sanctum.csrf                        |
| GET     | storage/{path}                   | storage.local                       |
| GET     | up                               | ...                                 |

