<?php

namespace src\Controllers\Dashboard;

use src\Exceptions\UnauthorizedHttpException;

/**
 * Description of ProtectedController.
 *
 * @author Sabri Hamda
 */
class ProtectedController extends Controller
{

    public function __construct($request)
    {
        parent::__construct($request);
        $user = blog()->getIdentity();
        $infoUser = $user->getUser();
        if (!$user->isLoggedIn()) {
            $request->redirect('/dashboard/login');
        } elseif ($infoUser->role === 'visitor') {
            $request->redirect('/home');
        } else if (!$user->isAuthorized()) {
            throw new UnauthorizedHttpException('You are not authorized to view this page');
        }
    }
}
