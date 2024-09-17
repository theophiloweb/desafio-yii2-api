<?php

namespace app\filters;

use Yii;
use yii\filters\auth\AuthMethod;

class BearerAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
            $identity = $user->loginByAccessToken($token, get_class($this));
            if ($identity === null) {
                $this->handleFailure($response);
            }
            return $identity;
        }
        return null;
    }
}