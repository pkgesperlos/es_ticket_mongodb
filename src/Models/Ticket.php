<?php

namespace Esperlos98\EsTicket\Models;

use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class Ticket extends Model{
	
    protected $connection = 'mongodb';

    protected $fillable = [
		"title",
		"description",
		"status"
	];

    protected $hidden = [
	];

	public function image(){
		return	$this->morphOne(Image::class,"imageable");
	}

	public function replies(){
		return $this->hasMany(Replie::class)->with(["image","user"]);
	}

	public function user(){
		return $this->belongsTo(User::class)->select(["username"]);
	}
}

?>

