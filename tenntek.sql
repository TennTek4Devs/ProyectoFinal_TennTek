CREATE DATABASE IF NOT EXISTS tenntek;

USE tenntek;

/* Crea la entidad de Usuarios 'inicial' de la base de datos */
create TABLE IF NOT EXISTS usuario(
    id_user int(20) not null AUTO_INCREMENT,
    usuario varchar(60) not null UNIQUE,
    ci char (8) null UNIQUE,
    contrasena varchar(60) not null,
    nombre varchar(60) not null,
    apellido varchar(60) null,
    edad int(3) null,
    email varchar(60) not null UNIQUE,
    telefono varchar(60) null,
    tipo varchar(60) not null,
    rut varchar(15) null,

    primary key (id_user),
    constraint ck_edad_usuario check(edad >= 18 and edad <= 100),
    constraint ck_tipo_usuario check(tipo IN("empresa", "cliente", "empleado", "admin")),
    CONSTRAINT ck_ap_empresa CHECK (tipo <> "empresa" or apellido IS NULL),
    CONSTRAINT ck_edad_empresa CHECK (tipo <> "empresa" or edad IS NULL),
    CONSTRAINT ck_ci_empresa CHECK (tipo <> "empresa" or ci IS NULL),
    CONSTRAINT ck_ci_empleado CHECK (tipo <> "empleado" or ci IS NOT NULL),
    CONSTRAINT ck_ci_cliente CHECK (tipo <> "cliente" or ci IS NOT NULL),
    CONSTRAINT ck_ap_empleado CHECK (tipo <> "empleado" or apellido IS NOT NULL),
    CONSTRAINT ck_ap_cliente CHECK (tipo <> "cliente" or apellido IS NOT NULL)
);

/*<Categorizaciones de usuario>*/
create table IF NOT EXISTS cliente(
    id_user int (20) not null,
    
    primary key (id_user),
    foreign key (id_user) references usuario(id_user)
);

create table IF NOT EXISTS empresa(
    id_user int (20) not null,
    
    primary key (id_user),
    foreign key (id_user) references usuario(id_user)
);

create table IF NOT EXISTS empleado(
    id_user int (20) not null,
    funcion varchar (60) not null,
    estado varchar (60) not null,
    
    primary key (id_user),
    foreign key (id_user) references usuario(id_user),
    constraint ck_funcion_empleado check(funcion IN("conductorMion", "conductorNeta", "Funcionario"))
);
/*</Categorizaciones de usuario>*/


/*<Categorizaciones de empleado>*/
create table IF NOT EXISTS funcionario(
    id_user int (20) not null,
    cargo varchar (60) not null,
    
    primary key (id_user),
    foreign key (id_user) references empleado(id_user)
);

create table IF NOT EXISTS conductorMion(
    id_user int (20) not null,
    cargo varchar (60) not null,
    
    primary key (id_user),
    foreign key (id_user) references empleado(id_user)
);

create table IF NOT EXISTS conductorNeta(
    id_user int (20) not null,
    cargo varchar (60) not null,
    
    primary key (id_user),
    foreign key (id_user) references empleado(id_user)
);
/*</Categorizaciones de empleado>*/


/*<Entidades que Actuan como Vehiculo>*/
create table IF NOT EXISTS camion(
    matricula varchar (10) not null,
    estado varchar (60) not null,
    capacidad int (5) not null,
    marca varchar (60) not null,
    modelo varchar (60) not null,

    primary key (matricula),
    constraint ck_capacidad_camion check(capacidad >= 5000 and capacidad <= 15000)
);

create table IF NOT EXISTS camioneta(
    matricula varchar (10) not null,
    estado varchar (60) not null,
    capacidad int (5) not null,
    marca varchar (60) not null,
    modelo varchar (60) not null,
    
    primary key (matricula),
    constraint ck_capacidad_camioneta check(capacidad >= 1000 and capacidad <= 5000)
);
/*</Entidades que Actuan como Vehiculo>*/


/*<Etidades de almacen y ruta>*/
create table IF NOT EXISTS almacen(
    id_almacen int (20) not null AUTO_INCREMENT,
    nombre varchar (60) not null,
    direccion varchar (80) not null,
    cuidad varchar (60) not null,

    primary key (id_almacen)
);

create table IF NOT EXISTS ruta(
    id_ruta int (20) not null AUTO_INCREMENT,
    nombre varchar (60) null,

    primary key (id_ruta)
);
/*</Entidades de almacen y ruta>*/

/*<Entidades de Lotes y Paquetes>*/
create table IF NOT EXISTS lotes(
    id_lote int (20) not null AUTO_INCREMENT,
    id_almacen int (20) null,
    h_llegada datetime null,
    estado varchar (60) not null,
    nombre varchar (60) not null,

    primary key (id_lote),
    foreign key (id_almacen) references almacen(id_almacen)
);

create table IF NOT EXISTS paquete(
    id_paquete int (20) not null AUTO_INCREMENT,
    id_lote int(20) null, 
    id_user int (20) not null,
    ci char (8) not null,
    nombre varchar (60) not null,
    peso int (100) not null,
    ciudad varchar(60) not null,
    direccion varchar(80) not null,
    origen varchar (80) not null,
    mail varchar (60) null,
    telefono varchar (60) null,
    llegada_central datetime null,
    
    primary key (id_paquete),
    foreign key (id_lote) references lotes(id_lote),
    foreign key (id_user) references usuario(id_user)
);

