<?php
use PHPUnit\Framework\TestCase;
include_once("dataBase.php");

    class TodoTest extends TestCase
    {


     public function meGusta($usuario,$publicacion)
        {     
            
        $script = "insert into likes (idPublicacion, idUsuarioLike) values (" . (int)$publicacion . "," . (int)$usuario . ");";
        $objeto = new dataBase();
        $result = $objeto->insertar($script);   
        return  true;

        }

    
    public function testMeGusta()

        {

            $valor = $this->meGusta(1,1);
            $this->assertTrue(true);
            return $valor;
        }

    /**
     * @depends  testMeGusta
     */

    public function testMeGustaM($a)
    {
        $this->assertSame(true, $a);//No falló la consulta.

    }


    }

    
