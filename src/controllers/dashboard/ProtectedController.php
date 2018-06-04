<?php

namespace src\controllers\dashboard;
use src\exceptions\UnauthorizedHttpException;

/**
 * Description of UnauthorizedHttpException.
 *
 * @author Sabri Hamda
 */
class ProtectedController extends Controller{
    
   public function __construct($request) {
        parent::__construct($request);
        $user = blog()->getIdentity();
        if(!$user->isLoggedIn()){
           $request->redirect('/dashboard/login');
        }else if (!$user->isAdmin()){
            throw new UnauthorizedHttpException('You are not authorized to view this page');
        }
    } 
}
