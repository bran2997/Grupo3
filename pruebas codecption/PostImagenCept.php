<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Verificacion de login ');
$I->amOnPage('C:/wamp64/www/2019-1-qa-grupo3/inicio/index.php');
$I->fillField('titulo', 'titulo');
$I->fillField('descripcion', 'descripcion');
$I->attachFile('input[id$="archivo"]', 'A1.jpg');
$I->click('boton');
$I->SeeCurrentUrlEquals('inicio/index.php');