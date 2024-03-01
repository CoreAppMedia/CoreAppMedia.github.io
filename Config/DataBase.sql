create database tienda_online;
use tienda_online;
create table Productos(
id_producto int primary key auto_increment,
nombre_producto varchar(100),
descripcion_producto text,
precio_producto decimal(10,2),
id_categoria_producto int,
activo_producto int
);

/* insertar datos en la tabla deseada */
insert into Productos(nombre_producto,descripcion_producto,precio_producto,id_categoria_producto,activo_producto) values("zapatos","Color cafe",599.99,1,1);
insert into Productos(nombre_producto,descripcion_producto,precio_producto,id_categoria_producto,activo_producto) values("guantes","Color negro",299.99,2,1);
insert into Productos(nombre_producto,descripcion_producto,precio_producto,id_categoria_producto,activo_producto) values("Laptop Hp","Color negro",11299.99,2,1);
insert into Productos(nombre_producto,descripcion_producto,precio_producto,id_categoria_producto,activo_producto) values("Smartwatch","negro",6999.99,2,1);
/* actualizar datos ya establecidos en una tabla */
UPDATE Productos
SET descuento_producto = 10
WHERE id_producto = 1;

/* actualizar descripcion de un producto */
UPDATE Productos
SET descripcion_producto = "<p> zapatos color cafe para hombre, diseñado para tu comodidadad<p>
							<br>
                            <b> Caracteristicas: </b>
                            <br>
                            Marca: Cklaas<br>
                            Colecion: otoño-invierno <br>
                            Color: Cafe<br>
                            Material corte: Piel Natural Vacuno<br>
							"
WHERE id_producto = 1;

/* visualizar la tabla completa */
select * from Productos;

/*agregar nueva columna a una tabla ya existente, en este caso a la tabla Productos*/
ALTER TABLE Productos
ADD COLUMN descuento_producto tinyint DEFAULT 0;
