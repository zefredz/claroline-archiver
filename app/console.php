<?php

use Symfony\Component\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
// doctrine/migrations
use Doctrine\DBAL\Migrations\Tools\Console\Command as MigrationsCommand;

$console = new Console\Application('Claroline Archiver', '0.1');

$helperSet = new Console\Helper\HelperSet();
$helperSet->set(new Console\Helper\DialogHelper(), 'dialog');
$console->setHelperSet($helperSet);

// Add Migrations commands
$commands = array();
$commands[] = new MigrationsCommand\ExecuteCommand();
$commands[] = new MigrationsCommand\GenerateCommand();
$commands[] = new MigrationsCommand\LatestCommand();
$commands[] = new MigrationsCommand\MigrateCommand();
$commands[] = new MigrationsCommand\StatusCommand();
$commands[] = new MigrationsCommand\VersionCommand();

// remove the "migrations:" prefix on each command name
foreach ($commands as $command) {
    $command->setName(str_replace('migrations:', '', $command->getName()));
}

$console->addCommands($commands);

$console
  ->register('cache:clear')
  ->setDescription('Clears the cache')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $cacheDir = $app['cache.path'];
    $finder = Finder::create()->in($cacheDir)->notName('.gitkeep');

    $filesystem = new Filesystem();
    $filesystem->remove($finder);

    $output->writeln(sprintf("%s <info>success</info>", 'cache:clear'));
});

$console
  ->register('installer:install')
  ->setDescription('Install the application')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {

    $cacheDir = $app['cache.path'];
    $filesystem = new Filesystem();
    $filesystem->mkdir($cacheDir);

    $logDir = $app['log.path'];
    $filesystem = new Filesystem();
    $filesystem->mkdir($logDir);

    $output->writeln(sprintf("%s <info>success</info>", 'installer:install'));
});

return $console;
