<?php

namespace Esperlos98\EsTicket\Lib\Config;

class ValidateOptions{

	const VALIDATE = [

    	"TICKET_STORE" =>[
			"image"=> "mimes:jpeg,jpg,png,gif|max:50000",
			"title"=>"required",
			"description"=> "required"	
		],
		"REPLIE_STORE" =>[
			"image"=> "mimes:jpeg,jpg,png,gif|max:50000",
			"title" => "required",
			"massage" => "required"
		],
		"MASSAGES" =>[
			"required" => 601,
			"mimes" => 610,			
		]		
    ];
}
