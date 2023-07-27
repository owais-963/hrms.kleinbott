<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $appends = ['profile_image', 'name', 'cover_image', 'last_login', 'last_login2', 'created', 'updated', 'user_address', 'billing_address', 'shipping_address', 'admin_status', 'role'];

    protected $fillable = [
        //Personal Information
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'user_password',
        'country_code',
        'phone',
        'cover',
        'image',
        'about',
        //Address Information
        'address',
        'address2',
        'city',
        'zip_code',
        'state',
        'country',
        //Device Details
        'device_id',
        'device_type',
        //Verification OTPs
        'otp_code',
        'otp_expire_at',
        'otp_attempt',
        'status',
        //Role & Last login Ip
        'role_id',
        'last_login_ip',
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
        'phone_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'otp_expire_at' => 'datetime',
    ];

    public function getUserLoginHistory()
    {
        return $this->hasMany(UserLoginHistory::class, 'user_id', 'id'); //->withDefault();
    }
    public function getUserLastActivity()
    {
        return $this->belongsTo(LoginDetailActivity::class, 'user_id', 'id');
    }

    /**
     * The get Fullname attribute
     *
     * @var array<string, string>
     */
    public function getNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * The get Profile Url attribute
     *
     * @var array<string, string>
     */
    public function getProfileImageAttribute()
    {
        return env('APP_URL') . 'uploads/images/user_profile/' . $this->image;
    }

    /**
     * The get Profile Url attribute
     *
     * @var array<string, string>
     */
    public function getCoverImageAttribute()
    {
        return env('APP_URL') . 'uploads/images/user_cover/' . $this->cover;
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLastLoginAttribute()
    {
        return Carbon::parse($this->last_login_at)->diffForHumans();
    }
    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLastLogin2Attribute()
    {

        return Carbon::parse($this->last_login_at)->format('d M, Y g:i A');
    }
    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getUserAddressAttribute()
    {
        return $this->city . ', ' . $this->state . ', ' . $this->country;
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getBillingAddressAttribute()
    {
        $address = '';
        if (!is_null($this->address)) {
            $address .= $this->address;
        }
        if (!is_null($this->address2)) {
            $address .= ', ' . $this->address;
        }
        if (!is_null($this->city)) {
            $address .= ', ' . $this->city;
        }
        if (!is_null($this->state)) {
            $address .= ', ' . $this->state;
        }
        if (!is_null($this->country)) {
            $address .= ', ' . $this->country;
        }
        if (!is_null($this->zip_code)) {
            $address .= ', ' . $this->zip_code;
        }

        return $address;
    }

    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getShippingAddressAttribute()
    {
        $address = '';
        if (!is_null($this->address)) {
            $address .= $this->address;
        }
        if (!is_null($this->address2)) {
            $address .= ', ' . $this->address;
        }
        if (!is_null($this->city)) {
            $address .= ', ' . $this->city;
        }
        if (!is_null($this->state)) {
            $address .= ', ' . $this->state;
        }
        if (!is_null($this->country)) {
            $address .= ', ' . $this->country;
        }
        if (!is_null($this->zip_code)) {
            $address .= ', ' . $this->zip_code;
        }

        return $address;
    }
    /**
     * The Password attribute should set with Hash
     *
     * @var array<string, string>
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * The email to lower attribute should set
     *
     * @var array<string, string>
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getAdminStatusAttribute()
    {
        switch ($this->status) {
            case (0):
                $status = 'Pending';
                break;
            case (1):
                $status = 'Active';
                break;
            case (2):
                $status = 'Block';
                break;
            default:
                $status = 'Pending';
        }

        return $status;
    }

    public function getRoleAttribute()
    {
        switch ($this->role_id) {
            case (1):
                $role = 'Administrator';
                break;
            case (2):
                $role = 'Admin';
                break;
            case (3):
                $role = 'Customer Support Manager';
                break;
            case (4):
                $role = 'Customer Support';
                break;

            default:
                $role = 'Administrator';
        }

        return $role;
    }

}