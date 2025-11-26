-- Parche para establecer el password como TestTest1.
DROP TABLE IF EXISTS usuario_sistema;
DROP TABLE IF EXISTS rol;

CREATE TABLE `rol` (
                       `id_rol` int NOT NULL,
                       `rol` varchar(255) DEFAULT NULL,
                       `descripcion_en` text,
                       `descripcion_es` text,
                       `orden` int DEFAULT NULL,
                       `seccion_ini` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `descripcion_en`, `descripcion_es`, `orden`, `seccion_ini`) VALUES
                                                                                                    (1, 'Administrator', 'Can access without restrictions. Can manage all the data of the application including master data tables.', 'Acceso a toda la aplicación.\r\nLa única  restricción es que no pueden modificar el usuario  superadmin.', 3, 'users'),
                                                                                                    (2, 'Auditor', 'Can access and edit all the data of the his organisation users. Can view and edit all the financial data of the organisation. ', 'Permisos de lectura en Usuarios sistema, Categorias, Proveedores, Productos.', 1, 'users'),
                                                                                                    (3, 'Facturación', 'Only can edit his own data and his input hours.', 'Permisos de lectura, escritura y borrado en Proveedores y Productos.', NULL, 'jobs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sistema`
--

CREATE TABLE `usuario_sistema` (
                                   `id_usuario` int NOT NULL,
                                   `id_rol` int NOT NULL,
                                   `email` varchar(255) NOT NULL,
                                   `pass` varchar(255) NOT NULL,
                                   `nombre` varchar(255) NOT NULL,
                                   `last_date` datetime DEFAULT NULL,
                                   `idioma` char(2) NOT NULL DEFAULT 'es',
                                   `baja` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario_sistema`
--

INSERT INTO `usuario_sistema` (`id_usuario`, `id_rol`, `email`, `pass`, `nombre`, `last_date`, `idioma`, `baja`) VALUES
                                                                                                                     (1, 1, 'admin@test.org', '$2y$10$B60aaklpzlKcOfYFgyZ3dORA5DuC/NQ/KPeYH3GPApASoxR4sVfj2', 'Administrador', '2021-09-11 18:36:42', 'es', 0),
                                                                                                                     (93, 2, 'auditor@test.org', '$2y$10$r6alHKkMSIhbHXPhBJI2SO8SnW5UKnnq1pzj0sPxiiFbXKjjPBxOS', 'Auditor', NULL, 'es', 0),
                                                                                                                     (94, 3, 'facturacion@test.org', '$2y$10$xkT.DsE6LmsBvmdovdt0lu03doqOnaaDLp40W8W52zZGOQiQDloWS', 'Facturacion', NULL, 'es', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
    ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
    ADD PRIMARY KEY (`id_usuario`),
    ADD UNIQUE KEY `email` (`email`),
    ADD KEY `FK_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
    MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
    MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
    ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;

