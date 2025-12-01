<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all() ;
        return view('dashboard.roles.index' , compact('roles')) ;
    }


    public function create()
    {
        $roles = Role::all() ;
        return view('dashboard.roles.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request ;
        // DB::beginTransaction();
        try{
            $request->validate([
                'role_name' => 'required|string|max:255' ,
                'permissions' => 'required|array' ,
            ]);
            $role = Role::create(['name' => $request->role_name]) ;

            // return $request => عشان تفهم الكود اللي تحت وبرضك خلي بالك فورم باعته ريكوست ازاي
            foreach($request->permissions as $ability => $permission ){
                RoleAbility::create([
                    'role_id' => $role->id ,
                    'ability' => $ability ,
                    'type' => $permission
                ]);
            }
            return redirect()->back()->with(['success' , 'تم الانشاء بنجاح']) ;
            // DB::commit() ;
        }catch(\Exception $e){
            // DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findorfail($id) ;
        $role_abilities = RoleAbility::where('role_id' , $role->id)->get() ;
        return view('dashboard.roles.edit' , compact('role' , 'role_abilities')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
