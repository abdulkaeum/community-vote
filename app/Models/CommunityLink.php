<?php

namespace App\Models;

use App\Exceptions\DuplicateCommunityLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'channel_id', 'title', 'link', 'approved'];

    /* filter the results via a channel */
    public function scopeForChannel($query, $channel)
    {
        $query->when($channel, fn($query, $channel) => $query
            ->where('channel_id', $channel->id)
        );
    }

    /*CommunityLink store methods*/
    public static function fromUser(User $user)
    {
        // create new instance of CommunityLink
        $comLink = new static;

        // pass and set user id
        $comLink->user_id = $user->id;

        // check if current user is an admin
        if ($user->isAdmin()) {
            // set approved on the current instance
            $comLink->approve();
        }

        // return the new instance
        return $comLink;
    }

    public function contribute($attributes)
    {
        // check if we need to update (timestamps) a link if another supplied
        if ($linkExists = $this->linkAlreadySubmitted($attributes['link'])) {
            // retrieve model and update the timestamps
            $linkExists->touch();

            throw new DuplicateCommunityLink;
        }

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

    protected function linkAlreadySubmitted($link)
    {
        // check to see if a link already exists
        return static::where('link', $link)->first();
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

    public function votes()
    {
        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }
}
