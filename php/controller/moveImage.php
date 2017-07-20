<?php
session_start();

	$date=date();
	$time=time();

	if(!empty($_FILES['imagen']['name']))
	{
		move_uploaded_file($_FILES['imagen']['tmp_name'], "../../images/users/".$_FILES['imagen']['name']);//Muevo el archivo a la carpeta "images/users/"
    	//rename("../../images/usuarios/".$_FILES["imagen"]["name"], "../../images/users/".$date.$time.".jpg");//Renombro el archivo con la fecha actual
    	if(isset($_SESSION["user"]))
        {
        	header('Location: ../../index.php');
        }
        else
        {
			header('Location: ../../login.php');
        }
	}
	else
	{
		if(isset($_SESSION["user"]))
        {
        	header('Location: ../../index.php');
        }
        else
        {
			header('Location: ../../login.php');
        }
	}

	if(!empty($_FILES['imgArticulo']['name']))
	{
		move_uploaded_file($_FILES['imgArticulo']['tmp_name'], "../../images/movies/".$_FILES['imgArticulo']['name']);//Muevo el archivo a la carpeta "images/movies/"
    	header('Location: ../../index.php');
	}
	else
	{
		header('Location: ../../index.php');
	}
	
?>