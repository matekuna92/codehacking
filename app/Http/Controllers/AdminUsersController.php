<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\EditUsersRequest;
use Illuminate\Support\Facades\Session;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::lists('name','id')->all(); // pulling out information
        // lists csak egy array-t kap, és nem ad vissza .. de az all() vissza is adja

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        // create condition if password is empty

        if(trim($request->pasword) == '') // whitespace miatt
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        // csak teszteljük, hogy ad e vissza egyáltalán valamit a form, ha a gombra kattintva elküldjük
       // return $request->all();

        /*User::create($request->all());
        return redirect('/admin/users');*/

        /*Form tesztadatot küld vissza arrayként.... -> php artisan make:request UsersRequest : A requestben megadjuk a
        formhoz szükséges REQUIRED adatokat rules() function-nél, ... majd AdminUsersController-ben a store function mostmár egy
        UsersRequest-et vár.. ez alapján ellenőrzi, megadtunk e mindent a formban, ami required
        FENT IMPORTÁLNI MERT NEM TALÁLJA ANÉLKÜL !!!!! */



        if ($file = $request->file('photo_id')) // HA VAN KÉP
            // //a users. create blade-ben át kellett írni az eredeti file-t photo_id-ra hogy megtalálja..
        {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name); // public / images folder-be teszi !
            $photo = Photo::create(['file'=>$name]); // amikor létrehoztuk, ez a photo id elérhető -> ezt használjuk fel a következő sorban
            $input['photo_id'] = $photo->id;
        }

        //$input['password'] = bcrypt($request->password);



        User::create($input);

        return redirect('/admin/users');

            //return "photo exists";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);

        // edit oldalon "Unsupported operand types" error miatt ide kell ez a sor is + roles-t is átadjuk a compactnak.. ?????

        $roles = Role::lists('name','id')->all();

        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUsersRequest $request, $id)
    {
        // test if we recive data
        //return $request->all();

        $user = User::findOrFail($id);

        if(trim($request->pasword) == '') // whitespace miatt
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deleting users
        $user = User::findOrFail($id);
        // kép törlése
        if(isset($user->photo->file))
        {
            unlink(public_path() . $user->photo->file);
        }
        $user->delete();

        Session::flash('deleted_user','The user has been deleted!');

        return redirect('/admin/users');
    }
}
