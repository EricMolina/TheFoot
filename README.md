# TheFoot
Miembros del grupo: Eric, Ricard y Jorge
## Introducción
En este repositorio de gitHub está nuestra pagina web del proyecto 3 que consiste en la creación de una pagina web de restaurantes de barcelona, este proyecto debe cumplir los siguientes requisitos:

* La pagina web debe de estar basada en una asignada al grupo, en nuestro caso es [The fork](https://www.thefork.es/)
* Debe usarse Laravel y todas las funcionalidades posibles que ofrece el framework
* Para poder ver la pagina web los clientes tienen que iniciar sesión
* Varios tipos de usuarios
* Cruds para modificar y añadir usuarios y restaurantes
* Debe usase git para subir commits a lo largo del desarrollo y gestionado mediante ramas
* Uso de issues asignadas a miembros del grupo y milestones

## Instalación del proyecto

**_Este tutorial da por hecho que ya se tiene instalado composer_**

Empezaremos descargando el repositorio de git hub

``` git clone https://github.com/EricMolina/TheFoot.git ```

Una vez descargado nos copiaremos el fichero .env.example y lo renombraremos como .env

``` cp .env.example .env ```

En este nuevo fichero podnremos la ruta de la BD que vamos a utilizar y las credenciales de sesión del usuario.

Una vez configurado esto generaremos las claves en caso de querer usar el servidor web interno de laravel

``` php artisan key:generate ```

Ya solo nos faltaría ejecutar las migraciones y los seeders, ambas cosas lo podemos hacer con un único comando

``` php artisan migrate:fresh --seed ```

Con esto ya solo nos falta arrancar nuestro servidor, si lo hacemos desde laravel ejecutaremos el comando

``` php artisan serve ```

Y accederemos a la pagina mediante el siguiente [link](http://127.0.0.1:8000)

Si todo ha ido bien veremos la siguiente pagina:

![image](https://github.com/EricMolina/TheFoot/assets/91189374/04a9408a-a96a-455f-a705-f54461c64ff0)

## Credenciales de inicio de sesión

Como hemos mencionado anteriormente para poder visualizar el contenido de la pagina web primero hay que iniciar sesión en la pagina, para eso hemos creado un par de usuarios con distintos roles para poder testear todas las funcionalidades de la pagina web.

* eric.molina@gmail.com
  - Cliente
* jorge.alcalde@gmail.com
  - Manager
* ricard.casals@gmail.com
  - Administrador

**_En todos los casos la contraseña siempre es asdASD123_**

Aparte de estas credenciales tambien existe una cuenta de correo real que es la que se utilizará para notificar a los usuarios, las credenciales son las siguientes:

* **Correo:** thefoot.noreply@gmail.com
* **Contraseña:** Vjva;D92Q7b&My`7

### Tipos de usuarios

Para controlar que los usuarios solo puedan acceder a secciones que le corresponden hemos creado 3 tipos de usuarios los cuales tienen funcionalidades distintas

* **Cliente:** Pueden buscar restaurantes y valorarlos.
* **Managers:** Pueden buscar restaurantes, valorarlos y a demás gestionan su propio restaurante.
* **Administradores:** Pueden buscar restaurantes, valorarlos y a demás tienen acceso a los CRUDs para gestionar restaurantes y usuarios.

**Por defecto cuando se crea un usuario este tiene el rol de cliente y es el administrador el que se encargará de modificarlo**

## Diagrama de la Base de datos

![image](https://github.com/EricMolina/TheFoot/assets/91189374/cde0b9c2-c138-446c-95f2-f4477d72ebe2)

  
