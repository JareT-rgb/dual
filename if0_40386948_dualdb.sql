

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


CREATE TABLE registro_alumnos (
    id_registro INT PRIMARY KEY AUTO_INCREMENT,
    id_alumno INT UNIQUE NOT NULL, 
    id_empresa INT NOT NULL,     
    puesto VARCHAR(100),
    fecha_inicio DATE NOT NULL,
    fecha_salida DATE,
    
    FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
);


CREATE TABLE administradores (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    id_empresa INT,
    id_alumno INT,
    
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa),
    FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno)
);


INSERT INTO administradores (nombre_usuario, contrasena) VALUES ('admin_01', 'admin123');