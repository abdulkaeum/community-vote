<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{
    protected $table = 'community_links_votes';

    protected $fillable = ['user_id'];
}
