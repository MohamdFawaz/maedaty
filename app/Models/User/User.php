<?php

namespace App\Models\User;

use App\Models\Shop\Shop;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\SocialLogin\SocialLogin;
use App\Models\Address\Address;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    protected $with = ['socialaccount','shop'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','phone','location','lat','lng','lang','firebase_token','role_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function getUserImageAttribute($value)
    {
        if ($value) {

            return asset('public/images/profile/' . $value);
        } else {
            return asset('public/images/profile/no-image.jpg');
        }
    }

    public function getFirstNameAttribute($value)
    {
      return ucwords($value);
    }

    public function getFullNameAttribute()
    {
      return ucwords($this->first_name)." ".ucwords($this->last_name);
    }

    public function setUserImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/profile/'),$img_name);
            $this->attributes['user_image'] = $img_name ;
        }
    }

    public function socialaccount(){
        return $this->hasOne(SocialLogin::class, 'user_id');
    }

    public function address(){
        return $this->hasMany(Address::class, 'user_id');
    }

    public function shop(){
        return $this->hasOne(Shop::class, 'user_id');
    }

    public function getActionAttribute()
    {
        $action = "";
        if ($this->status == 1) {
            $action .=  "<label class='switch switch-small' >
                    <input type='checkbox' checked='' value='$this->status'  id='$this->id' class='status'>
                    <span></span>
                    </label>";
        } else {
            $action .=  "<label class='switch switch-small'>
                    <input type='checkbox'  value='$this->status' id='$this->id' class='status'>
                    <span></span>
                    </label>";
        }
        $action .= "<a href=".url()->current()."/".$this->id.">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
//        $action .= '<a href="#" class="mb-control delete-user-btn" data-name="'.$this->first_name.'" data-id="'.$this->id.'"> <button  class="btn btn-danger btn-condensed " ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }

    public function getAdminActionAttribute(){
        $action = "";
        $action .= "<a href=".url()->current()."/".$this->id."/edit".">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
                    </a>";
        $action .= '<a href="#" class="mb-control delete-admin-btn" data-name="'.$this->first_name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';
        $action .= "";

        return $action;
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 1) {

            return "<span class=\"label label-success label-form\" id='label-$this->id'>".trans('backend.user.not_suspended')."</span>";
        } else {
            return "<span class=\"label label-danger label-form\" id='label-$this->id'>".trans('backend.user.suspended')."</span>";
        }
    }

}
