<?php

namespace Tests\Feature;

use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarehouseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_warehouses()
    {

        Warehouse::factory()->count(3)->create();

        $response = $this->getJson('/api/warehouses');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.warehouses.data')
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'warehouses' => [
                        'current_page',
                        'data' => [
                            '*' => ['id', 'name', 'location', 'created_at', 'updated_at']
                        ],
                        'first_page_url',
                        'from',
                        'last_page',
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_specific_item_category()
    {
        $warehouse = Warehouse::factory()->create([
            'name' => 'store1',
            'location' => 'test'
        ]);
        $response = $this->getJson("/api/warehouses/{$warehouse->id}");
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Success',
                'data' => [
                    'warehouse' => [
                        'id' => $warehouse->id,
                        'name' => $warehouse->name,
                        'location' => $warehouse->location,
                        'created_at' => $warehouse->created_at->toJSON(),
                        'updated_at' => $warehouse->updated_at->toJSON()
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_if_category_not_found()
    {
        $response = $this->getJson('/api/warehouses/999');
        $response->assertStatus(500);
    }

    /** @test */
    public function it_can_create_an_item_category()
    {
        $response = $this->postJson('/api/warehouses', [
            'name' => 'store1',
            'location' => 'test'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'warehouse Created successful',
                'data' => [
                    'name' => 'store1',
                    'location' => 'test'
                ]
            ]);

        $this->assertDatabaseHas('warehouses', [
            'name' => 'store1',
            'location' => 'test'
        ]);
    }

     /** @test */
     public function it_validates_required_fields_when_creating_category()
     {
         $response = $this->postJson('/api/warehouses', []);

         $response->assertStatus(422)
             ->assertJsonValidationErrors(['name','location']);
     }

     /** @test */
     public function it_can_update_an_item_category()
     {
         $warehouse = Warehouse::factory()->create(['name' => 'Old Name','location'=>'adraa']);
       
         $response = $this->putJson("/api/warehouses/{$warehouse->id}", [
             'name' => 'Updated Name',
             'location' => 'Updated Name',
         ]);

         $response->assertStatus(200)
             ->assertJson([
                 'success'=>true,
                 'message'=>'warehouse updated successful',
                 'data' => [
                     'id' => $warehouse->id,
                     'name' => 'Updated Name',
                     'location' => 'Updated Name',
                 ]
             ]);

         $this->assertDatabaseHas('warehouses', [
             'id' => $warehouse->id,
             'name' => 'Updated Name',
             'location' => 'Updated Name',
         ]);
     }

     /** @test */
     public function it_can_delete_an_item_category()
     {
         $category = Warehouse::factory()->create();

         $response = $this->deleteJson("/api/warehouses/{$category->id}");

         $response->assertStatus(204);
         $this->assertDatabaseMissing('warehouses', ['id' => $category->id]);
     }

}
