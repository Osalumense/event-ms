<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'description',
        'bg_image_path',
        'account_id',
        'location_address',
        'location_address_line_1',
        'location_address_line_2',
        'location_country',
        'location_country_code',
        'location_state',
        'location_post_code',
        'location_street_number',
        'post_order_display_message'
    ];

    public static function get($id)
    {
        return Events::find($id);
    }

    public static function getEventCount()
    {
        return Events::count();
    }

    /**
     * 
     * Returns last 5 created events
     * 
     *  @return mixed
     */
    public static function getRecentlyAddedEvent()
    {
        return Events::orderBy('id', 'DESC')->distinct()->limit(5)->get()->toArray();
    }
}
