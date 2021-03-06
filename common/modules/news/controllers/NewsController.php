<?php

namespace common\modules\news\controllers;

use Yii;
use common\modules\news\models\news;
use common\modules\news\models\searches\newsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\modules\roles\models\ACLRole;

use yii\web\UploadedFile;
use common\components\helpers\Upload;



/**
 * NewsController implements the CRUD actions for news model.
 */
class NewsController extends Controller
{

    /**
     * Lists all news models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new newsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single news model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new news model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
/*var_dump($model);die();
var_dump(Yii::$arr->request)->post());die();*/

        if ($model->load(Yii::$app->request->post())) {
            $model->time = '2020-01-01';
            if($fileInstanse=UploadedFile::getInstance($model,'image'))
            {
                $model->image=Upload::file($fileInstanse,'news',true);
                if( $model->save()){
                    return $this->redirect(['view','id'=>$model->id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing news model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {
            $model->time = '2020-01-01';
            if($fileInstanse=UploadedFile::getInstance($model,'image'))
            {
                $model->image=Upload::file($fileInstanse,'news',true);
                if( $model->save()){
                    return $this->redirect(['view','id'=>$model->id]);
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing news model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the news model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return news the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = news::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionShowimg($path)
{
	return base64_encode(file_get_contents(Yii::getAlias('@uploads').'/'.$path));
}
}
