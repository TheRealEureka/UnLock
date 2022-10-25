<?php

use App\Controller\GameController;
use App\Service\GameService;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UMA\DIC\Container;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use App\Controller\CardController;
use App\Service\CardService;

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container(require __DIR__ . '/settings.php');

$container->set(LoggerInterface::class, function (ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushHandler(new StreamHandler($settings['path'], Level::Debug));
    return $logger;
});

$container->set(EntityManager::class, static function (Container $c): EntityManager {
    /** @var array $settings */
    $settings = $c->get('settings');

    // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
    // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library
    $cache = $settings['doctrine']['dev_mode'] ?
        DoctrineProvider::wrap(new ArrayAdapter()) :
        DoctrineProvider::wrap(new FilesystemAdapter(directory: $settings['doctrine']['cache_dir']));

    $config = Setup::createAttributeMetadataConfiguration(
        $settings['doctrine']['metadata_dirs'],
        $settings['doctrine']['dev_mode'],
        null,
        $cache
    );

    return EntityManager::create($settings['doctrine']['connection'], $config);
});

$container->set('view', function () {
    return Twig::create(
        __DIR__ . '/public/view',
        ['cache' => __DIR__ . '/cache']
    );
});
$container->set(CardService::class, static function (Container $c) {
    return new CardService($c->get(EntityManager::class), $c->get(LoggerInterface::class));
});

$container->set(CardController::class, static function (ContainerInterface $container) {
    $view = $container->get('view');
    return new CardController($view, $container->get(CardService::class));
});

$container->set(GameService::class, static function (Container $c) {
    return new GameService($c->get(EntityManager::class), $c->get(LoggerInterface::class));
});

$container->set(gameController::class, static function (ContainerInterface $container) {
    $view = $container->get('view');
    return new gameController($view, $container->get(GameService::class));
});

return $container;
