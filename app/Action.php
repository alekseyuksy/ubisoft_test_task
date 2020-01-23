<?php
namespace App;

class Action extends \Jenssegers\Mongodb\Eloquent\Model {

    protected $collection = 'actions';

    protected $fillable = [
      'user','event', 'amount', 'description'
    ];
}
