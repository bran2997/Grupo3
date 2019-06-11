<?php
// use PHPUnit\Framework\TestCase;
    class dataBase// extends TestCase
    {
        var $host='muowdopceqgxjn2b.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        var $bd= 'p1w2c8u8acl7c3rk';
        var $usuario='ijv5x90z3bqx121i';
        var $password='j6vouxmtyr92x1c4';
        var $port = '3306';
        var $link = 0;
        

        
        public function consultar($sql)
        {
            $this->link = new mysqli($this->host, $this->usuario, $this->password,  $this->port, $this->bd);
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