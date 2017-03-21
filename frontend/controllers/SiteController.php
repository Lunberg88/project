<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Port;
use frontend\models\Ship;
use common\models\User;
use frontend\models\Mods;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['login', 'signup', 'error', 'logout', 'index', 'combat', 'contact', 'about' ],
                'rules' => [
                    [
                        'actions' => ['login', 'signup', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'combat', 'error', 'contact', 'about'],
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
     * @inheritdoc
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
     * @return mixed
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->isGuest) { 
        $user = User::findOne(Yii::$app->user->getId());

        //
        if(Yii::$app->request->post('shipfirst')) {
            $newship = new Port();

            $newship->user_id = Yii::$app->user->id;
            $newship->ship_id = 2;
            $newship->exp = 0;
            $newship->stock_gun = 1;
            $newship->stock_tower = 1;
            $newship->mod_gun = 0;
            $newship->mod_tower = 0;
            $newship->strength = 1600;
            $newship->type = 2;

            $newship->save();

            return $this->goHome();
        } elseif(Yii::$app->request->post('shipsecond')) {
            $newship = new Port();

            $newship->user_id = Yii::$app->user->id;
            $newship->ship_id = 4;
            $newship->exp = 0;
            $newship->stock_gun = 1;
            $newship->stock_tower = 1;
            $newship->mod_gun = 0;
            $newship->mod_tower = 0;
            $newship->strength = 1600;
            $newship->type = 3;

            $newship->save();

            return $this->goHome();
        }

        $model = Port::findOne(['user_id' => Yii::$app->user->id]);
        if($model) {
            $shipname = Ship::findOne(['id' => $model->ship_id]);

            $avaible_mods = Mods::findOne(['ship_id' => $model->ship_id]);
            $exp_mod_gun = $model->exp_gun;
            $exp_mod_tower = $model->exp_tower;
/*
            if(Yii::$app->request->post('expmodgun')) {

            }
*/
            return $this->render('main', [
                'model' => $model,
                'shipname' => $shipname,
                'user' => $user,
                'avaible_mods' => $avaible_mods,
                'exp_mod_gun' => $exp_mod_gun,
                'exp_mod_tower' => $exp_mod_tower,
            ]);
        } else {
            return $this->render('main', [
                'user' => $user,
            ]);
        }
           } else {
        return $this->redirect('site/login');
       }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
