<?php
use Cake\Routing\Router;

Router::plugin('VideoManager', ['path' => '/interno/videos'], function ($routes) {
    $routes->connect('/api/checkurl', ['controller' => 'Api', 'action' => 'checkUrl']);
    $routes->connect('/api/setorder', ['controller' => 'Api', 'action' => 'setOrder']);
});

Router::plugin('VideoManager', ['path' => '/interno/galeria-de-fotos'], function ($routes) {
    $routes->connect('/:gallery_id/videos', ['controller' => 'Videos', 'action' => 'manage'], ['pass' => ['gallery_id']]);
    $routes->connect('/:gallery_id/videos/novo', ['controller' => 'Videos', 'action' => 'add'], ['pass' => ['gallery_id']]);
    $routes->connect('/:gallery_id/videos/editar/:video_id', ['controller' => 'Videos', 'action' => 'edit'], ['pass' => ['gallery_id', 'video_id']]);
    $routes->connect('/:gallery_id/videos/remover/:video_id', ['controller' => 'Videos', 'action' => 'delete'], ['pass' => ['gallery_id', 'video_id']]);
});
