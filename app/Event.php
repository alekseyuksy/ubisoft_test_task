<?php
namespace App;

class Event extends \Jenssegers\Mongodb\Eloquent\Model {

    public   $rules = [
        'key' => 'required|unique:events',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'key',
    ];

    public static function getEventsArray(){
        $events = Event::all();

        $result = [];

        foreach ($events as $event){
            $result[$event->key] = $event->title;
        }

        return $result;
    }
}
