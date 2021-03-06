<?php

namespace Quidmye\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Quidmye\Models\Token;

class TokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web', 'auth']);
    }

    public function save(Request $request){
      $token = Token::create([
        'token' => $request->get('token'),
        'user_id' => \Auth::user()->id
      ]);


      return $token;
    }


}
