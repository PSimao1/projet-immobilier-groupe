<?php

use function \DI\get;

use function DI\autowire;
use App\Account\AccountModule;


return [
   'account.prefix' => '/account',
    AccountModule::class => autowire()->constructorParameter('prefix', get('account.prefix'))
];