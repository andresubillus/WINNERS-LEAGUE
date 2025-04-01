-- Crear base de datos
CREATE DATABASE IF NOT EXISTS futbol_match_db;
USE futbol_match_db;

-- Tabla equipos con columnas corregidas y completas
CREATE TABLE equipos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  password CHAR(64) NOT NULL,
  edad_min INT(11) NOT NULL,
  edad_max INT(11) NOT NULL,
  victorias INT(11) DEFAULT 0,
  derrotas INT(11) DEFAULT 0,
  distrito VARCHAR(100),
  rango VARCHAR(50),
  jugadores TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar equipos con contraseñas hasheadas (SHA-256 de '1234')
INSERT INTO equipos (nombre, password, edad_min, edad_max, victorias, derrotas, distrito, rango, jugadores) VALUES
('Team 1', '1234', 17, 20, 2, 0, 'Comas', '17-20', '7 jugadores'),
('Team 2', '1234', 17, 22, 1, 1, 'Comas', '17-22', '7 jugadores'),
('Team 3', '1234', 17, 25, 1, 2, 'Los Olivos', '17-25', '7 jugadores'),
('Team 4', '1234', 17, 20, 0, 2, 'Los Olivos', '17-20', '7 jugadores');


-- Tabla invitaciones
CREATE TABLE invitaciones (
  id INT(11) NOT NULL AUTO_INCREMENT,
  equipo_envia VARCHAR(50) NOT NULL,
  equipo_recibe VARCHAR(50) NOT NULL,
  fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
  estado VARCHAR(20) DEFAULT 'pendiente',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--tabla notificaciones
CREATE TABLE notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo_destino VARCHAR(100),
    mensaje TEXT,
    leido TINYINT(1) DEFAULT 0
);
