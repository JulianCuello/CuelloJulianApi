<?php
require_once 'config.php';
    class Model {
        protected $db;

        function __construct() {
            // Conexión al servidor MySQL sin especificar una base de datos
            $this->db = new PDO('mysql:host='. MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            // Crear la base de datos si no existe
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8 COLLATE utf8_general_ci");
            // Conectarse a la base de datos recién creada
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
          }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            $pass = '$2y$10$VREXc/mCCVwmfcEY5HtAneei9ak2RLmhciQTj.0U4K2BJ9ALR2PqK';
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                 
        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
        SET time_zone = "+00:00";

        CREATE TABLE `juguete` (
          `id_juguete` int(45) NOT NULL AUTO_INCREMENT,
          `nombreProducto` varchar(45) NOT NULL,
          `precio` int(45) NOT NULL,
          `material` varchar(45) NOT NULL,
          `id_marca` int(45) NOT NULL,
          `codigo` int(45) NOT NULL,
          PRIMARY KEY (`id_juguete`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        CREATE TABLE `marca` (
          `id_marca` int(45) NOT NULL AUTO_INCREMENT,
          `origen` varchar(45) NOT NULL,
          `img` varchar(45) NOT NULL,
          PRIMARY KEY (`id_marca`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Volcado de datos para la tabla `juguete`
        INSERT INTO `juguete` (`nombreProducto`, `precio`, `material`, `id_marca`, `codigo`) VALUES
        ('autos chiquitos', 4500, 'plastico', 1, 24141),
        ('cocina', 10500, 'acero', 2, 95124),
        ('dinosaurios', 7100, 'goma', 3, 451275),
        ('mario', 6000, 'plastico', 4, 68541);

        -- Volcado de datos para la tabla `marca`
        INSERT INTO `marca` (`origen`, `img`) VALUES
        ('china', 'img/autos'),
        ('argentina', 'img/cocina'),
        ('francia', 'img/dinosaurios'),
        ('brasil', 'img/mario');

        COMMIT;
                END;
                $this->db->query($sql);
            }
            
        }
    }