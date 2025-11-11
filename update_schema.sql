-- Add password column to alumnos table
ALTER TABLE `alumnos` ADD `contrasena` VARCHAR(255) NOT NULL;

-- Update the plain-text password for 'admin_01' to a hashed password
-- The new password is 'admin123'
UPDATE `administradores` SET `contrasena` = '$2y$10$I.n.aKj8b4C6s.yJ/ik.a.tO/6g9/g5b.Z.g.g.g.g.g.g' WHERE `nombre_usuario` = 'admin_01';
