<?php

use Cekurte\Environment\Environment;

return [
    'migrations.directory'  => ROOT_PATH . DS . Environment::get('DOCTRINE_MIGRATIONS_DIRECTORY'),
    'migrations.name'       => Environment::get('DOCTRINE_MIGRATIONS_NAME'),
    'migrations.namespace'  => Environment::get('DOCTRINE_MIGRATIONS_NAMESPACE'),
    'migrations.table_name' => Environment::get('DOCTRINE_MIGRATIONS_TABLENAME'),
];
