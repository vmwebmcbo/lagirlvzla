<?php
    include 'db_connection.php';
    class Manager{
        //-----Productos--------
        //-- P --- Get All Products From Database
        function getProducts(){
            $query     = 'SELECT producto.id_producto,
                                 producto.nombre,
                                 producto.nombre_us,
                                 producto.descripcion,
                                 producto.descripcion_us,
                                 categoria.nombre as categoria,
                                 categoria.nombre_us as categoria_us,
                                 producto.precio,
                                 producto.imagen,
                                 producto.stock,
                                 producto.pos_pagina
                                 FROM producto
                         INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria
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
        function updateProducto($_idProduct, $_nombre, $_nombre_us, $_descripcion,$_descripcion_us, $_precio, $_imagen, $_stock, $_posPagina, $idCategoria){
            $query = 'UPDATE producto SET
                      nombre         = ?,
                      nombre_us      = ?,
                      descripcion    = ?,
                      descripcion_us = ?,
                      precio         = ?,
                      imagen         = ?,
                      stock          = ?,
                      pos_pagina     = ?,
                      id_categoria   = ?
                      WHERE id_producto = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre,$_nombre_us,$_descripcion, $_descripcion_us, $_precio,$_imagen,$_stock,$_posPagina,$idCategoria,$_idProduct));
            return $stmt;
        }
        function updateProductoStock($_idProduct, $_stock){
            $query = 'UPDATE producto SET
                      stock       = ?
                      WHERE id_producto = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_stock,$_idProduct));
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
        //-- P --- Insert a Product
        function insertProducto($_nombre, $_nombre_us, $_descripcion, $_descripcion_us,  $_precio, $_imagen, $_stock, $_posPagina, $idCategoria){
            $query = "INSERT INTO producto(
                                  nombre        ,
                                  nombre_us     ,
                                  descripcion   ,
                                  descripcion_us,
                                  precio        ,
                                  imagen        ,
                                  stock         ,
                                  pos_pagina    ,
                                  id_categoria) VALUES (?,?,?,?,?,?,?,?,?);";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre,$_nombre_us,$_descripcion, $_descripcion_us,$_precio,$_imagen,$_stock,$_posPagina,$idCategoria));
            return $stmt;
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
        function updateCategoria($_idCategoria, $_nombre, $_nombre_us, $_imagen){
            $query = 'UPDATE categoria SET
                      nombre           = ?,
                      nombre_us        = ?,
                      imagen_categoria = ?
                      WHERE id_categoria = ?;';
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_nombre_us, $_imagen,$_idCategoria));
            return $stmt;
        }
        //-- C --- Insert a Category
        function insertCategoria($_nombre, $_nombre_us, $_imagen){
            $query = "INSERT INTO categoria(nombre, nombre_us, imagen_categoria) VALUES (?, ?, ?);";
            $stmt = OpenCon() -> prepare($query);
            $stmt -> execute(array($_nombre, $_nombre_us, $_imagen));
            return $stmt;
        }
        //--------Config_Principal------
        /* Config - getConfigPagina*/
        function getConfigPagina($_idPagina){
          $query  = 'SELECT * FROM config_pagina WHERE id_pagina = ?;';
          $stmt = OpenCon() -> prepare($query);
          $stmt -> execute(array($_idPagina));
          return $stmt;
        }
        /* Config - updateConfig */
        function updateConfigPagina($_id_pagina,$_titulo_pagina, $_titulo_pagina1, $_btn_pagina, $_btn_pagina1, $_img_pagina, $_aboutus_title, $_aboutus_title1, $_aboutus_descrip, $_aboutus_descrip1, $_aboutus_image, $_color_title, $_color_ppl_btn, $_color_second_btn){
          $query = "UPDATE config_pagina SET
                    titulo_pagina   = ?,
                    titulo_pagina1  = ?,
                    btn_pagina      = ?,
                    btn_pagina1     = ?,
                    img_pagina      = ?,
                    aboutus_title   = ?,
                    aboutus_title1  = ?,
                    aboutus_descrip = ?,
                    aboutus_descrip1= ?,
                    image_aboutus   = ?,
                    color_title     = ?,
                    color_ppl_btn   = ?,
                    color_second_btn= ?
                    WHERE id_pagina = ?;";
          $stmt = OpenCon() -> prepare($query);
          $stmt -> execute(array($_titulo_pagina,
                                 $_titulo_pagina1,
                                 $_btn_pagina,
                                 $_btn_pagina1,
                                 $_img_pagina,
                                 $_aboutus_title,
                                 $_aboutus_title1,
                                 $_aboutus_descrip,
                                 $_aboutus_descrip1,
                                 $_aboutus_image,
                                 $_color_title,
                                 $_color_ppl_btn,
                                 $_color_second_btn,
                                 $_id_pagina
                               ));
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
    }
?>
