<?php
date_default_timezone_set('UTC');

$m = new Memcached();
$m->addServer('localhost', 11211);

if (isset($_GET['ajax'])) {
    if (isset($_POST['incr']))
    {
        $m->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $m->increment('offset', 1, 0);
    }
    if (isset($_POST['decr']))
    {
        $m->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $m->decrement('offset', 1, 0);
    }
    $offset = ($offset = $m->get('offset')) ? $offset : 0;
    $time = time() + $offset * 60 * 60;
    echo json_encode(['time' => $time]);
    die();
}
require_once 'view.php';