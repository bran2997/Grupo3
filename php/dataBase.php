<?php
// use PHPUnit\Framework\TestCase;
    class dataBase// extends TestCase
    {
        var $host='db4free.net';
        var $bd='baseqa';
        var $usuario='bran2997';
        var $password='12345678';
        var $port = '3306';
        var $link = 0;
        

        
        public function consultar($sql)
        {
            $this->link = new mysqli($this->host, $this->usuario, $this->password, $this->bd, $this->port);
            $result = $this->link->query($sql);
            return $result;
        }
        
        public function insertar($sql)
        {
            $this->link = new mysqli($this->host, $this->usuario, $this->password, $this->bd, $this->port);
            return $this->link->query($sql);
        }
        
        public function __destruct()
        {
            mysqli_close($this->link);
        }

        // public function testSelectVerdadero()
        // {
        //     $sql = "select * from usuario";
        //     $a = $this->consultar($sql);
        //     $this->assertTrue(true);
        //     return $this->link->error;
        // }
        // public function testSelectFalso()
        // {
        //     $sql = "select * from usuario2";
        //     $a = $this->consultar($sql);
        //     $this->assertTrue(true);
        //     return $this->link->error;
        // }
        // /**
        //  * @depends testSelectVerdadero
        //  * @depends testSelectFalso
        //  */
        // public function testIsaac($a, $b)
        // {
        //     $this->assertSame('', $a);//No falló la consulta.
        //     $this->assertNotEquals('', $b);//Falló la consulta.
        // }
    }

?>