<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Controller;

use App\User;
use App\User_friend;
use App\Memo;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $memos = $user->memos()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'memos' => $memos,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        // $memos = $user->memos()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
        //     'memos' => $memos,
        ];
        
        $data += $this->counts($user);
        
        return view('users.edit', $data);
        
        
    }
    
    public function friends($id)
    {
        $user = User::find($id);
        $friends = $user->friends()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $friends,
        ];

        $data += $this->counts($user);

        return view('users.friends', $data);
    }
    
    
    // zuttomo
    public function zuttomoings($id)
    {
        $user = User::find($id);
        $zuttomoings = $user->zuttomoings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $zuttomoings,
        ];

        $data += $this->counts($user);

        return view('users.zuttomoings', $data);
    }
    
    // future
    public function futures($id)
    {
        // usersテーブルの中から、【Judy】を取得し、$userに格納
        $user = User::find($id);
        // $userに格納された【Judy】をフレンドしている人たちを$futuresに格納→【Jet】と【Yuki】
        
        // $futures = $user->futures()->paginate(10);
        
        // zuttomoしたらzuttomoタブに飛ばせる＆自分がfriendしてない人は出ない
        $futures = User_friend::join('users','users.id','=','user_friend.friend_id')
                    ->select()
                    ->where('user_id',$id)
                                 ->paginate(10);
                                 
        // $futures1 = User_friend::join('users','users.id','=','user_friend.friend_id')
        //             ->select()
        //             ->where('user_id',$id)
        //                          ->paginate(10);
                                 
        // $futures2 = User_friend::join('users','users.id','=','user_zuttomo.zuttomo_id')
        //             ->select()
        //             ->where('user_id',$id)
        //                          ->paginate(10);
        
        // $userに格納された【Judy】がフレンドしている人たちを$friendsに格納→【Jet】
        // $friends = $user->friends()->paginate(10);
        //user_friendテーブルの中から、【Judy】がフレンドしている人たちを$hogeに格納→【Jet】(※でもuser_friendテーブルのデータ形式じゃ使えない)
        // $hoge = User_friend::all()->where('user_id', '=', '$id');
        
        // $hogehoge = array_diff($futures, $friends);
        // $key = array_search('id', $friends);
        // $friendsのidと$futuresのuser_idが一致していれば取得したい
        // $hogeのfriend_idと$futuresのuser_idが一致していれば取得したい
        // $sougo = $futures->where('user_id', '=', '$friends['id']);
        
        
        
        // $futures = $user->futures()->where('friend_id', '=', $id)->get();
        $user2 = User::find($id);

        $data = [
            'user' => $user,
            'users' => $futures,
            
            // 'users' => $futures1||$futures2,
        ];
        
        $futures2 = DB::table('user_zuttomo')->join('users','users.id','=','user_zuttomo.zuttomo_id')
                    ->select()
                    ->where('user_id',$id)
                                 ->paginate(10);
        dd($user);
        $data2 = [
            'user' => $user2,
            'users' => $futures2,
            
            // 'users' => $futures1||$futures2,
        ];

        $data += $this->counts($user);

        // ここがおかC
        return view('users.futures', $data,$data2);
        
    }
    
    // public function futures($id)
    // {
    //     $user = User::find($id);
    //     $futures = $user->futures()->where('user_id', '=', $id);

    //     $data = [
    //         'user' => $user,
    //         'users' => $futures,
    //     ];

    //     $data += $this->counts($user);

    //     return view('users.futures', $data);
    // }
    
    
//     public function futures($id)
    // {
//         $user = User::select();
// // dd($user);
//         return view('users.futures', $user);
        
    // }    
        
        
        
        // $users = DB::table('users')->get();

        // return view('users.futures', ['users' => $users]);
    
    
    // future2
    public function futures2($id)
    {
        // usersテーブルの中から、【Judy】を取得し、$userに格納
        $user2 = User::find($id);
        
        // zuttomoしたらzuttomoタブに飛ばせる＆自分がfriendしてない人は出ない
        $futures2 = User_zuttomo::join('users','users.id','=','user_zuttomo.zuttomo_id')
                    ->select()
                    ->where('user_id',$id)
                                 ->paginate(10);

        $data = [
            'user' => $user2,
            'users' => $futures2,
            // 'users' => $futures1||$futures2,
        ];

        $data += $this->counts($user2);

        return view('users.futures2', $data);
    }
    
    
}
