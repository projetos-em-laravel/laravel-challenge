<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Event.
 *
 * @package namespace App\Models;
 */
class Event extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'description', 'start_date', 'end_date', 'start_time', 'end_time'];

    public function User(){
        return $this-HasOne('Event::class');
    }

    public function getStartTime($value){
        return Carbon::createFromFormat('H:i', $value);
    }
}
