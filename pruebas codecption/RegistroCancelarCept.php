<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('verificacion de la cancelacion del registro correcto');
$I->amOnPage('crearCuenta.php');
$I->fillField('nombre', 'Arturo');
$I->fillField('apellido', 'Luna');
$I->fillField('nacimiento', '2019-06-11');
$I->fillField('usuario', 'Luna');
$I->fillField('contrasenna', '1234');
$I->fillField('contrasenna2', '1234');
$I->click('Cancelar');
$I->dontSeeCurrentUrlEquals('crearCuenta.php');