# m7-shop

Pasos para probar el proyecto:

1. Ejecutar el script SQL llamado "m7-shop.sql"

  - Para hacerlo desde la consola de MySQL , usar el comando "source m7-shop.sql"
  - Si es desde XAMPP , copiar el contenido del archivo y pegarlo en la pestaña "SQL" de PHPMyAdmin
  
2. En caso de no usar las credenciales que vienen por defecto en XAMPP para MySQL , se deberá modificar el archivo "dbConfig.php" ubicado en ./db , modificando los métodos
   getConnection() y getPDOConnection() con las credenciales que se usen en MySQL.
   

Otra anotaciones sobre el proyecto:

 - El mapa muestra los markers de las coordenadas especificadas con la dirección a la hora de registrarse , lo hice así ya que no le veo sentido ponerle coordenadas a los productos.
 - En caso de tener problemas con las imágenes (que no se muestran) a la hora de ver los productos , revisar si está creada la carpeta "products" dentro de ./img.
