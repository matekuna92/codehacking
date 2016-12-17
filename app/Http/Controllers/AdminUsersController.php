<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;

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
        // csak teszteljük, hogy ad e vissza egyáltalán valamit a form, ha a gombra kattintva elküldjük
       // return $request->all();

        /*User::create($request->all());
        return redirect('/admin/users');*/

        /*Form tesztadatot küld vissza arrayként.... -> php artisan make:request UsersRequest : A requestben megadjuk a
        formhoz szükséges REQUIRED adatokat rules() function-nél, ... majd AdminUsersController-ben a store function mostmár egy
        UsersRequest-et vár.. ez alapján ellenőrzi, megadtunk e mindent a formban, ami required
        FENT IMPORTÁLNI MERT NEM TALÁLJA ANÉLKÜL !!!!! */

        $input = $request->all();

        if ($file = $request->file('photo_id')) // HA VAN KÉP
            // //a users. create blade-ben át kellett írni az eredeti file-t photo_id-ra hogy megtalálja..
        {
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name); // public / images folder-be teszi !
            $photo = Photo::create(['file'=>$name]); // amikor létrehoztuk, ez a photo id elérhető -> ezt használjuk fel a következő sorban
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);

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
        return view('admin.users.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
