<?php
    include 'db_connection.php';
    class Manager{
        //-----Productos--------
        //-- P --- Get All Products From Database
        function getProducts(){
            $query     = 'SELECT producto.id_producto,
                                 producto.nombre,
                                 producto.descripcion,
                                 categoria.nombre as categoria,
                                 producto.precio,
                                 producto.imagen,
                                 producto.pos_pagina,
                                 producto.mostrar
                                 FROM producto
                         INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria
                         ORDER BY producto.id_producto ASC;';
            return $query;
        }
        function getProductsEnExistencia(){
            $query     = 'SELECT producto.id_producto,
                                 producto.nombre,
                                 producto.descripcion,
                                 categoria.nombre as categoria,
                                 producto.precio,
                                 producto.imagen,
                                 producto.pos_pagina,
                                 producto.mostrar
                                 FROM producto
                         INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria
                         WHERE mostrar = 1
                         ORDER BY producto.id_producto ASC;';
            return $query;
        }
        //-- P --- Get Just One Product
        function getProducto($_idProduct){
            $query  = 'SELECT * FROM producto WHERE id_producto = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idProduct));
            return $stmt;
        }
        //-- P --- Update some Product
        function updateProducto($_idProduct, $_nombre, $_descripcion, $_precio, $_imagen, $_posPagina, $idCategoria, $_mostrar){
            $query = 'UPDATE producto SET
                      nombre         = ?,
                      descripcion    = ?,
                      precio         = ?,
                      imagen         = ?,
                      pos_pagina     = ?,
                      id_categoria   = ?,
                      mostrar        = ?
                      WHERE id_producto = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre,$_descripcion, $_precio,$_imagen,$_posPagina, $idCategoria, $_mostrar, $_idProduct));
            return $stmt;
        }
        //-- P --- Delete some Product
        function deleteProducto($_idProduct){
            $query = 'DELETE FROM producto WHERE id_producto = ?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idProduct));
            return $stmt;
        }
        //-- P --- Delete Products By Category already deleted
        function deleteProductByCategory($_idCategoria){
            $query = 'DELETE FROM producto WHERE id_categoria =?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idCategoria));
            return $stmt;
        }
        //-- P --- Delete Products By SubCategory already deleted
        function deleteProductBySubCategory($_idSubCategoria){
            $query = 'DELETE FROM producto WHERE id_subcategoria =?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idSubCategoria));
            return $stmt;
        }
        //-- P --- Insert a Product
        function insertProducto($_nombre, $_descripcion, $_precio, $_imagen, $_posPagina, $idCategoria, $_mostrar){
            $query = "INSERT INTO producto(
                                  nombre         ,
                                  descripcion    ,
                                  precio         ,
                                  imagen         ,
                                  pos_pagina     ,
                                  id_categoria   ,
                                  mostrar) VALUES (?,?,?,?,?,?,?);";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre,$_descripcion,$_precio,$_imagen,$_posPagina, $idCategoria, $_mostrar));
            return $stmt;
        }

        //-- TP --- Insert Tono Product
        function insertTonoProducto($_nombre, $_imagen_color, $_id_producto, $_mostrar){
            $query = "INSERT INTO tipo_producto(
                                    nombre      ,
                                    imagen_color,
                                    mostrar,
                                    id_producto) VALUES (?,?,?,?);";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_imagen_color, $_mostrar, $_id_producto));
            return $stmt;
        }
        //-- TP --- Update Tono Product
        function updateTonoProducto($_nombre, $_imagen_color, $_id_producto, $_id_tproduct, $_mostrar){
            $query = "UPDATE tipo_producto SET
                      nombre       = ?,
                      imagen_color = ?,
                      id_producto  = ?,
                      mostrar      = ?
                      WHERE id_tproducto = ?;
                     ";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_imagen_color, $_id_producto, $_mostrar, $_id_tproduct));
            return $stmt;
        }
        //-- TP --- Select Tono Product
        function getTonoProducto($_id_producto){
            $query  = 'SELECT * FROM tipo_producto WHERE id_producto = '.$_id_producto.';';
            return $query;
        }
        function getTonoProductoEnExistencia($_id_producto){
            $query  = 'SELECT * FROM tipo_producto WHERE id_producto = '.$_id_producto.' AND mostrar = 1;';
            return $query;
        }
        //-- TP --- Select One Tono Product
        function getSomeTonoProducto($_id_tproducto){
            $query  = 'SELECT * FROM tipo_producto WHERE id_tproducto = '.$_id_tproducto.';';
            return $query;
        }
        function deleteTonoProducto($_id_tproducto){
            $query = 'DELETE FROM tipo_producto WHERE id_tproducto = ?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_id_tproducto));
            return $query;
        }


        //----------Categorias-------------
        //-- C --- Get All Categories
        function getCategorias(){
            $query = "SELECT * FROM categoria ORDER BY id_categoria ASC";
            return $query;
        }
        //-- C --- Delete some Category
        function deleteCategoria($_idCategoria){
            $query = 'DELETE FROM categoria WHERE id_categoria = ?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idCategoria));
            return $stmt;
        }
        //-- C --- Get Some Category
        function getCategoria($_idCategoria){
            $query  = 'SELECT * FROM categoria WHERE id_categoria = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idCategoria));
            return $stmt;
        }
        //-- C --- Update Some Category
        function updateCategoria($_idCategoria, $_nombre, $_imagen){
            $query = 'UPDATE categoria SET
                      nombre           = ?,
                      imagen_categoria = ?
                      WHERE id_categoria = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_imagen, $_idCategoria));
            return $stmt;
        }
        //-- C --- Insert a Category
        function insertCategoria($_nombre, $_imagen){
            $query = "INSERT INTO categoria(nombre, imagen_categoria) VALUES (?,?);";
            $stmt  = OpenCon() -> prepare($query);
            $stmt  -> execute(array($_nombre, $_imagen));
            return $stmt;
        }
        //--------Imagenes Inicio------
        /* Imagenes Incio - getImagenesInicio*/
        function getImagenesInicio(){
          $query  = 'SELECT * FROM imagen_inicio';
          return $query;
        }
        function getImagenInicio($_idImagen){
            $query = 'SELECT * FROM imagen_inicio WHERE id_imagen = ?';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idImagen));
            return $stmt;
        }
        /* Imagenes Inicio - insertImagenInicio */
        function insertImagenInicio($_imagen, $_link_imagen){
            $query = 'INSERT INTO imagen_inicio(imagen, link_imagen) VALUES (?, ?)';
            $stmt  = OpenCon() -> prepare($query);
            $stmt  -> execute(array($_imagen, $_link_imagen));
            return $stmt;
        }
        /* Imagenes Inicio - updateImagenInicio */
        function updateImagenInicio($_idImagen, $_imagen, $_link_imagen){
            $query = 'UPDATE imagen_inicio SET
                      imagen      = ?,
                      link_imagen = ?
                      WHERE id_imagen = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_imagen, $_link_imagen, $_idImagen));
            return $stmt;
        }
        /* Imagenes Inicio - deleteImagenInicio */
        function deleteImagenInicio($_idImagen){
            $query = 'DELETE FROM imagen_inicio WHERE id_imagen = ?';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idImagen));
            return $stmt;
        }
        /*-- Sub-Categoria --*/
        function getSubCategorias(){
            $query = "SELECT 
                        subcategoria.id_subcategoria,
                        subcategoria.nombre,
                        subcategoria.imagen
                        FROM subcategoria 
                        ORDER BY id_subcategoria ASC";
            return $query;
        }
        function insertSubCategoria($_nombre, $_imagen){
            $query = "INSERT INTO subcategoria(nombre, imagen) VALUES (?,?);";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_imagen));
            return $stmt;
        }
        function getSubCategoria($_idSubCategoria){
            $query  = 'SELECT 
                subcategoria.id_subcategoria,
                subcategoria.nombre,
                subcategoria.imagen
                FROM subcategoria 
                WHERE id_subcategoria = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idSubCategoria));
            return $stmt;
        }
        function updateSubCategoria($_idSubCategoria, $_nombre, $_imagen){
            $query = 'UPDATE subcategoria SET
                      nombre           = ?,
                      imagen           = ?
                      WHERE id_subcategoria = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_imagen, $_idSubCategoria));
            return $stmt;
        }
        function deleteSubCategoria($_idSubCategoria){
            $query = 'DELETE FROM subcategoria WHERE id_subcategoria = ?;';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_idSubCategoria));
            return $stmt;
        }
        /*-- Login ---*/
        function checkLogin($_user, $_pass){
            $hash_pass = hash('sha256', $_pass);
            $query = 'SELECT id_user FROM user_admin WHERE username = ? AND pass= ?;';
            $stmt      = OpenCon() -> prepare($query);
            $stmt -> execute(array($_user, $hash_pass)); 
            return $stmt;
        }
        function getUser($_user){
            $query = 'SELECT * FROM user_admin WHERE username = ?;';
            $stmt      = OpenCon() -> prepare($query);
            $stmt -> execute(array($_user)); 
            return $stmt;
        }
        /*-- Payments --*/
        //Currency
        function getCurrency(){
            $query = "SELECT * FROM monedas WHERE id_moneda = 1";
            return $query;
        }
        function updateCurrency($_currency){
            $query = "UPDATE monedas
                      SET currency = ?
                      WHERE id_moneda = 1  
                    ";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_currency));
            return $stmt;
        }
        //Currency final
        function loadPay($_nombre_cli, $_email_cli, $_telefono_cli,$_direccion_cli,  $_nombre_pay, $_referencia, $_metodo_pago, $_productos, $_total, $_fecha, $_estado, $_currency){
            $query = 'INSERT INTO pagos(nombre_cli,
                                        email_cli,
                                        telefono_cli,
                                        direccion_cli,
                                        nombre_pay,
                                        referencia,
                                        metodo_pago,
                                        productos,
                                        total,
                                        fecha,
                                        estado,
                                        currency) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre_cli, $_email_cli, $_telefono_cli, $_direccion_cli, $_nombre_pay, $_referencia, $_metodo_pago, $_productos, $_total, $_fecha, $_estado, $_currency));
            return $stmt;
        }
        function getPayments(){
            $query = "SELECT * FROM pagos ORDER BY fecha DESC";
            return $query;
        }
        function updatePayStatement($_id_pago, $_estado){
            $query = 'UPDATE pagos SET
                        estado = ?
                      WHERE id_pago = ?';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_estado, $_id_pago));
            return $stmt;
        }
        function updatePay($_id_pago, $_nombre_cli, $_email_cli, $_telefono_cli,$_direccion_cli,  $_nombre_pay, $_referencia, $_metodo_pago, $_estado, $_currency){
            $query = 'UPDATE pagos SET
                        nombre_cli   = ?,
                        email_cli    = ?,
                        telefono_cli = ?,
                        direccion_cli= ?,
                        nombre_pay   = ?,
                        referencia   = ?,
                        metodo_pago  = ?,
                        estado       = ?,
                        currency     = ?
                        WHERE id_pago = ?
            ';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array(
                $_nombre_cli   ,
                $_email_cli    ,
                $_telefono_cli ,
                $_direccion_cli,
                $_nombre_pay   ,
                $_referencia   ,
                $_metodo_pago  ,
                $_estado       , 
                $_currency     ,
                $_id_pago
            ));
            return $stmt;
        }
        function getPay($_id_pago){
            $query = 'SELECT * FROM pagos WHERE id_pago = ?';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_id_pago));
            return $stmt;
        }
        function deletePay($_id_pago){
            $query = 'DELETE FROM pagos WHERE id_pago = ?';
            $stmt  = OpenCon() -> prepare($query);
            $stmt  -> execute(array($_id_pago));
            return $stmt;
        }
        // Delivery
        function insertDelivery($_delivery_descri, $_delivery_precio){
            $query = 'INSERT INTO   delivery(delivery_descri,delivery_precio) VALUES (?,?)';
            $stmt  = OpenCon() -> prepare($query);
            $stmt -> execute(array($_delivery_descri, $_delivery_precio));
            return $stmt;
        }
        function getDeliveryZones(){
            $query = "SELECT * FROM delivery";
            return $query;
        }
        function deleteDelivery($_id_delivery){
            $query = 'DELETE FROM delivery WHERE id_delivery = ?';
            $stmt  = OpenCon() -> prepare($query);
            $stmt  -> execute(array($_id_delivery));
            return $stmt;
        }
        function updateDelivery($_id_delivery, $_delivery_descri, $_delivery_precio){
            $query = 'UPDATE delivery SET
                        delivery_descri = ?,
                        delivery_precio = ?
                        WHERE id_delivery = ?';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_delivery_descri, $_delivery_precio, $_id_delivery));
            return $stmt;
        }
    }
?>
