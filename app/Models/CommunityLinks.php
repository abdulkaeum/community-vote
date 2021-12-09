<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'channel_id', 'title', 'link', 'approved'];

    /*CommunityLink store methods*/
    public static function fromUser(User $user)
    {
        // create new instance of CommunityLink
        $comLink = new static;

        // pass and set user id
        $comLink->user_id = $user->id;

        // check if current user is an admin
        if($user->isAdmin()){
            // set approved on the current instance
            $comLink->approve();
        }

        // return the new instance
        return $comLink;
    }
    public function contribute($attributes)
    {
        // chained to fromUser() (now instance)
        // fill the model with rest of the attributes and persist it to the db
        return $this->fill($attributes)->save();
    }

    public function approve()
    {
        // set approve and return current instance
        $this->approved = true;

        return $this;
    }

    /*Relations*/
    public function creater()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channels::class);
    }
}
