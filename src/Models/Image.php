<?php

namespace Esperlos98\EsTicket\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Image extends Model{

    protected $connection = 'mongodb';

    protected $fillable = [
		"url"
	];

	protected $hidden = ["_id","created_at","updated_at","imageable_id","imageable_type"];

	public function imageable(){
		return $this->morphTo();	
	}	
	
}

?>

