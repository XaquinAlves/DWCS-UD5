# Docker: PHP & MySQL

## php
Se ha añadido soporte para trabajar con otras versiones de php. Se ha modificado el archivo docker de la máquina para instalar:

* pdo
* pdo_mysql
* zip
* bcmath
* intl
* gd
* [Composer](https://getcomposer.org/)

Se han habilitado los módulos `rewrite` y `headers`. 

Además se ha modificado el fichero php.ini modificando las siguientes directivas:

* memory_limit=512M
* max_execution_time=12000
* post_max_size=256M
* upload_max_size=256M
* error_reporting=E_ALL

Se pueden agregar/modificar directivas adicionales añadiendo/modificando el fichero `./docker/php/custom-php.ini`

Se ha instalado xdebug con la siguiente configuración:

* zend_extension=xdebug.so
* xdebug.mode=develop,debug
* xdebug.start_with_request=yes
* xdebug.discover_client_host=0
* xdebug.client_host=host.docker.internal
* xdebug.log_level=7
* xdebug.var_display_max_depth=10
* xdebug.log=/tmp/xdebug.log

Se puede modificar la configuración modificando el fichero `./docker/php/xdebug.ini`

## Apache
Se ha habilitado la directiva de apache de listado de directorio.

## MySQL
Podemos acceder a todas las bases de datos creadas en el contenedor usando el usuario definido por la variable `MYSQL_USER` o con el usuario `root` la contraseña será en ambos casos la misma que definamos en la variable de entorno `MYSQL_PASSWORD`.

* El usuario `root` tendrá acceso a todas las bases de datos creadas en el contenedor.
* El usuario `MYSQL_USER` tendrá acceso sólo a la base de datos definida en la variable de entorno `MYSQL_DATABASE`.

Para aplicaciones en las que sólo accedamos a una base de datos debemos utilizar el usuario `MYSQL_USER`.

### Importación de BBDD

Si importamos ficheros de script SQL en la carpeta `./docker/mysql/dumps` éstos se importarán automáticamente en la primera ejecución del entorno.

* Los scripts pueden realizar **cualquier operación**. Por ejemplo, crear schemas, tablas y volcar información en las mismas.
* Los scripts que no especifiquen la base de datos a utilizar con la sentencia `USE`, se ejecutarán en `MYSQL_DATABASE`

Estos scripts sólo se ejecutarán la primera vez que lancemos el entorno. Para testear que el site se crea bien, debemos tirar las máquinas, borrar el volumen asociado, rehacer la máquina mysql y lanzar el entorno:
```zsh
#Tirar el entorno
docker compose down

#Buscar los volúmenes existentes
docker volume ls
#Encontramos el volumen de nuestro entorno y lo borramos con 
docker volume rm <nombre_volume>

#Rehacemos
docker compose build mysql

#Relanzamos
docker compose up -d
```



Readme proyecto original
---

Instala rápidamente un ambiente de desarrollo local para trabajar con [PHP](https://www.php.net/) y [MySQL](https://www.mysql.com/) utilizando [Docker](https://www.docker.com). 

Utilizar *Docker* es sencillo, pero existen tantas imágenes, versiones y formas para crear los contenedores que hacen tediosa esta tarea. Este proyecto ofrece una instalación rápida, con versiones estandar y con la mínima cantidad de modificaciones a las imágenes de Docker. 

Viene configurado con  `PHP 8.0` y `MySQL LTS`, además se incluyen las extensiones `gd`, `zip` y `mysql`.

## Configurar el ambiente de desarrollo

Puedes utilizar la configuración por defecto, pero en ocasiones es recomendable modificar la configuración para que sea igual al servidor de producción. La configuración se ubica en el archivo `.env` con las siguientes opciones:

* `PHP_VERSION` versión de PHP ([Versiones disponibles de PHP](https://github.com/docker-library/docs/blob/master/php/README.md#supported-tags-and-respective-dockerfile-links)).
* `DOCUMENT_ROOT` define la ruta en la que pondremos la raíz de nuestro site. Por defecto es `./www/public`
* `PHP_PORT` puerto para servidor web. Por defecto se ha puesto 8080.
* `MYSQL_VERSION` versión de MySQL([Versiones disponibles de MySQL](https://hub.docker.com/_/mysql)).
* `MYSQL_USER` nombre de usuario para conectarse a MySQL.
* `MYSQL_PASSWORD` clave de acceso para conectarse a MySQL.
* `MYSQL_DATABASE` nombre de la base de datos que se crea por defecto.

## Instalar el ambiente de desarrollo

La instalación se hace en línea de comandos:

```zsh
docker-compose up -d
```
Puedes verificar la instalación accediendo a: [http://localhost/info.php](http://localhost/info.php)

## Comandos disponibles

Una vez instalado, se pueden utilizar los siguiente comandos:

```zsh
docker-compose start    # Iniciar el ambiente de desarrollo
docker-compose stop     # Detener el ambiente de desarrollo
docker-compose down     # Detener y eliminar el ambiente de desarrollo.
```

## Estructura de Archivos

* `/docker/` contiene los archivos de configuración de Docker.
* `/www/` carpeta para los archivos PHP del proyecto. Con la configuración por defecto el index.php del proyecto debe ir en la carpeta public. Se pueden cambiar en `.env` archivo entrada DOCUMENT_ROOT.

## Accesos

### Web

* http://localhost/

### Base de datos

Existen dos dominios para conectarse a base de datos.

* `mysql`: para conexión desde los archivos PHP.
* `localhost`: para conexiones externas al contenedor.

Las credenciales por defecto para la conexión son:

| Usuario | Clave | Base de datos |
|:---:|:---:|:---:|
| admin | daw2pass | myproject-db |
