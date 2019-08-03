<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * model table
     * @var string
     */
    protected $table = 'tasks';
    /**
     * table primary key
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * table columns and model's attributes
     * @var array
     */
    protected $fillable = ['content', 'start_date', 'end_date', 'image', 'user_id'];

    /**
     * task's users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
