<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Verificacion de login ');
$I->amOnPage('index.php');
$I->fillField('usuario', 'Galahad');
$I->fillField('contrasenna', '5153');
$I->click('login');
$I->dontSeeCurrentUrlEquals('index.php');