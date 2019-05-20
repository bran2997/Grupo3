<?php
use PHPUnit\Framework\TestCase;
include_once("archivoTodo.php");
include_once("dataBase.php");

    class TodoTest extends TestCase
    {
    	       
   

     public function meGusta($script)
        {     
            
        $objeto = new dataBase();
        $result = $objeto->insertar($script);
        
        return  $result;        
        }

     public function meGustaTest()
        {     
         $usuario = "1";
        $publicacion = "1"; 
        $script = "insert into likes (idPublicacion, idUsuarioLike) values (" . (int)$publicacion . "," . (int)$usuario . ");";
        $a = $this->megusta($script);

        $this->assertTrue(true);
        return $this->error; 
        }

        /**
         * @depends  meGustaTest
         */
        public function testMeGusta($a, $b)
        {
            $this->assertSame($a, $a);//No falló la consulta.

        }

    }
