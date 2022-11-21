<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Tickets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'account_id',
        'user_id',
        'event_id',
        'price',
        'quantity_available',
        'quantity_sold'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function get($id)
    {
        return Tickets::find($id);
    }

    public static function getTicketsCount()
    {
        return Tickets::count();
    }

    public static function getEventTickets($eventId)
    {
        $userId = Auth::user()->id;
        return Tickets::where([
            'event_id' => $eventId,
            'user_id' => $userId,
        ])->orderBy('id', 'DESC')->get()->toArray();
    }

    public static function getEventTicketsByEventIdAndUserId($eventId, $userId)
    {
        return Tickets::where([
            'event_id' => $eventId,
            'user_id' => $userId,
        ])->orderBy('id', 'DESC')->get()->toArray();
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255|string',
            'price' => 'required|numeric',
            'event_id' => 'required|numeric',
            'quantity_available' => 'required|numeric',
        ];
    }

    public function edit()
    {
        $postData = request()->except(['id']);
        unset($postData['_token']);
        $postData['user_id'] = Auth::user()->id;
        $postData['account_id'] = Auth::user()->account_id;
        $this->forceFill($postData);
        $this->save();
    }


}
