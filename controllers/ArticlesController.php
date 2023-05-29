<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Application;
use app\core\Response;
use app\exceptions\FileException;
use app\mappers\ArticleMapper;
use app\models\Article;

class AticlesController
{

    public function getView()
    {
        Application::$app->getRouter()->renderTemplate("index", ["get_action"=>"articles"]);

    }

    public function handleView()
    {
        try {
        $body = Application::$app->getRequest()->getBody();

       $mapper = new ArticleMapper();
       $user = $mapper->createObject($body);
       $mapper->Insert($user);
       $users = $mapper->SelectAll();
       var_dump($users);
       // Application::$app->getRouter()->renderView("success");
             }
        catch (\Exception $exception) {

            Application::$app->getLogger()->error($exception);
        }
    }
}