<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFriendController extends Controller
{
    // like store
    public function friend(Request $request, $id)
    {
        \Auth::user()->friend($id);
        return redirect()->back();
    }
    
    // like destroy
    public function unfriend($id)
    {
        \Auth::user()->unfriend($id);
        return redirect()->back();
    }
    
    // zuttomo store
    public function zuttomo(Request $request, $id)
    {
        \Auth::user()->zuttomo($id);
        return redirect()->back();
    }
    
    // zuttomo destroy
    public function unzuttomo($id)
    {
        \Auth::user()->unzuttomo($id);
        return redirect()->back();
    }
    
    // future store
    public function future(Request $request, $id)
    {
        \Auth::user()->future($id);
        return redirect()->back();
    }
    
    // future2 store
    public function future2(Request $request, $id)
    {
        \Auth::user()->future2($id);
        return redirect()->back();
    }
}
