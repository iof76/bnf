<?php
require_once "conectBD.php";
class user
{
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $direccion;
    private $telefono;
    private $email;
    private $usuario;
    private $pass;
    private $id_tipo;
    private $imagen;

	function __construct($nombre="a", $apellidos="a", $direccion="a", $telefono=654123654, $email="a", $usuario="a", $password="a", $idTipo=0, $imagen)
	{
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->direccion = $direccion;
		$this->telefono = $telefono;
		$this->email = $email;
		$this->usuario = $usuario;
		$this->pass = $password;
		$this->id_tipo = $idTipo;
		$this->imagen = $imagen;
	}

	function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}
	function getNombre()
	{
		return $this->nombre;
	}

	function setApellidos($apellidos)
	{
		$this->apellidos = $apellidos;
	}
	function getApellidos()
	{
		return $this->apellidos;
	}

	function setDireccion($direccion)
	{
		$this->direccion = $direccion;
	}
	function getDireccion()
	{
		return $this->direccion;
	}

	function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}
	function getTelefono()
	{
		return $this->telefono;
	}

	function setEmail($email)
	{
		$this->email = $email;
	}
	function getEmail()
	{
		return $this->email;
	}

	function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}
	function getUsuario()
	{
		return $this->usuario;
	}

	function setPassword($password)
	{
		$this->passw = $password;
	}
	function getPassword()
	{
		return $this->pass;
	}

	function setTipo($tipo)
	{
		$this->id_tipo = $tipo;
	}
	function getTipo()
	{
		return $this->id_tipo;
	}

	function setImagen($imagen)
	{
		$this->imagen = $imagen;
	}
	function getImagen()
	{
		return $this->imagen;
	}

	function newUser()
	{
		$mbd = new conectBD();
		$sentencia = $mbd->prepare("INSERT INTO usuarios (nombre, apellidos, direccion, telefono, email, usuario, pass, id_tipo, imagen) VALUES (:nombre, :apellidos, :direccion, :telefono, :email, :usuario, :pass, :id_tipo, :imagen)");
		$sentencia->bindParam(':nombre', $this->nombre);
		$sentencia->bindParam(':apellidos', $this->apellidos);
		$sentencia->bindParam(':direccion', $this->direccion);
		$sentencia->bindParam(':telefono', $this->telefono);
		$sentencia->bindParam(':email', $this->email);
		$sentencia->bindParam(':usuario', $this->usuario);
		$sentencia->bindParam(':pass', $this->pass);
		$sentencia->bindParam(':id_tipo', $this->id_tipo);
		$sentencia->bindParam(':imagen', $this->imagen);
		if($sentencia->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function checkUser()
	{
		$mbd = new conectBD();

		//Capturo el id_usuario para grabarlo en sesión y poderlo así usar a la hora de actualizar
		$consulta_id = $mbd->prepare("SELECT id_usuario FROM usuarios WHERE usuario=:usuario AND pass=:pass AND baneado=0");
        $consulta_id->bindParam(':usuario', $this->usuario, PDO::PARAM_STR, 12);
        $consulta_id->bindParam(':pass', $this->pass, PDO::PARAM_STR, 12);
        if($consulta_id->execute()) 
        {
            $id_usuario = $consulta_id->fetch(PDO::FETCH_NUM);
			$_SESSION["id_usuario"] = $id_usuario[0];
        } 

		$sentencia = $mbd->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND pass=:pass AND baneado=0");
		$sentencia->bindParam(':usuario', $this->usuario, PDO::PARAM_STR, 12);
		$sentencia->bindParam(':pass', $this->pass, PDO::PARAM_STR, 12);
		$sentencia->execute();

		$user = $sentencia->fetch(PDO::FETCH_ASSOC);

		if($user!=false)
		{
			return $user;
		}
		else
		{
			return $user;
		}
	}

	function updateUser()
	{
		$mbd = new conectBD();
		$sentencia = $mbd->prepare("UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono, email=:email, usuario=:usuario, pass=:pass, id_tipo=:id_tipo, imagen=:imagen WHERE id_usuario=:id_usuario");
		$sentencia->bindParam(':nombre', $this->nombre);
		$sentencia->bindParam(':apellidos', $this->apellidos);
		$sentencia->bindParam(':direccion', $this->direccion);
		$sentencia->bindParam(':telefono', $this->telefono);
		$sentencia->bindParam(':email', $this->email);
		$sentencia->bindParam(':usuario', $this->usuario);
		$sentencia->bindParam(':pass', $this->pass);
		$sentencia->bindParam(':id_tipo', $this->id_tipo);
		$sentencia->bindParam(':imagen', $this->imagen);
		$sentencia->bindParam(':id_usuario', $_SESSION["id_usuario"]);
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