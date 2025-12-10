<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $fillable = ['name'] ;


    protected static function createWithPermission($request)
    {
        try{
            DB::beginTransaction();
            $role = Role::create(['name' => $request->name ]);

            foreach($request->permissions as $permission => $value){
                RoleAbility::create([
                    'role_id' => $role->id ,
                    'ability' => $permission ,
                    'type' => $value // allow or deny
                ]);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack() ;
            throw $e ;
        }
    }

    protected static function updateWithPermission($request , $role)
    {
        try{
            DB::beginTransaction();
            $role->update(['name' => $request->name ]);

            foreach($request->permissions as $permission => $value){
                RoleAbility::updateOrCreate([
                    'role_id' => $role->id ,
                    'ability' => $permission ,
                ],[
                    'role_id' => $role->id ,
                    'ability' => $permission ,
                    'type' => $value // allow or deny
                ]);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack() ;
            throw $e ;
        }
    }


    public function permissions()
    {
        return $this->hasMany(RoleAbility::class, 'role_id');
    }

}
