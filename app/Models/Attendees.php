<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'ticket_id',
        'user_id',
        'account_id',
        'order_id',
        'account_id',
        'first_name',
        'last_name',
        'email'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function get($id)
    {
        return Attendees::find($id);
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            'event_id' => 'required|numeric',
            'ticket_id' => 'numeric',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
        ];
    }

    public function edit()
    
    {
        $postData = request()->except(['id']);
        unset($postData['_token']);
        $this->forceFill($postData);
        $this->save();
    }

    public function tickets()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'id');
    }
}