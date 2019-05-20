<?php
	use PHPUnit\Framework\TestCase;
	include_once("dataBase.php");
	class crearcomTest extends TestCase
	{
		public function crearComentario($titulo, $descripcion, $identificador, $identificadorPublicacion)
		{
			
			$objeto = new dataBase();

			$visibilidad = 1;

			if ($titulo!="" or $descripcion!="" or $direccionImagen!="")
			{
				$result = $objeto->insertar("insert into comentarios (idUsuarioComentario, idPublicacionComentario,descripcion)
	 values(". $identificador . ", " . $identificadorPublicacion . ", '" . $descripcion . "')");
				if ($result)
				{

					return true;
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




	  public function testCrearComentario()
        {
        	$valor = $this->crearComentario('Titulo', 'Comentario...','1','1');
            $this->assertTrue(true);
            return $valor;
        }

	}


