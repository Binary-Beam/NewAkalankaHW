<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Pktharindu\NovaPermissions\Traits\HasRoles;
use App\Traits\CreatedUpdatedBy;

class User extends Authenticatable
{
    use LogsActivity, HasRoles, HasApiTokens, HasFactory, Notifiable, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()->logOnly(['*']);
    }

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function scopeOnlyAdmins(Builder $builder) {
        return $builder->withRoles()->whereHas('roles', function (Builder $query) {
            $query->whereId(1);
        });
    }

    public function scopeOnlyUsers(Builder $builder) {
        return $builder->withRoles()->whereHas('roles', function (Builder $query) {
            $query->whereId(2);
        });
    }

    public function scopeOnlyAuditors(Builder $builder) {
        return $builder->withRoles()->whereHas('roles', function (Builder $query) {
            $query->whereId(3);
        });
    }

    public function scopeOnlyVendors(Builder $builder) {
        return $builder->withRoles()->whereHas('roles', function (Builder $query) {
            $query->whereId(4);
        });
    }

    public function scopeIsAdmin() {
        return $this->roles->contains('id', 1);
    }

    public function scopeIsUser() {
        return $this->roles->contains('id', 2);
    }

    public function scopeIsAuditor() {
        return $this->roles->contains('id', 3);
    }

    public function scopeIsVendor() {
        return $this->roles->contains('id', 4);
    }
}
