<?php 

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

	use DatabaseMigrations;

	/** @test */
	public function a_user_can_read_all_users(){
		$user = factory('App\UserDetails')->create();

		$response = $this->get('/maintenance/user');

		$response->assertSee(200);
	}

	/** @test */
	public function authenticated_user_can_create_users(){
		$this->actingAs(factory('App\UserDetails')->create());

		$user = factory('App\UserDetails')->make();
		$this->post('/user/add',$user->toArray());

		$this->assertEquals(1,App\UserDetails::all()->count());
	}

}