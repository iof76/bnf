<?php

	class conectBD extends PDO
	{
		public function __construct()
		{
			parent::__construct('mysql:host=localhost;dbname=bnf', "ivan76", "cMlnroGv74W%ilCzjW");
		}
	}

?>