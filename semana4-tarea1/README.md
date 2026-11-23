# Sistema de Inscripciones a Cursos de Inteligencia Artificial

**Semana 4 – Tarea 1 | Aplicaciones Web – Scaffolding**

## Descripción del proyecto

Este sistema web fue desarrollado tomando como referencia el funcionamiento de un centro de capacitación. Su objetivo es facilitar el registro de estudiantes interesados en aprender Inteligencia Artificial, así como la administración de cursos, instructores e inscripciones.

La aplicación permite registrar, consultar, editar y eliminar información mediante operaciones CRUD.

## Tecnologías utilizadas

- **C# y ASP.NET Core MVC (.NET 10):** Desarrollo de la aplicación web.
- **Entity Framework Core:** Gestión de los datos mediante el enfoque Code First.
- **MySQL:** Almacenamiento de la información.
- **Scaffolding de Visual Studio:** Estructura de controladores y vistas CRUD (Index, Details, Create, Edit y Delete).

## Modelo de base de datos

La base de datos está formada por **4 entidades, cada una con 5 atributos**, cumpliendo con los requisitos de la actividad.

| Entidad | Atributos |
|---|---|
| Estudiantes | `Id`, `Nombre`, `Apellido`, `Correo`, `Telefono` |
| Instructores | `Id`, `Nombre`, `Apellido`, `Especialidad`, `Correo` |
| Cursos | `Id`, `Nombre`, `Nivel`, `Cupos`, `InstructorId` |
| Inscripciones | `Id`, `EstudianteId`, `CursoId`, `FechaInscripcion`, `Estado` |

## Relaciones entre las entidades

- Un instructor puede estar a cargo de varios cursos mediante `InstructorId`.
- Un estudiante puede realizar varias inscripciones mediante `EstudianteId`.
- Un curso puede tener varios estudiantes inscritos mediante `CursoId`.

Estas relaciones permiten organizar la información y evitar registros de inscripciones sin un estudiante o curso asociado.

Las propiedades de navegación de los modelos C# no generan columnas adicionales. Además, la tabla `__EFMigrationsHistory` es utilizada internamente por Entity Framework Core para controlar las migraciones y no se considera una entidad del sistema.

## Funcionamiento del sistema

El sistema cuenta con cuatro secciones principales: Estudiantes, Instructores, Cursos de IA e Inscripciones.

Primero se registran los instructores y los cursos disponibles. Después se ingresan los datos de los estudiantes y se realizan las inscripciones correspondientes. Toda la información se guarda en MySQL y puede consultarse o actualizarse desde la aplicación web.

