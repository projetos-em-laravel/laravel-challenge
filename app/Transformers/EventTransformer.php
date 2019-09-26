<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Event;

/**
 * Class EventTransformer.
 *
 * @package namespace App\Transformers;
 */
class EventTransformer extends TransformerAbstract
{
    /**
     * Transform the Event entity.
     *
     * @param \App\Models\Event $model
     *
     * @return array
     */
    public function transform(Event $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
