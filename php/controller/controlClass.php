<?php
require_once "../model/conectBD.php";
require_once "../model/classUsuario.php";
session_start();

class controlClass 
{
    private $params;

	function __construct( $prmts )
	{
		$this->params = array();
		foreach ( $prmts as $n => $v)
		{
			$this->params[$n] = $v;
		}
	}

	public function actionToDO()
	{
	    if (isset($this->params['action']))
	    {
           switch ($this->params['action'])
           {
           		case '0':
					echo $this->getPortFront($this->params['JSONInicio'],$this->params['JSONTotal']);
					break;
				default:
					echo "La acción seleccionada es incorrecta".$this->params['action'];
					break;
		    }
		}
	}

	public function getPortFront($JSONInicio,$JSONTotal)
	{	
		$outPutData;
 
		try 
		{
		    $bd = new conectBD();
		    $i = 0;
			foreach($bd->query("SELECT id, nombre, imagen FROM 495476_potfolio ORDER BY id DESC LIMIT $JSONTotal OFFSET $JSONInicio") as $fila) 
		    {
		        $outPutData[$i]["id"]=utf8_encode($fila["id"]);
				$outPutData[$i]['nombre']=utf8_encode($fila['nombre']);
				$outPutData[$i]['imagen']=utf8_encode($fila['imagen']);
		        $i++;
		    }
		} 
		catch (PDOException $e) 
		{
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

		return json_encode($outPutData);
	}

	

}

?>
