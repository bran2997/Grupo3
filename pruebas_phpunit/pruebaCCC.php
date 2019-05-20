<?php
	use PHPUnit\Framework\TestCase;
	include_once("dataBase.php");
	class crearcomTest extends TestCase
	{
		
		public function crearComentarioComentario($descripcion, $identificador, $identificadorComentario)
		{
			
			$objeto = new dataBase();
			
			// $titulo = $_POST['titulo'];
			$visibilidad = 1;
			
			
			// $result = $objeto->consultar("SELECT * FROM usuario");
			if ($descripcion!="")
			{
				$result = $objeto->insertar("insert into comentarioComentario (idUsuarioComentario, idComentario,descripcionComentario)
	 values(". $identificador . ", " . $identificadorComentario . ", '" . $descripcion . "')");
				if ($result)
				{
					
					return true;
					// href='verComentarios.php?idPublicacion=
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		

	  public function testComentarioComentario()
        {
        	$valor = $this->crearComentarioComentario('Comentario...','2','2');
            $this->assertTrue(true);
            return $valor;
        }

	}