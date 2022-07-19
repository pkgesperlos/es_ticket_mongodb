<?php

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ReplieTest extends TestCase{

	use WithFaker;

	/**  @test */
	public function store(){
		$user = $this->user();
		$ticket = $this->ticket($user);
	
		$this->be($user);
		
		$response = $this->json("POST",config("url")."/es/api/v1/ticket/replies/".$ticket->id,[
			"title"=>$this->faker->title,
			"massage" =>$this->faker->realText	
		]);

		return $response->assertOk();	
	}

	protected function user(){
		$user = User::create([
			"username" => $this->faker->userName,
			"phone"  => $this->faker->phoneNumber,
			"email" => $this->faker->email,
		]);

		return $user;
	}

	protected function ticket($user){
		$ticket = User::find($user->id)->tickets()->
			create([
				"title"=>$this->faker->title,
				"description"=>$this->faker->text,
				"status" => true
				
			]);
		
		return $ticket;
	}
}	
?>


