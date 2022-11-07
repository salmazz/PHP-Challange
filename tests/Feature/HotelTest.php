<?php

namespace Tests\Feature;

use App\Helpers\HttpStatus;
use App\Http\Controllers\API\HotelController;
use App\Http\Resources\CityResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\RoomResource;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use App\Services\Hotel\HotelService;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;
    use ResponseTrait;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $user;
    private $country;
    private $city;
    private $hotel;
    private $room;
    private $roomType;

    /**
     * @var \Illuminate\Testing\TestResponse
     */
    private $response;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->country = Country::factory()->create();
        $this->city = City::factory()->create();
        $this->hotel = Hotel::factory()->create();
        $this->roomType = RoomType::factory()->create();
        $this->room = Room::factory()->create();
    }

    /**
     * Test that database table of hotel expected that columns
     */
    public function HotelsDatabaseHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('hotels', [
               'id', 'city_id', 'name','rating', 'description'
            ]), 1);
    }

    /**
     * test City Has Many hotels
     */
    public function testCityHasManyHotels()
    {
        $this->assertInstanceOf(City::class, $this->city->load('hotels'));
        $this->assertEquals(1, $this->city->load('hotels')->count());
    }

    /**
     * Test Created a hotel with authenticated
     */
    public function testStatus201WithMessageCreatedWhenCreateAHotelWhenAuthenticated()
    {
        $this->withExceptionHandling();
        $response = $this->actingAs($this->user)->post("/api/hotels", ['name' => $this->hotel->name,
            'description' => $this->hotel->description, 'city_id' => $this->hotel->city_id
        ]);
        $response->assertOk();
        $response->assertJson(["message" => "Hotel Stored Successfully"]);
    }



    /**
     * Test Name is required
     */
    public function testNameIsRequired()
    {
        $response = $this->actingAs($this->user)->postJson(
            action([HotelController::class, 'store']),
            ['description'=> 'Description', 'city_id' => 1]
        );

        $response->assertStatus(HttpStatus::HTTP_VALIDATION_ERROR)
            ->assertJsonStructure(['message', 'errors' => ['name']]);
    }

    /**
     * Test Description is required
     */
    public function testDescriptionIsRequired()
    {
        $response = $this->actingAs($this->user)->postJson(
            action([HotelController::class, 'store']),
            ['name'=> 'Stars Hotel', 'city_id' => 1]
        );

        $response->assertStatus(HttpStatus::HTTP_VALIDATION_ERROR)
            ->assertJsonStructure(['message', 'errors' => ['description']]);
    }

    /**
     * Test city id is required
     */
    public function testCityIdIsRequired()
    {
        $response = $this->actingAs($this->user)->postJson(
            action([HotelController::class, 'store']),
            ['name' => 'Starts Hotels', 'description'=> 'Description']
        );

        $response->assertStatus(HttpStatus::HTTP_VALIDATION_ERROR)
            ->assertJsonStructure(['message', 'errors' => ['city_id']]);
    }


    /**
     * test rating is max is 5
     */
    public function testRatingIsMaxIs5()
    {
        $response = $this->actingAs($this->user)->postJson(
            action([HotelController::class, 'store']),
            [
                'name' => 'Stars Hotel',
                'description' => 'Stars description',
                'city_id' => 1,
                'rating' => 6
            ]
        );

        $response->assertStatus(HttpStatus::HTTP_VALIDATION_ERROR)
            ->assertJsonStructure(['message', 'errors' => ['rating']]);
    }

    /**
     * Test has model reterived data successfully
     *
     * @return void
     */
    public function testThatHotelHasReterivedData()
    {
        $response = $this->actingAs($this->user)->get('/api/hotels');

        $response->assertStatus(HttpStatus::HTTP_OK);
        $response->assertSee($this->hotel->name);
    }

    /**
     * Test Redirect to login if not authenticated
     *
     * @return void
     */
    public function testRedirectToLoginIfNotAuthenticated()
    {
        $response = $this->post('/api/hotels', $this->data());
        $response->assertStatus(302);
        $response->assertRedirect('/api/login');
    }

    /**
     * Test page is have hotel name selected in search
     *
     * @return void
     */
    public function testThatHasMakeSearchWithName()
    {
        $name = Hotel::value('name');

        $response = $this->actingAs($this->user)->json('GET', '/api/hotels', ['name' => $name]);

        $response->assertOk();
        $response->assertJsonFragment(['name' => $name]);
    }

    /**
     * Test can show hotel
     *
     * @throws \Exception
     */
    public function testCanShowHotel()
    {
        $hotelModel = new HotelService(new Hotel);
        $result = $hotelModel->find($this->hotel->id);
        $this->assertInstanceOf(Hotel::class, $result);
        $this->assertEquals($result->name, $this->hotel->name);
        $this->assertEquals($result->description, $this->hotel->description);
        $this->assertEquals($result->rating, $this->hotel->rating);
    }


    /**
     * Test Can Update a hotel with authentication
     */
    public function testUpdateAHotelWhenAuthenticated()
    {
        $this->hotel->description = "Updated Description";

        $response = $this->actingAs($this->user)->patch("/api/hotels/" . $this->hotel->id, $this->hotel->toArray());

        $this->assertDatabaseHas('hotels', ['id' => $this->hotel->id, 'description' => 'Updated Description']);

        $response->assertOk();

        $response->assertJson(["message" => "Hotel Updated Successfully"]);
    }

    private function data($data = [])
    {
        $default = [
            "name" => "Gewel Hotel",
            "description" => "Gewel Hotel description",
            "city_id" => $this->city->id,
        ];
        return array_merge($default, $data);
    }

    /**
     * Test Hotel can be deleted
     */
    public function testHotelCanBeDeleted()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user)->delete(route('hotels.destroy', ['hotel' => $this->hotel->id]));
        $this->assertDatabaseMissing('hotels', ['name' => $this->hotel->name]);
    }
}
