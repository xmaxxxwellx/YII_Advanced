<?php

namespace backend\controllers;

use common\models\Post;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: Maxxxwell
 * Date: 27.04.2018
 * Time: 20:23
 */

class PostController extends Controller{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['edit', 'create', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        //$testVar = 'Hello World';
        $posts = Post::find();

        return $this->render('index', [
            'posts' => $posts
        ]);
    }

    public function actionCreate(){
        $model = new Post();

        if($model -> load(\Yii::$app -> request -> post())){
           if($model -> save()){
               return $this -> redirect(Url::toRoute("/post/index"));
           }
           else {
               var_dump($model -> getErrors());
               die();
           }
        }

        return $this->render('create', [
            'model' => $model]);
    }

    public function actionEdit($id){
        $model = Post::find() -> where (["id" => $id]) -> one();

        if($model -> load(\Yii::$app -> request -> post())){
            if($model -> save()){
                return $this -> redirect(Url::toRoute("/post/index"));
            }
            else {
                var_dump($model -> getErrors());
                die();
            }
        }

        return $this->render('edit', [
            'model' => $model]);
    }

    public function actionDelete($id){
        $model = Post::find() -> where (["id" => $id]) -> one();

        $model->delete();

        return $this -> redirect(Url::toRoute("/post/index"));
    }
}