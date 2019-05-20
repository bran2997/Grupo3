<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Verificacion de login ');
$I->amOnPage('/inicio/index.php');
$I->fillField('titulo', 'titulo');
$I->fillField('descripcion', 'descripcion');
$I->click('boton');
$I->SeeCurrentUrlEquals('inicio/index.php');