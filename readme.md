## Instrucciones para Ejecutar el Proyecto

1. **Clonar el Repositorio**

   Clona este repositorio en tu máquina local.

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_REPOSITORIO>
   ```

2. **Construir y Levantar los Contenedores**

   Usa Docker Compose para construir y levantar los contenedores.

   ```bash
   docker-compose up --build
   ```

3. **Acceder a la Aplicación**

   Abre tu navegador y accede a la URL:

   ```
   http://localhost:8080
   ```

## Funcionalidades

- **Agregar Tarea:** Permite agregar una nueva tarea con una descripción.
- **Actualizar Estado:** Cambia el estado de una tarea entre "Por hacer", "En progreso" y "Completada".
- **Eliminar Tarea:** Elimina una tarea de la lista.

## Notas

- Las tareas se almacenan en la sesión del navegador, por lo que se perderán al cerrar el navegador o reiniciar el servidor.
- El proyecto utiliza un contenedor Docker con PHP 7.4 y Apache.

