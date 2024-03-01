
CREATE TABLE Empleado (
    id_empleado INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Usuario VARCHAR(50),
    tipo_usuario VARCHAR(50),
    id_proyecto INT,
    FOREIGN KEY (id_proyecto) REFERENCES Proyecto(idproyecto)
);

CREATE TABLE Proyecto (
    idproyecto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50)
);
