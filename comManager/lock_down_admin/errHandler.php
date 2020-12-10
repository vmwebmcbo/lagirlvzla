<?php
    class ErrorHandler{
        function succHandler($_SUCCCODE){
            switch ($_SUCCCODE) {
                case 1:
                  echo '<script> alert("El Producto ha sido eliminado con exito")</script>';
                break;
                case 2:
                  echo '<script> alert("El Producto ha sido Insertado con exito")</script>';
                break;
                case 3:
                  echo '<script> alert("Su Categoria ha sido Eliminada con exito")</script>';
                break;
                case 4:
                  echo '<script> alert("Su Categoria ha sido Editada con exito")</script>';
                break;
                case 5:
                  echo '<script> alert("Su Producto ha sido Editado con exito")</script>';
                break;
                case 6:
                  echo '<script> alert("Su Categoria ha sido Insertada con exito")</script>';
                break;
                case 7:
                  echo '<script> alert("Su Configuracion ha sido guardada con exito")</script>';
                break;
                default:
                  echo '<script> alert("Ocurrio un Error inesperado")</script>';
                  break;
              }
        }
        function errHandler($_ERRHANDLER){
            switch ($_ERRHANDLER) {
                case 1:
                  echo '<script> alert("Ocurrio un error al eliminar el producto")</script>';
                break;
                case 2:
                  echo '<script> alert("Ocurrio un error al editar el producto")</script>';
                break;
                case 3:
                  echo '<script> alert("Ocurrio un error al insertar el producto")</script>';
                break;
                case 4:
                  echo '<script> alert("Ocurrio un error al eliminar la Categoria")</script>';
                break;
                case 5:
                  echo '<script> alert("Ocurrio un error al editar la Categoria")</script>';
                break;
                case 6:
                  echo '<script> alert("Ocurrio un error al insertar la Categoria")</script>';
                break;
                case 7:
                  echo '<script> alert("Ocurrio un error al guardar su configuracion")</script>';
                break;
                case 8:
                  echo '<script> alert("Debes Asegurarte que tu titulo sea menor a 40 caracteres")</script>';
                break;
                case 9:
                  echo '<script> alert("Debes Asegurarte que tu descripcion sea menor a 500 caracteres")</script>';
                break;
                case 10:
                  echo '<script> alert("Ocurrio un error al subir las imagenes")</script>';
                break;
                case 11:
                  echo '<script> alert("Debes seleccionar un producto válido")</script>';
                break; 
                case 12:
                  echo '<script> alert("No se encontró una configuración válida")</script>';
                break; 
                case 13:
                  echo '<script> alert("Debes seleccionar una categoria válida")</script>';
                break;
                case 14:
                  return 'Lo siento, no contamos con el stock suficiente para cumplir con su demanda! Puede contactarnos para obtener información detallada';
                break;
                default:
                  echo '<script> alert("Ocurrio un Error inesperado")</script>';
                break;
              }
        }
    }
?>
