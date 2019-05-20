<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('verificacion de registro correcto');
$I->amOnPage('crearCuenta.php');
$I->fillField('nombre', 'Arturo');
$I->fillField('apellido', 'Luna');
$I->fillField('nacimiento', '2019-06-11');
$I->fillField('usuario', 'Luna');
$I->fillField('contrasenna', '1234');
$I->fillField('contrasenna2', '1234');
$I->click('boton');
$I->dontSeeCurrentUrlEquals('index.php');