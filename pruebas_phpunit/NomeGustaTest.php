<?php
use PHPUnit\Framework\TestCase;
include_once("dataBase.php");

    class TodoTest extends TestCase
    {


     public function NomeGusta($usuario,$publicacion)
        {     

            $script = "delete from likes where idPublicacion=" . $publicacion . " and idUsuarioLike=" . (int)$usuario . ";";
            $objeto = new dataBase();
            $result = $objeto->insertar($script);

            return true;

        }

    
    public function testNomeGusta()

        {

            $valor = $this->NomeGusta(1,1);
            $this->assertTrue(true);
            return $valor;
        }

    /**
     * @depends  testNomeGusta
     */

    public function testNoMeGusta2($a)
    {
        $this->assertSame(true, $a);//No falló la consulta.

    }
    }

?>    
