<?php

namespace src\controllers\dashboard;
use src\exceptions\UnauthorizedHttpException;

/**
 * Description of UnauthorizedHttpException.
 *
 * @author Sabri Hamda
 */
class AuthenticatedController extends Controller{
    
   public function __construct($request) {
        parent::__construct($request);
        $user = blog()->getUser();
        if(!$user->isLoggedIn() || !$user->isAdmin()){
            throw new UnauthorizedHttpException('You are not authorized to view this page');
        }
    } 
}
