<?php
namespace App;

class Param extends \Jenssegers\Mongodb\Eloquent\Model {

    protected $collection = 'params';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'key',
    ];

    public static function getTypes()
    {
       return [
         'integer' => 'Integer',
         'float' => 'Float',
         'text' => 'Text',
       ];
    }

    public static function getParamsArray(){
        $params = Param::all();

        $result = [];

        foreach ($params as $param) {
            $result[$param->id] = $param->title;
        }

        return $result;
    }
}
