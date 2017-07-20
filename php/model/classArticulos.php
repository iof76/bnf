<?php
class articulos
{
    private $id_articulo;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $visible;

	function __construct($id_articulo, $nombre; $descripcion, $imagen, $visible)
	{
		$this->id_articulo=$id_articulo;
		$this->nombre = $nombre;
		$this->descripcion = $descipcion;
		$this->imagen = $imagen;
		$this->visible = $visible;
	}

	function newArticulo()
	{
		$mbd = new conectBD();
		$sentencia = $mbd->prepare("INSERT INTO 495476_potfolio (nombre, id, descripcion, imagen) VALUES (:nombre, :id_articulo, :descripcion, : imagen, :visible)");
		$sentencia->bindParam(':nombre', $this->nombre);
		$sentencia->bindParam(':id_articulo', $this->id_articulo);
		$sentencia->bindParam(':descripcion', $this->descripcion);
		$sentencia->bindParam(':imagen', $this->imagen);
		$sentencia->bindParam(':visible', $this->visible);

		if($sentencia->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}











	function updateArticulo()
	{
		$mbd = new conectBD();
		$sentencia = $mbd->prepare("UPDATE articulos SET titulo=:titulo, descr_corta=:descr_corta, descripcion=:descripcion, anyo=:anyo, genero=:genero, director=:director, actores=:actores, duracion=:duracion, imagen=:imagen, precio=:precio, visible=:visible WHERE id_articulo=:id_articulo");
		$sentencia->bindParam(':titulo', $this->titulo);
		$sentencia->bindParam(':descr_corta', $this->descr_corta);
		$sentencia->bindParam(':descripcion', $this->descripcion);
		$sentencia->bindParam(':anyo', $this->anyo);
		$sentencia->bindParam(':genero', $this->genero);
		$sentencia->bindParam(':director', $this->director);
		$sentencia->bindParam(':actores', $this->actores);
		$sentencia->bindParam(':duracion', $this->duracion);
		$sentencia->bindParam(':imagen', $this->imagen);
		$sentencia->bindParam(':precio', $this->precio);
		$sentencia->bindParam(':visible', $this->visible);
		$sentencia->bindParam(':id_articulo', $_SESSION["id_articulo"]);
		if($sentencia->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
?>