<?php

use Cekurte\Environment\Environment;
use Cekurte\TwitterLike\ServiceProvider\DoctrineExtensionsServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\Driver\DriverChain;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand;
use Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand;
use Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\RunDqlCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Version;
use Gedmo\DoctrineExtensions;
use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\HelperSet;

$app = new SilexApplication();

$app['debug'] = Environment::get('APP_DEBUG');

$doctrine   = require CONFIG_PATH . DS . 'doctrine.php';
$migrations = require CONFIG_PATH . DS . 'migrations.php';

$app->register(new DoctrineServiceProvider(), $doctrine['dbal']);
$app->register(new DoctrineOrmServiceProvider(), $doctrine['orm']);
$app->register(new DoctrineExtensionsServiceProvider());

$em = $app['orm.em'];

$helperSet = new HelperSet(array(
    'db'     => new ConnectionHelper($em->getConnection()),
    'em'     => new EntityManagerHelper($em),
    'dialog' => new DialogHelper(),
));

$cli = new Application('Silex Command Line Interface', Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

$commands = [];

$commands[] = new MetadataCommand();
$commands[] = new ResultCommand();
$commands[] = new QueryCommand();
$commands[] = new CreateCommand();
$commands[] = new UpdateCommand();
$commands[] = new DropCommand();
$commands[] = new EnsureProductionSettingsCommand();
$commands[] = new ConvertDoctrine1SchemaCommand();
$commands[] = new GenerateRepositoriesCommand();
$commands[] = new GenerateEntitiesCommand();
$commands[] = new GenerateProxiesCommand();
$commands[] = new ConvertMappingCommand();
$commands[] = new RunDqlCommand();
$commands[] = new ValidateSchemaCommand();
$commands[] = new InfoCommand();
$commands[] = new MappingDescribeCommand();

$cli->addCommands($commands);

// Register All Doctrine DBAL Commands
ConsoleRunner::addCommands($cli);

return $cli;
