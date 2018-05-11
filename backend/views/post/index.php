<?php
/**
 * Created by PhpStorm.
 * User: Maxxxwell
 * Date: 27.04.2018
 * Time: 20:25
 */

use common\models\Post;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/** @var Post [] $posts */

//foreach ($posts as $item){
//    echo $item->author;
//    echo '<br>';
//}

echo \yii\helpers\Html::a("Create", \yii\helpers\Url::toRoute(['/post/create']), ['class' => 'btn btn-success']);
echo "<br><br>";

$dataProvider = new ActiveDataProvider([
    'query' => $posts,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'author',
        'title',
        'slug',
        'description',
        'content',
        'image',
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="fa fa-search"></span>Edit', \yii\helpers\Url::toRoute(["/post/edit", "id" => $model->id]), [
                        'title' => Yii::t('app', 'View'),
                        'class' => 'btn btn-primary btn-xs',
                    ]);
                }
            ]
        ]
    ]
]);