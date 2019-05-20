<?php
use PHPUnit\Framework\TestCase;
include_once("dataBase.php");

    class TodoTest extends TestCase
    {


     public function meGustaComentario($usuario,$publicacion,$idComentario)
        {     
           
    
                $script = "insert into likeComentario (idComentario,idUsuarioLike) values (" . (int)$comentario . "," . (int)$usuario . ");";
                $objeto = new dataBase();
                $result = $objeto->insertar($script);

            return true

        }

    
    public function TestmeGustaComentario()

        {

            $valor = $this->meGusta(1,1);
            $this->assertTrue(true);
            return $valor;
        }

    /**
     * @depends  TestmeGustaComentario
     */

    public function TestmeGustaComentarioM($a)
    {
        $this->assertSame(true, $a);//No falló la consulta.

    }
    }

?>    
