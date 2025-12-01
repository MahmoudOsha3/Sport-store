<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role' ,
        'address' ,
        'phone' ,
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // local scope
    public function scopeSearch(Builder $builder ,$request)
    {
        $builder->when($request->search, function($builder , $search){
            $builder->whereAny(['name' , 'email' , 'phone' , 'role' ], 'like' , "%{$search}%" ) ;
        });
    }

    public function isOwner() : bool
    {
        return $this->role === 'owner' ;
    }

    public function isSperAdmin() : bool
    {
        return $this->role === 'super_admin' ;
    }



    // public function scopeSearch(Builder $builder ,$request )
    // {
    //     $builder->when($request->search , function ($builder , $search){
    //         $builder->whereAny(['name' , 'email' , 'phone' , 'role' ] , 'like' ,"%{$search}%") ;
    //     });
    // }
}
