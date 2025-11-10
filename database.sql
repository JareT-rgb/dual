CREATE DATABASE IF NOT EXISTS dual_db;
USE dual_db;

-- Drop tables if they exist to start with a clean slate
DROP TABLE IF EXISTS registro_alumnos;
DROP TABLE IF EXISTS administradores;
DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS empresas;

-- Tabla de Empresas
CREATE TABLE empresas (
    id_empresa INT PRIMARY KEY AUTO_INCREMENT,
    razon_social VARCHAR(255) NOT NULL,
    rfc VARCHAR(13) UNIQUE NOT NULL,
    giro_empresa VARCHAR(255),
    direccion VARCHAR(255),
    dato_contacto VARCHAR(255),
    telefono_contacto VARCHAR(20),
    telefono_empresa VARCHAR(20),
    perfil_alumno TEXT
);

-- Tabla de Alumnos
CREATE TABLE alumnos (
    id_alumno INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    ap_paterno VARCHAR(100) NOT NULL,
    ap_materno VARCHAR(100),
    correo VARCHAR(255) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    rfc VARCHAR(13) UNIQUE,
    direccion VARCHAR(255),
    N_control VARCHAR(20) UNIQUE NOT NULL,
    carrera VARCHAR(100),
    semestre INT,
    turno VARCHAR(50)
);

-- Tabla de Administradores
CREATE TABLE administradores (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    id_empresa INT,
    id_alumno INT,
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa),
    FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno)
);

-- Tabla de Registro de Alumnos en Empresas
CREATE TABLE registro_alumnos (
    id_registro INT PRIMARY KEY AUTO_INCREMENT,
    id_alumno INT UNIQUE,
    nombre VARCHAR(100),
    ap_paterno VARCHAR(100),
    ap_materno VARCHAR(100),
    carrera VARCHAR(100),
    semestre INT,
    empresa_seleccionada VARCHAR(255),
    puesto VARCHAR(100),
    fecha_inicio DATE,
    fecha_salida DATE,
    FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno)
);
