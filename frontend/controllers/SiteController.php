<?php

namespace frontend\controllers;

use common\models\Forms;
use common\models\User;
use common\models\UserFormResults;
use Faker\Factory;
use frontend\service\SurveyService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'answer',
                            'create-user',
                            'form',
                            'delete-answer',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'form' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Forms::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAnswer() {

        $dataProvider = new ActiveDataProvider([
            'query' => UserFormResults::find()->andWhere(['ref_user' => Yii::$app->user->id]),

            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('user-answer', ['dataProvider' => $dataProvider]);
    }

    public function actionDeleteAnswer($id) {
        $model = UserFormResults::findOne($id);
        $model->delete();

        return $this->redirect('answer');
    }

    public function actionForm($id) {
        $model = Forms::findOne($id);

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $service = new SurveyService();
            $service->saveSurvey($post, $model->id);
            Yii::$app->session->setFlash('success', 'Thanks for the survey');

            return $this->redirect('index');
        }

        return $this->render('form-create', [
            'model' => $model,
        ]);
    }
}
