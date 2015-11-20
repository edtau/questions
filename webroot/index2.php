<?php

require __DIR__.'/config_with_app.php';


//<editor-fold desc="Config initial setup">
// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);

//Start the session
$app->session();

//To get clean url. Notice it must be before navbar to work as expected
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

//Set the navbar and theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar.php');


//Add database
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database/config_mysql.php');
    $db->connect();
    return $db;
});
//</editor-fold>

##Setup controller for installation
//<editor-fold desc="Setup controller">
$di->set('SetupController', function() use ($di) {
    $controller = new Anax\Setup\SetupController();
    $controller->setDI($di);

    return $controller;
});
$app->router->add('setup', function() use ($app) {
    $app->dispatcher->forward([
        'controller' => 'setup',
        'action'     => 'setup',
    ]);
});
//</editor-fold>

##Auth controller

//<editor-fold desc="Auth controller">
$di->set('AuthController', function() use ($di) {
    $AuthController = new Anax\Setup\AuthController();
    $AuthController->setDI($di);

    return $AuthController;
});
$app->router->add('login', function() use ($app) {
    $app->dispatcher->forward([
        'controller' => 'auth',
        'action'     => 'login',
    ]);
});
//</editor-fold>

##Commentcontroller

//<editor-fold desc="Commentcontroller">
$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);

    return $controller;
});


$app->router->add('comment', function() use ($app) {
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
        'params'     => ['comment'],
    ]);
});
//</editor-fold>


##Router Source
//<editor-fold desc="Soure controller">
$app->router->add('source', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);

});
//</editor-fold>

$app->router->add('about', function() use ($app) {
    $app->theme->setTitle("About");
    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    $app->views->add('default/page', [
        'content' => $content,
        'title' => "About",
    ]);
});
//queestion
$di->set('QuestionController', function() use ($di) {
    $controller = new Anax\Question\QuestionController();
    $controller->setDI($di);

    return $controller;
});
/*
$app->router->add('questions', function() use ($app) {
    $app->theme->setTitle("questions");

    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'index',
    ]);
});/**/
/*
$app->router->add('questions', function() use ($app) {
    $app->theme->setTitle("questions");

    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'test',
    ]);
});*/
$app->router->add('unanwsered', function() use ($app) {
    echo "home show unanwsered list and top questions";
});
$app->router->add('', function() use ($app) {
    echo "home show welcome and top questions";

});
$app->router->add('home', function() use ($app) {
    echo "home show welcome and top questions";

});
//ask
$app->router->add('ask', function() use ($app) {
    echo "home show form for asking question";

});
//tag
$app->router->add('tags', function() use ($app) {
    echo "home show tags and top questions";

});
//users
$app->router->add('users', function() use ($app) {
    echo "home show users list and top questions";
});
$app->router->handle();
$app->theme->render();
