<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuthController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::paginate(10);
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $request->validate([
        // 'lname'=>'required|string|max:255|unique',
        // 'fname'=>'required|string|max:255|unique',
        // 'mname'=>'string|max:255|',
        // 'email'=>'required|string|email|unique|max:255',
        'password' => 'min:8',
        'confirmpassword' => 'required_with:password|same:password|min:8'
        ]);

        $user = new User();
        $user->lname=$request->lname;
        $user->fname=$request->fname;
        $user->mname=$request->mname;
        $user->role_id=$request->role_id;
        $user->email=$request->email;
        $user->password=bcrypt(request('password'));
        if($user->save()){
            return new UserResource($user);
        }else{
            return message('Invalid');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::FindOrFail($id);
        return new UserResource($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
      return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'lname'=>'required|string|max:255|',
            // 'fname'=>'required|string|max:255|',
            // 'mname'=>'string|max:255|',
            // 'email'=>'required|string|email|unique|max:255',
            'password' => 'min:8',
            'confirmpassword' => 'required_with:password|same:password|min:8'
            ]);

        $user=User::FindOrFail($id);
        $user->lname=$request->lname;
        $user->fname=$request->fname;
        $user->mname=$request->mname;
        $user->role_id=$request->role_id;
        $user->email=$request->email;
        $user -> password = bcrypt(request('password'));
        if($user->save()){
        return new UserResource($user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::FindOrFail($id);
        if($user->delete()){
        return new UserResource($user);
        }
    }
}
