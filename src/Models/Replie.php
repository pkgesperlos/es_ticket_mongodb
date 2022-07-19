<?php

namespace Esperlos98\EsTicket\Models;

use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class Replie extends Model{
	
    protected $connection = 'mongodb';
    protected $guard_name = 'apiMongo';

    protected $fillable = [
		"title",
		"massage",
		"user_id"
	];

	protected $hidden = [
		"ticket_id",
		"user_id"
	];


	public function image(){
		return $this->morphOne(Image::class,"imageable");
	}

	public function ticket(){
		return $this->belongsTo(Ticket::class);
	}

	public function user(){
		return $this->belongsTo(User::class)->select("username");
	}
}

?>

