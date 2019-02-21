<?php

namespace SIAK\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class MhsController extends Controller
{
  public $url ;
  public function __construct(UrlGenerator $url,Request $req)
  {
     $this->url = $url;
     if ($req->session()->get("level") != "mhs") {
       return redirect('/masuk')->send();
     }
  }
  public function logout(Request $req)
  {
    $req->session()->flush();
    $req->session()->regenerate();
    return redirect('/masuk');
  }
}
