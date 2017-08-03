<?php

$router = $di->getRouter();

$router->add(
    "/language/{lang}",
    [
        "controller" => "language",
        "action"     => "change"
    ]
);

$router->add(
    "/logout",
    [
        "controller" => "index",
        "action"     => "logout",
    ]
);

$router->add(
    "/home",
    [
        "controller" => "home",
        "action"     => "index",
    ]
);

$router->add(
    "/change",
    [
        "controller" => "change",
        "action"     => "index",
    ]
);

$router->add(
    "/check",
    [
        "controller" => "change",
        "action"     => "check",
    ]
);

$router->handle();
