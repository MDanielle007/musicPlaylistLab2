<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MediaController::index');
$routes->get('addSong', 'MediaController::AddSongForm');
$routes->get('/uploadSongs', 'SongUploadController::index');
$routes->get('/searchSong', 'MediaController::searchSong');
$routes->get('/playlist/(:any)', 'MediaController::playlist/$1');
$routes->post('saveSong', 'SongUploadController::upload');
$routes->post('createPlaylist', 'MediaController::createPlaylist');
$routes->post('addToPlaylist', 'MediaController::addToPlaylist');
