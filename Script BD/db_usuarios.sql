-- Eliminar las tablas si existen
DROP DATABASE IF EXISTS db_usuarios;

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS db_usuarios;

-- Seleccionar la base de datos
USE db_usuarios;

-- Crear la tabla clientes
CREATE TABLE clientes (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100),
    Correo VARCHAR(100),
    Telefono VARCHAR(15),
    Direccion TEXT,
    Fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_email CHECK (Correo LIKE '%_@__%.__%') -- Validación simple de formato de correo
);

-- Crear la tabla clientes_eliminados
CREATE TABLE clientes_eliminados (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100),
    Correo VARCHAR(100),
    Telefono VARCHAR(15),
    Direccion TEXT,
    Fecha_eliminacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla administradores para autenticación
CREATE TABLE administradores (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(50) UNIQUE NOT NULL,
    Correo VARCHAR(100) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL, -- Se recomienda almacenar encriptada con HASH
    Fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_email_admin CHECK (Correo LIKE '%_@__%.__%') -- Validación de correo
);

-- Insertar 20 usuarios en la tabla clientes
INSERT INTO clientes (Nombre, Correo, Telefono, Direccion)
VALUES
('Juan Pérez', 'juan.perez@mail.com', '0998765432', 'Av. Siempre Viva 123, Quito'),
('Ana García', 'ana.garcia@mail.com', '0987654321', 'Calle Falsa 456, Guayaquil'),
('Carlos López', 'carlos.lopez@mail.com', '0976543210', 'Av. Quito 789, Cuenca'),
('María Rodríguez', 'maria.rodriguez@mail.com', '0965432109', 'Calle Real 321, Loja'),
('José Martínez', 'jose.martinez@mail.com', '0954321098', 'Av. 10 de Agosto 654, Ambato'),
('Laura Fernández', 'laura.fernandez@mail.com', '0943210987', 'Calle Cero 987, Manta'),
('Pedro González', 'pedro.gonzalez@mail.com', '0932109876', 'Av. 24 de Mayo 432, Machala'),
('Isabel Ramírez', 'isabel.ramirez@mail.com', '0921098765', 'Calle La Paz 654, Ibarra'),
('Luis Sánchez', 'luis.sanchez@mail.com', '0910987654', 'Av. Rumiñahui 876, Esmeraldas'),
('Marta Ruiz', 'marta.ruiz@mail.com', '0909876543', 'Calle San Francisco 210, Quito'),
('David Pérez', 'david.perez@mail.com', '0998765431', 'Av. San Juan 432, Ambato'),
('Sofía Torres', 'sofia.torres@mail.com', '0987654320', 'Calle Córdova 765, Guayaquil'),
('Miguel Álvarez', 'miguel.alvarez@mail.com', '0976543209', 'Av. Los Olivos 876, Cuenca'),
('Beatriz Hernández', 'beatriz.hernandez@mail.com', '0965432098', 'Calle Colón 432, Loja'),
('Antonio Díaz', 'antonio.diaz@mail.com', '0954320987', 'Av. De la República 543, Machala'),
('Clara Gómez', 'clara.gomez@mail.com', '0943210876', 'Calle Manuela Sáenz 654, Manta'),
('Raúl Castro', 'raul.castro@mail.com', '0932109765', 'Av. La Gran Colombia 765, Ibarra'),
('Lucía Romero', 'lucia.romero@mail.com', '0921098654', 'Calle Bolívar 876, Esmeraldas'),
('Javier Pérez', 'javier.perez@mail.com', '0910987543', 'Av. El Sol 987, Quito'),
('Mariana Díaz', 'mariana.diaz@mail.com', '0909876432', 'Calle Pichincha 432, Ambato');

-- Insertar administradores de prueba (contraseña sin hash solo para ejemplo)
INSERT INTO administradores (Usuario, Correo, Contrasena)
VALUES
('cagy', 'cagy@mail.com', '123'),  -- Se recomienda usar HASH en la aplicación
('admin2', 'admin2@mail.com', 'admin456'),
('mela', 'mela@mail.com', '061222');

SELECT * FROM clientes;

