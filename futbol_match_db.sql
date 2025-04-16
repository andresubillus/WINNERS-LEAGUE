-- Crear base de datos
CREATE DATABASE futbol_match_db;

-- Seleccionar la base de datos
USE futbol_match_db;

-- Tabla equipos
CREATE TABLE equipos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  password CHAR(64) NOT NULL,
  edad_min INT NOT NULL,
  edad_max INT NOT NULL,
  victorias INT DEFAULT 0,
  derrotas INT DEFAULT 0,
  distrito VARCHAR(100),
  rango VARCHAR(50),
  jugadores TEXT,
  celular VARCHAR(20) -- Nueva columna celular para almacenar números de teléfono
);

-- Insertar equipos con contraseñas (debes aplicar hash SHA-256 desde backend)
INSERT INTO equipos (nombre, password, edad_min, edad_max, victorias, derrotas, distrito, rango, jugadores, celular) VALUES
('Team1', '1234', 17, 20, 2, 0, 'Comas', '17-20', '7 jugadores', '987654321'),
('Team2', '1234', 17, 22, 1, 1, 'Comas', '17-22', '7 jugadores', '987654322'),
('Team3', '1234', 17, 25, 1, 2, 'Los Olivos', '17-25', '7 jugadores', '987654323'),
('andres', '1234', 17, 25, 1, 2, 'Comas', '17-25', '7 jugadores', '987654323'),
('anyelo', '1234', 17, 25, 1, 2, 'Los Olivos', '17-25', '7 jugadores', '987654323'),
('Team4', '1234', 17, 20, 0, 2, 'Los Olivos', '17-20', '7 jugadores', '987654324');

-- Tabla invitaciones (sin cambios)
CREATE TABLE invitaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  equipo_envia VARCHAR(50) NOT NULL,
  equipo_recibe VARCHAR(50) NOT NULL,
  fecha_envio DATETIME DEFAULT NOW(),
  estado VARCHAR(20) DEFAULT 'pendiente'
);

-- Tabla notificaciones (sin cambios)
CREATE TABLE notificaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  equipo_destino VARCHAR(100),
  mensaje TEXT,
  leido TINYINT(1) DEFAULT 0
);

-- Tabla mensajes (sin cambios)
CREATE TABLE mensajes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  emisor VARCHAR(50),
  receptor VARCHAR(50),
  mensaje TEXT,
  fecha_envio DATETIME DEFAULT NOW()
);

-- Tabla partidos (sin cambios)
CREATE TABLE partidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  de_equipo VARCHAR(50) NOT NULL,
  para_equipo VARCHAR(50) NOT NULL,
  estado VARCHAR(20) DEFAULT 'pendiente',
  fecha DATETIME DEFAULT NOW()
);

-- Insertar partidos
INSERT INTO partidos (de_equipo, para_equipo, estado) VALUES ('andres', 'anyelo', 'aceptado');
INSERT INTO partidos (de_equipo, para_equipo, estado) VALUES ('Team1', 'Team2', 'aceptado');
