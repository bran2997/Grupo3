<?php
/**
 * Created by PhpStorm.
 * User: José Jiménez
 * Date: 25/4/2019
 * Time: 14:58
 */


use PHPUnit\Framework\TestCase;


class prueba extends TestCase
{
    public function invertir($num)
    {
        return 0;
    }
    public function esPalindromo()
    {
        $numero = 4343323;
        return invertir($umero);
    }




    
    public function test1()
    {
        $this->assertTrue(true);
        $resultado = 4*4;
        return $resultado;
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    public function testProducerThird()
    {
        $this->assertTrue(true);
        return 'third';
    }

    /**
     * @depends test1
     * @depends testProducerSecond
     * @depends testProducerThird
     */

    public function testConsumer($a, $b, $c)
    {
        $this->assertSame(16, $a);
        $this->assertSame('second', $b);
        $this->assertSame('third', $c);
    }
}