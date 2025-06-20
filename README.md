
# Cipher Api Test Documentation

## Aclaracion

La estructura de este proyecto es modular asi que cada parte de la aplicacion es un modulo que se encuentra dentro de la carpeta modules en la raiz del proyecto.

## Instalar el proyecto
Despues de haber clonado el repositorio de github. Lo abrimos en nuestro editor de codigo preferido, yo recomiendo visual studio code.

Unas vez con el proyecto abierto en nuestro editor de codigo primero creamos un archivo `.env` en la raiz del proyecto y pegamos en este el contenido del archivo `.env.example`, luego abrimos una consola en la carpeta raiz del proyecto para ejecutar los comandos necesarios.

`composer install`

Con este comando, vamos a instalar todas las dependencias de nuestro proyecto.

`docker-compose up -d`

Con este comando vamos a levantar nuestro contendor de docker donde correra nuestro proyecto.

`docker exec -it <container_id> sh`

Con este comando podremos abrir una terminar que esta atachada al contenedor donde se encuentra nuesta aplicacion. El comando para saber cual es el id de nuestro contenedor es el siguiente `docker ps` y de aqui buscamos el contenedor con el nombre `cipher-api-test-app` copiamos el id que vemos ahi y lo pegamos en el comando para acceder a la consola del proyecto.

Una vez en la consola de docker ejecutamos los siguientes comandos.

`php artisan key:generate`

Esto para configurar nuestra variable de entorno `APP_KEY`.

`php artisan migrate --seed`

Esto para crear nuestras tablas en la base de datos y rellenarlas con data de prueba.

Luego de esto podemos o bien importar los archivos de las colecciones con los endpoints a Insonmnia (ubicados en la raiz de el proyecto) para comenzar a probar nuestar API o utilizar el comando `php artisan test` para ejecutar los test de la aplicacion y verificar que todo funciona como deberia.