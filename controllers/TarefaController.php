<?php

namespace app\controllers;

use Yii;
use app\models\Tarefa;
use app\models\TarefaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class TarefaController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [   
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete', 'model'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new TarefaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['user_id' => Yii::$app->user->id]);
        Yii::$app->session->setFlash('success', "Tarefas Carregadas com sucesso.");
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Tarefa();

        if ($this->request->isPost) {
            $model->user_id = Yii::$app->user->id;
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Tarefa Registrada com sucesso.");
                return $this->redirect(['view', 'id' => $model->id]);
            }

            if (!$model->save()) {
                Yii::error('Failed to save model: ' . json_encode($model->errors));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Tarefa Atualizada com sucesso.");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', "Tarefa Deletada com sucesso.");

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tarefa::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
