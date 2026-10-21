
# 🏥 Sistema de Gestión Hospitalaria

<p align="center">
  <strong>Administración y organización de cirugías programadas</strong>
  <br>
  Sistema para gestionar médicos, cirugías y salas quirúrgicas de un hospital.
</p>


---

## 📋 Descripción del proyecto

El **Sistema de Gestión Hospitalaria** tiene como objetivo desarrollar una plataforma para administrar al personal médico, las cirugías programadas y las salas quirúrgicas de un hospital.

El sistema permitirá consultar, registrar, modificar y cancelar cirugías, según los permisos asignados a cada usuario.

La tabla principal mostrará las cirugías programadas para el día actual, incluyendo la sala asignada, el médico cirujano responsable y el jefe de piso correspondiente.

## Objetivos

- Administrar la información de los trabajadores.
- Gestionar las cirugías programadas.
- Controlar la asignación de médicos y salas quirúrgicas.
- Implementar autenticación y control de acceso por roles.
- Proteger la comunicación con la base de datos.
- Facilitar la consulta de información del personal autorizado.

## Funcionalidades

### 1. Gestión de trabajadores

El sistema contempla los siguientes datos de cada trabajador:

- ID.
- Nombres y apellidos.
- Domicilio.
- CURP.
- RFC.
- Fecha de ingreso al hospital.
- Puesto.
- Especialidad.
- Nombre de usuario.
- Contraseña.

### 🏥 2. Gestión de cirugías

Los usuarios autorizados podrán:

- **Agregar:** registrar una cirugía, el médico responsable y la sala asignada.
- **Modificar:** actualizar el nombre de la cirugía, el médico o la sala.
- **Cancelar:** identificar una cirugía cancelada mediante el texto `CANCELADA` en lugar de la fecha correspondiente.
- **Consultar:** visualizar las cirugías programadas para el día actual.

Los médicos y las salas se seleccionarán de listas con opciones existentes. El nombre de la cirugía será el campo de texto libre.

### 3. Gestión de salas

El hospital contará con **5 salas quirúrgicas**.

Cada cirugía deberá tener asignados un médico cirujano y una sala existente.

### 4. Tabla de cirugías programadas

La tabla principal tendrá las siguientes columnas:

| Cirugía | Sala | Médico | Jefe de piso |
|---|---|---|---|
| Nombre de la cirugía | Sala asignada | Cirujano responsable | Jefe de piso asignado |

*La fila anterior es ilustrativa y no representa información real de la base de datos.*

## 👥 Roles y permisos

| Rol | Permisos principales |
|---|---|
| 👨‍⚕️ Cirujano | Consultar las cirugías programadas. |
| 🩺 Jefe de piso | Consultar, agregar, modificar y cancelar cirugías. |
| 🏥 Jefe de unidad | Realizar las operaciones de un jefe de piso y modificar la información de los jefes de piso. |

### Distribución del personal

- **2 jefes de unidad**
- **10 cirujanos**
- **2 jefes de piso**

Todos los usuarios deberán iniciar sesión con su nombre de usuario y contraseña. Las pantallas y las funcionalidades disponibles dependerán de su rol.

## Autenticación y seguridad

El sistema deberá incorporar mecanismos para proteger la información hospitalaria:

- **Inicio de sesión obligatorio:** se requerirá una sesión autenticada para acceder a las secciones protegidas.
- **Validación de credenciales:** si los datos son incorrectos, se mostrará el mensaje `Inténtelo de nuevo` y se recargará la pantalla de inicio de sesión.
- **Control de acceso:** cada rol tendrá acceso únicamente a las funcionalidades autorizadas.
- **Cierre de sesión:** habrá un botón para finalizar la sesión.
- **Solicitudes seguras:** las operaciones no expondrán información sensible en la URL y utilizarán métodos HTTP apropiados.
- **Protección de contraseñas:** se almacenarán mediante algoritmos de hash seguros, nunca como texto plano.
- **Prevención de inyección SQL:** se utilizarán consultas preparadas y validaciones en el servidor.

### Control de sesión

Si un usuario intenta acceder a una sección protegida sin haber iniciado sesión, se mostrará el mensaje:

> Es necesario iniciar sesión.

El mensaje incluirá un botón **Aceptar** que redirigirá a la pantalla de inicio de sesión.

## Consulta de información del personal

Los jefes de unidad podrán consultar la información del cirujano responsable o del jefe de piso al seleccionar sus nombres en la tabla de cirugías.

El acceso a esta información estará protegido mediante permisos y validaciones del servidor.

## 🖥️ Interfaz de usuario

La interfaz deberá incluir:

- Pantalla de inicio de sesión con usuario y contraseña.
- Mensaje de bienvenida: `Bienvenido` seguido del nombre del usuario.
- Tabla de cirugías programadas.
- Botón para cerrar sesión.
- Pantallas y opciones según el rol.
- Mensajes de validación y confirmación.

## Tecnologías

| Tecnología | Propósito |
|---|---|
| HTML | Estructura de las páginas. |
| CSS | Diseño visual de la interfaz. |
| JavaScript | Interactividad y validaciones del cliente. |
| PHP | Procesamiento de solicitudes y comunicación con la base de datos. |
| MySQL | Almacenamiento de información. |
| phpMyAdmin | Administración de la base de datos. |

Se podrán incorporar frameworks y bibliotecas adicionales según las necesidades del proyecto.

## Base de datos

La aplicación utilizará una base de datos relacional para almacenar y administrar los datos de los trabajadores, las salas y las cirugías.

La base de datos se administrará mediante **phpMyAdmin**. Las conexiones y consultas desde PHP deberán realizarse de manera segura, con consultas preparadas y validaciones del lado del servidor.

## 🚀 Instalación y ejecución

Las instrucciones de instalación y ejecución se agregarán una vez que se confirme la estructura del proyecto y la configuración de la base de datos.

## Estado del proyecto

**En desarrollo.**

Las funcionalidades descritas representan los requisitos previstos para el Sistema de Gestión Hospitalaria.

---

<p align="center">
  <br>
  <sub>Organización, seguridad y administración de cirugías programadas.</sub>
</p>

