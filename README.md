# Api Rest Symphony

En este proyecto se encuentra una pequeña API Rest implementada en symphony que es un framework que utiliza PHP.

Este proyecto tiene dos entidades que son Propiedad y Tour. Un tour esta formado por una propiedad y nos indica si esta activo. Una propiedad incluye la información de su título y su descripción.
    
**Esta API REST tiene las funcionalidades siguientes:**

  - Añadir una propiedad. 
  - Modificar una propiedad.
  - Añadir un Tour.
  - Añadir una propiedad.

## Comenzando 🚀

Descargar el tar/zip del proyecto en local o hacer un git clone del proyecto.
Para poder ejecutarlo en una consola utilizar el comando siguiente:

```
 symfony server:start
```

### Pre-requisitos 📋

**Antes de ejecutar el proyecto se debe haber instalado lo siguiente:**

  - Symphony.
  - PHP
  - Postman.
  - Mysql.


### Instalación 🔧


**Para instalar los programas o framework comentados anteriormente dirigirse a :**

  - Symphony :https://symfony.com/download.
  - PHP :https://www.php.net/manual/es/install.windows.legacy.index.php.
  - Postman : https://www.postman.com/downloads/.
  - Mysql : https://dev.mysql.com/downloads/workbench/.




Despues de instalar, una vez abierto el proyecto se debe cambiar la variable de la base de datos por la que se se esta utilizando.
Esta variable se encuentra en :  C:\APIfloorfy\.env

```
 DATABASE_URL="mysql://User:Password@127.0.0.1:3308/SchemaBD?serverVersion=5.7"

```

Seguidamente crear las entidades en la base de datos para poder hacer las llamadas y que se modique la bd.Estos comando se ejecutaran dentro del proyecto y por terminal. Los comandos son los siguiente:

```
 php bin/console make:migration
 php bin/console doctrine:migrations:migrate

```

## Ejecutando las pruebas ⚙️

Para verificar que funciona las llamadas correctamente se utilizara el postman. Mediante el se haran las llamadas utilizando un JSON. En los siguientes paragrafos se pueden encontrar ejemplos que se pueden utilizar para cada llamada.

/property/add

```
{
    'Titulo' : 'Cada Pedralbes',
    'Descripción' : 'Casa amplia con grandes ventanas'
}

```

/property/update

```
{
    'id' : 1,
    'Titulo' : 'Cada Pedralbes',
    'Descripción' : 'Casa amplia con jardín'
    
}

```

/tour/add

```
{
    'Action' : true,
    'idinmueble': 1
}

```

/tour/update

```
{
    'id':1,
    'Action' : false,
    'idinmueble': 1
    
}

```



