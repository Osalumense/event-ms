<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        'user_id',
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

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function get($id)
    {
        return Events::find($id);
    }

    public static function getEventCount()
    {
        return Events::count();
    }

    public static function getUserEventCount($userId)
    {
        return Events::where('user_id', $userId)->count();
    }

    public static function getUserEvents()
    {
        $userId = Auth::user()->id;
        return Events::where('user_id', $userId)->orderBy('id', 'DESC')->get()->toArray();
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

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'bg_image_path' => 'file|image|mimes:jpeg,png,gif,webp',
            'start_date' => '',
            'end_date' => '',
            'account_id' => '',
            'location_address' => 'required|string',
            'location_address_line_1' => 'required|string',
            'start_date' => 'date_format:Y-m-d H:i',
            'end_date' => 'date_format:Y-m-d H:i|after:start_date',
            'location_country' => 'string',
            'location_country_code' => 'numeric',
            'location_state' => 'string',
            'location_post_code' => 'string',
            'location_street_number' => 'string',
            'post_order_display_message' => 'string',
        ];
    }

    public function edit()
    {
        $postData = request()->except(['id']);
        unset($postData['_token']);
        unset($postData['bg_image_path']);
        $postData['slug'] = Str::slug($postData['title']);
        $postData['user_id'] = Auth::user()->id;
        $postData['account_id'] = Auth::user()->account_id;
        $this->forceFill($postData);
        $this->save();

        $event = Events::get($this->id);
        if ($event instanceof Events) {
            $image = request()->file('bg_image_path');
            if(!empty($image)){
                $filename = $postData['slug'] . '.' . $image->getClientOriginalExtension();
                $event->bg_image_path = $filename;
                $image->move('images/events/', $filename);
                $event->save();
            }
            
        }
    }

    /**
     * Get last 5 created events
     *
     * @return void
     */
    public static function getRecentlyCreatedEvents()
    {
        $userId = Auth::user()->id;
        return Events::where('user_id', $userId)->orderBy('id', 'DESC')->distinct()->limit(5)->get()->toArray();
    }

    /**
     * Return event by slug
     *
     * @param str $slug
     * @return void
     */
    public static function getActiveEventBySlug($slug)
    {
        return Events::where([
            'slug' => $slug,
            'is_active' => 1,
        ])->get()->toArray();
    }

    public static function getEventBySlug($slug)
    {
        $userId = Auth::user()->id;
        return Events::where([
            'slug' => $slug,
            'user_id' => $userId,
        ])->get()->toArray();
    }

    /**
     * Publish event
     *
     * @param [type] $id
     * @return void
     */
    public static function publishEvent($id)
    {
        $event = self::get($id);
        $event->is_active = 1;
        return $event;
    }
}
