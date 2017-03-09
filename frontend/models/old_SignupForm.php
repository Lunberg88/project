<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use frontend\models\Port;
use frontend\models\Ship;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
    * models\User - prop.
    */
    public $username;
    public $email;
    public $password;
    public $win;
    public $lose;
    public $draw;
    public $credits;
    /**
    * models\Ship - prop.
    */
    public $user_id;
    public $ship_id;
    public $exp;
    public $stock_gun;
    public $stock_tower;
    public $mod_gun;
    public $mod_tower;
    public $strength;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['win', 'trim'],
            ['win', 'integer'],
            
            ['user_id', 'integer'],
            
            ['ship_id', 'trim'],
            ['ship_id', 'integer'],
            
            ['exp', 'trim'],
            ['exp', 'integer'],
            
            ['stock_gun', 'trim'],
            ['stock_gun', 'integer'],
            
            ['stock_tower', 'trim'],
            ['stock_tower', 'integer'],
            
            ['mod_gun', 'trim'],
            ['mod_gun', 'integer'],
            
            ['mod_tower', 'trim'],
            ['mod_tower', 'integer'],
            
            ['strength', 'trim'],
            ['strength', 'integer'],
            
            ['lose', 'trim'],
            ['lose', 'integer'],
            
            ['draw', 'trim'],
            ['draw', 'integer'],
            
            ['credits', 'trim'],
            ['credits', 'integer'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->win = 0;
        $user->lose = 0;
        $user->draw = 0;
        $user->credits = 100;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $port = new Port();
        $port->user_id = 14;
        $port->ship_id = 1;
        $port->exp = 0;
        $port->stock_gun = 1;
        $port->stock_tower = 1;
        $port->mod_gun = 0;
        $port->mod_tower = 0;
        $port->strength = 1500;

        
        return [($user->save() ? $user : null), ($port->save() ? $port : null)];
    }
      
}
