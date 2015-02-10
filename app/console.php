<?php

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

$console = new Symfony\Component\Console\Application('Claroline Archiver', '0.1');

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
