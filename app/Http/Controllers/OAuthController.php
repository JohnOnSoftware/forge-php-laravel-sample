<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Autodesk\Auth\Configuration;
use Autodesk\Auth\OAuth2\TwoLeggedAuth;


class OAuthController extends Controller
{
    public function getAccessToken(){
        try{
            $forge_id     = getenv('FORGE_CLIENT_ID');
            $forge_secret = getenv('FORGE_CLIENT_SECRET');
            
            Configuration::getDefaultConfiguration()
            ->setClientId( $forge_id )
            ->setClientSecret( $forge_secret );
            
            $twoLeggedAuth = new TwoLeggedAuth();
            $scope = ['bucket:create', 'bucket:read', 'data:read', 'data:create', 'data:write'];
            $twoLeggedAuth->setScopes($scope);
            $twoLeggedAuth->fetchToken();
            $token = array(
                'access_token'  => $twoLeggedAuth->getAccessToken(),
                'expires_in'    => $twoLeggedAuth->getExpiresIn(),
            );          
            return response()->json($token, 201);;

        }catch (Exception $e) {
            return response('Exception when calling twoLeggedAuth->getTokenPublic: ' .$e->getMessage() , 500);
        }
    }
}
