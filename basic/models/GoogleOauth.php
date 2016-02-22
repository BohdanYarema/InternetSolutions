<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */


/**
 * Oauth 2.0 for web applications
 * @extends GoogleOauth
 *
 */

/**
 * Abstract Auth class
 *
 */
abstract class GoogleOauth {

    const TOKEN_URL = 'https://accounts.google.com/o/oauth2/token';
    const SCOPE_URL = 'https://www.googleapis.com/auth/analytics.readonly';

    protected $assoc = true;
    protected $clientId = '';

    public function __set($key, $value) {
        $this->{$key} = $value;
    }

    public function setClientId($id) {
        $this->clientId = $id;
    }

    public function returnObjects($bool) {
        $this->assoc = !$bool;
    }

    /**
     * To be implemented by the subclasses
     *
     */
    public function getAccessToken($data=null) {}

}