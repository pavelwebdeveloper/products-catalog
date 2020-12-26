<?php

// This is the product-catalog controller

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Product;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
     * @return string
     */
    public function actionIndex()
    {
     
       $query = Product::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $products = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        
        return $this->render('index', [
            'products' => $products,
            'pagination' => $pagination,
            
        ]);
    }
    
    
    /**
     * Edit action.
     *
     * @return Response|string
     */
    
    public function actionEdit($id)
    {
        
                
        $model = new EditForm();
        
        $announcement = Announcement::findOne((int)$announcementId);
        
        if($post = $model->load(Yii::$app->request->post())){
         
         $session->setFlash('message', 'You have successfully updated the ad.');
         
         $announcement->announcementTitle = $model->title;
         $announcement->announcementDescription = $model->description;
         $announcement->save();
         
         return $this->render('showad', [
             'message' => $session->getFlash('message'),
             'loggedIn' => $session->get('loggedIn'),
             'userId' => $session->get('userId'),
             'username'=>$session->get('username'),
             'announcement' => $announcement,
         ]);
        }
        
         if($announcement){
         return $this->render('edit', [
              'message' => $session->getFlash('message'),
              'post' => $post,        
              'model' => $model,
              'loggedIn' => $session->get('loggedIn'),
              'userId' => $session->get('userId'),
              'username'=>$session->get('username'),
              'announcement' => $announcement,
         ]);
        }       
    }
    
    
    
    public function actionUpload()
    {
        $model = new EditForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('edit', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
