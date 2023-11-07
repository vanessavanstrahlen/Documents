
# Tecnologías utilizadas
PHP
JavaScript
Vue.js
MYSQL
Bootstrap 4
Arquitectura MVC



# Credenciales de inicio de sesión:
# Usuario
PruebaT
# Contraseña
Prueba611

## Indicaciones de instalación

Para instalar y empezar a utilizar el sistema debe: 

1. Tener instalado Node.js
2. Tener un servidor web local multiplataforma que permita la creación y prueba de páginas web u otros elementos de programación. Por ejemplo: XAMPP
3. Agregar la carpeta del proyecto siguiendo la ruta -> C:\xampp\htdocs
4. Activar las opciones de Apache y MySQL del XAMPP
5. Importar la base de datos en PHPMYADMIN con el nombre `documents`
6. Ejecutar el proyecto. Ejemplo: `http://localhost/Documents/`

# NOTA: EN CASO DE QUE EL SERVIDOR TENGA UN PUERTO DIFERENTE, DEBE SER AGREGADO/EDITADO EN EL LLAMADO DE LAS APIS.




## Configuración de la Base de Datos

Para configurar y utilizar la base de datos en este proyecto, debe:

1. **Ubicación de la Base de Datos**:
   - La base de datos se encuentra en el archivo  llamado `documents.sql`.
   - Puedes encontrar este archivo en la carpeta `public/database/documents.sql`.

2. **Importar la Base de Datos**:
   - Abre tu cliente MySQL o phpMyAdmin.
   - Crea una nueva base de datos si es necesario, o utiliza una existente.
   - Importa el archivo SQL `documents.sql` en la base de datos que hayas creado.

3. **Configuración del Archivo `Database.php`**:
   - En la carpeta `app/db/database.php`, encontrarás un archivo llamado `Database.php`.
   - Abre este archivo en un editor de texto.

4. **Modificar la Configuración**:
   - Busca las variables relacionadas con la conexión a la base de datos, como `host`, `dbname` `username`, `password`.
   - Ajusta estas variables según tus configuraciones locales de MySQL. Puedes cambiar `localhost` por la dirección de tu servidor de base de datos y proporcionar el nombre de usuario y contraseña adecuados.

5. **Guardar Cambios**:
   - Después de realizar las modificaciones necesarias, guarda el archivo `database.php`.

6. **Verificar la Conexión**:
   - Asegúrate de que la aplicación pueda conectarse correctamente a la base de datos ejecutando la aplicación y verificando que no haya errores de conexión.

Al seguir estos pasos, podrás configurar y utilizar la base de datos en tu entorno local. Asegúrate de actualizar las credenciales de la base de datos en el archivo `database.php` si cambian en el futuro.









