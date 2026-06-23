CREATE DATABASE sistema_crud;

USE sistema_crud;



CREATE TABLE usuarios (

  id INT AUTO_INCREMENT PRIMARY KEY,

  username VARCHAR(50) UNIQUE NOT NULL,

  email VARCHAR(100) UNIQUE NOT NULL,

  password VARCHAR(255) NOT NULL,

  rol ENUM('administrador', 'empleado') NOT NULL

);


CREATE TABLE clientes (

  codCliente CHAR(5) PRIMARY KEY,

  nombre VARCHAR(50) NOT NULL,

  ruc VARCHAR(11) NOT NULL,

  telefono VARCHAR(9) NOT NULL

 

);

CREATE TABLE Proyectos (

  codProyecto INT AUTO_INCREMENT PRIMARY KEY,

  nombre_proyecto VARCHAR(100) NOT NULL,

  estado VARCHAR(50) NOT NULL,

  tareas varchar(100) NOT NULL,

  idCliente char(5) NOT NULL,

  foreign key (idCliente) references clientes(codCliente)

);

INSERT INTO clientes (codCliente, nombre, ruc, telefono) VALUES

('C001', 'Empresa Alpha', '20123456789', '987654321'),

('C002', 'Compañía Beta', '20198765432', '912345678'),

('C003', 'Corporación Gamma', '20187654321', '923456789');

INSERT INTO Proyectos (nombre_proyecto, estado, tareas, idCliente) VALUES

('Proyecto A', 'En Progreso', 'Tarea 1, Tarea 2', 'C001'),

('Proyecto B', 'Completado', 'Tarea 3, Tarea 4', 'C002'),

('Proyecto C', 'Pendiente', 'Tarea 5, Tarea 6', 'C003');