/*</Entidades de Lotes y Paquetes>*/



/*<RELACIONES>*/

        /*<Relacion ruta:almacen>*/
        create table IF NOT EXISTS trayecta(
            id_ruta int(20) not null,
            id_almacen int(20) not null,
            orden int(10) not null,

            primary key (id_ruta, id_almacen),
            foreign key (id_ruta) references ruta(id_ruta),
            foreign key (id_almacen) references almacen(id_almacen)
        );
        /*</Relacion ruta:almacen>*/

        /*<Relacion camioneta:almacen>*/
        create table IF NOT EXISTS ubicado(
            id_almacen int(20) not null,
            matricula varchar(10) not null,

            primary key (matricula),
            foreign key (matricula) references camioneta(matricula),
            foreign key (id_almacen) references almacen(id_almacen)
        );
        /*</Relacion camioneta:almacen>*/

        /*<Relacion camion:agregacion(almacen:ruta)>*/
        create table IF NOT EXISTS recorre(
            matricula varchar(10) not null,
            id_almacen int(20) not null,
            id_ruta int(20) not null,
            h_llegada datetime null,

            primary key(matricula),
            foreign key (matricula) references camion(matricula),
            foreign key (id_almacen) references almacen(id_almacen),
            foreign key (id_ruta) references ruta(id_ruta)
        );
       /*</Relacion camion:agregacion(almacen:ruta)>*/

        /*<Relacion transporta:agregacion(camion:agregacion(almacen:ruta))>*/
        create table IF NOT EXISTS transporta(
            matricula varchar(10) not null,
            id_lote int(20) not null,

            primary key (id_lote),
            foreign key (id_lote) references lotes(id_lote),
            foreign key (matricula) references camion(matricula)
        );
       /*</Relacion transporta:agregacion(camion:agregacion(almacen:ruta))>*/

        /*<Relacion Funcionario:Almacen>*/
        create table IF NOT EXISTS gestiona(
            id_user int(20) not null,
            h_ingreso datetime not null,
            h_salida datetime null,

            primary key (id_user, h_ingreso),
            foreign key (id_user) references funcionario(id_user),
            constraint ck_hora_ingreso check(h_ingreso < h_salida),
            constraint ck_hora_salida check(h_salida > h_ingreso)
        );
       /*</Relacion Funcionario:Almacen*/

       /*<Relacion conductorNeta:camioneta>*/
        create table IF NOT EXISTS manejaNeta(
            id_user int (20) not null,
            matricula varchar (10) not null,
            fecha_inico date not null /*CHECK (fecha_inicio >= GETDATE())*/,
            fecha_fin date null /*CHECK (fecha_fin >= GETDATE())*/,

            primary key (id_user, matricula),
            foreign key (id_user) references conductorNeta(id_user),
            foreign key (matricula) references camioneta (matricula)
        );
      /*</Relacion conductorNeta:camioneta>*/

        /*<Relacion conductorMion:camion>*/
        create table IF NOT EXISTS manejaMion(
            id_user int (20) not null,
            matricula varchar (10) not null,
            fecha_inico date not null /*CHECK (fecha_inicio >= GETDATE())*/,
            fecha_fin date null /*CHECK (fecha_fin >= GETDATE())*/,

            primary key (id_user, matricula),
            foreign key (id_user) references conductorMion(id_user),
            foreign key (matricula) references camion (matricula)
        );
       /*</Relacion conductorMion:camion>*/

        /*<Relacion camioneta:paquete>*/
        create table IF NOT EXISTS envio(
            id_paquete int (20) not null,
            matricula varchar (10) not null,
            progreso varchar (60) not null,
            h_salida datetime NOT NULL,
            h_llegada datetime null,

            primary key(id_paquete),
            foreign key (id_paquete) references paquete(id_paquete),
            foreign key (matricula) references camioneta(matricula)
        );
        /*</Relacion camioneta:paquete>*/

    /*</RELACIONES>*/

    /*<Insert>

IF NOT EXISTS(SELECT 1 FROM usuario WHERE id_user = x) 
INSERT INTO usuario

INSERT INTO `usuario` (`id_user`, `usuario`, `ci`, `contrasena`, `nombre`, `apellido`, `edad`, `email`, `telefono`, `tipo`, `rut`) VALUES
(1, 'salvador_pereira', '56468474', '$2y$10$fDmGz53kJHLX/yG8ssBzCO2Y3Pr9r63biA7.VZhaLw/q6se2jOe8G', 'salvador', 'pereira', 18, 'spereira.gm@gmail.com', '099460853', 'admin', 0),
(2, 'leandro_ugarte', '55958630', '$2y$10$u8w5bT5V.YZ12Aii.GzcQucQNdEjOBD4stQjTObar1R6Eqso71ln2', 'leandro', 'ugarte', 18, 'leaugarte@gmail.com', '098267528', 'admin', 0),
(3, 'santiago.lorenzo', '54512243', '$2y$10$dwJ1IlKxB1XAxkHHtbaVC.r3gdHl368BWShXPD36u1sqwJFGr78Sy', 'santiago', 'lorenzo', 18, 'santiagolorenzo4167@gmail.com', '092063638', 'admin', 0);


    </insert>*/