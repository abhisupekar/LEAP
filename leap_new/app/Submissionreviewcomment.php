<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submissionreviewcomment extends Model
{
    protected $table = 'submission_review_comments';

    public function users() {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
