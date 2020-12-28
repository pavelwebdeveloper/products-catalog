<?php

// This is the product-catalog controller

namespace app\controllers;

use Yii;
use yii\base\Model;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Product;
use app\models\Image;
use app\models\CreateAndEditForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

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
       
       $images = Image::find()
           ->indexBy('id')
           ->all();

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
             'images' => $images,
        ]);
    }
    
    
    public function actionUpload()
    {
        $model = new UploadForm();
        
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
             $success_message = "File is uploaded successfully";
                return $this->render('upload', [
                    'model' => $model,
                    'success_message' => $success_message,
                        ]);
            }
        }
        
              

        return $this->render('upload', [
            'model' => $model,
             'success_message' => "",
            
            ]);
    }
    
    
    /**
     * Edit action.
     *
     * @return Response|string
     */
    
         
    public function actionUpdate_products($productId)
    {
        
     //var_dump($productId);
        //exit;
                
        $model = new CreateAndEditForm();
        
        $images = Image::find()
           ->indexBy('id')
           ->all();
        
        if($productId > 0){
        
        $product = Product::findOne((int)$productId);
        
        if($post = $model->load(Yii::$app->request->post())){
         
        //var_dump((int)$model->imageId);
        //exit;
         
         //$session->setFlash('message', 'You have successfully updated the product.');
                  
         $product->imageId = $model->imageId;
         $product->productSKU = $model->productSKU;
         $product->productName = $model->productName;
         $product->productAmount = $model->productAmount;
         $product->productType = $model->productType;
         $product->save();
         
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
             'images' => $images,
        ]);
        }
        
         if($productId){
         return $this->render('update', [
              //'message' => $session->getFlash('message'),
              'post' => $post,        
              'model' => $model,
              'product' => $product,
              'images' => $images,
         ]);
        }
        
        } else {
         //$model = new CreateAndEditForm();
         
         /*
         $images = Image::find()
           ->indexBy('id')
           ->all();
          * *
          */
         
         /*
         var_dump($model->load(Yii::$app->request->post()))."<br><br>";
         var_dump($model->imageId);
         echo "Hiiiiiiiiiiiiiiiiiii";
         exit;
          * *
          */
         
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
         
         //if ($model->load(Yii::$app->request->post())) {
         
          
            /*$product = new Product();
              $product->imageId = $model->imageId;
         $product->productSKU = $model->productSKU;
         $product->productName = $model->productName;
         $product->productAmount = $model->productAmount;
         $product->productType = $model->productType;
         
         /*
         var_dump($product);
          var_dump($product->imageId)."<br>";
     var_dump($product->productSKU)."<br>";
     var_dump($product->productName)."<br>";
     var_dump($product->productAmount)."<br>";
     var_dump($product->productType)."<br>";
     
          exit;
          * 
          */
         /*
          echo var_dump($product)."<br><br><br><br><br><br>";  
         echo var_dump($product->save());  
         
         echo "Works or not";
         exit;
          * *
          */
         // setting flash-message
        // $session->setFlash('message', 'You have successfully added a product.');
         
         /*
         $productId = Product::find()
             ->max('id');
         
         $createdProduct = Product::find()
             ->where(['id' => $productId])
             ->one();
          * *
          */
         
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
              //'message' => $session->getFlash('message'),
               'products' => $products,
            'pagination' => $pagination,
               'images' => $images,
              ]);
         
        }
        
        return $this->render('update', [
             'model' => $model, 
             'images' => $images,            
        ]);
        }
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
