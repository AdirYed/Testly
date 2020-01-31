<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InboundEmail
 *
 * @property int $id
 * @property string $message_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InboundEmail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InboundEmail extends \BeyondCode\Mailbox\InboundEmail
{
    //
}
