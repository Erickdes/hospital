# hospital_
se pretende desarrolar un sistema para administrar los medicos, cirugias y salas de un 
hospital, de manera que en una tabla se muestren las cirugias que estan 
programadas para ese mismo dia, la sala en que se llavara a cabo cada una 
(son 5 salas) y el cirugano asignado, para ello usando html, css, javascript
 y otros lenguajes que me ayuden a proporcionarle verificacion de seguridad
 y frameworks que faciliten el proceso, y debe de conectarse con una base de
 datos en php myadmin
el objetivo de la api es:
*1.- adminstrar (agregar, modificar y eliminar) los elementos de una cirugia, los trabajadores contaran con: id, nombres, apellidos, domicilio, curp, rfc, fecha en la que inicio a laborar en la empresa, puesto, especialidad, usuario y contraseña. 
*2.-existen tres tipos de usuarios: *ciruganos (quienes solo podran visualizar la tabla de cirugias programadas)  *jefe de piso (tambien es un medico cirugano) quien dentro de la plataforma ademas de poder visualizar la tabla de cirugias programadas tambien podra: { 1.agregar cirugias (cada cirugia conlleva cirugano y sala), 2.modificar los  elementos de la cirugia- la cirugia es en si misma un elemento String que describe el nombre de la cirugia-, cirugano y sala asignados, 3.cancelar cirugias cuando se cancelen cirugias en lugar de aparecer la fecha se mostrara "CANCELADA".}, *jefe de unidad (tambien es un medico cirugano):ademas de poder realizar lo mismo que un jefe de piso tambien puede modificar al jefe de piso. Todos los usuarios deberan de ingresar a la plataforma escribiendo usuario y contraseña. Y dependiendo del rol de cada uno sera la pantalla que se mostrara 
*3.-la tabla de cirugias programadas tendra los siguientes columnas: Cirugia, Sala, Medico, Jefe de piso.
*4.-existiran 2 jefes de unidad, 10 ciruganos y 2 jefes de piso. 
*5.-la comunicacion con la base de datos debe de llevarse a cabo de manera segura evitando el uso de get 
*6.-los jefes de unidad al darle click en el nombre del jefe de piso o del cirugano encargado de la cirugia podran visulizar la informacion de cada uno respectivamente.
*7.- la vista de usuario debe de contar con: *un mensaje de binvenida que diga "bienvenido " y el nombre del usuario. *un boton para cerrar la sesion. * para poder mostrar las tablas se debe de comprobar el inicio de sesion, en caso de no haber iniciado se mostrar un mensaje "es necesario iniciar sesion" y un boton aceptar que te redireccionara a la pantalla de inicio de sesion.
*8.-debe existir una pantalla de inicio de sesion donde se pida ingresar usuario y contraseña, de no ser correctos se mostrara el mensaje intentelo de nuevo y la pagina se recargara. 
*9.-cuando algun jefe modifique alguna cirugia solo deberan de aparecer como opciones disponibles los medicos y salas existentes evitando asi que los jefes tengan que escribir en estos campos. en el unico campo donde podran escribir directamente es en el de cirugia.
