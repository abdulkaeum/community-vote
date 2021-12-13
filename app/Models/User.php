<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean'
    ];

    /*check if the user is an admin*/
    public function isAdmin()
    {
        return $this->admin;
    }

    public function votedFor(CommunityLink $communityLink)
    {
        return $communityLink->votes->contains('user_id', $this->id);
    }

    public function voteFor(CommunityLink $communityLink)
    {
        return $this->votes()->attach($communityLink);
    }

    public function toggleVote(CommunityLink $communityLink)
    {
        $this->votes()->toggle($communityLink);
    }

    /*Relations*/
    public function votes()
    {
        return $this->belongsToMany(CommunityLink::class, 'community_links_votes')
            ->withTimestamps();
    }
}
