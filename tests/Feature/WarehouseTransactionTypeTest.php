<?php

namespace Tests\Feature;

use App\Models\WarehouseTransactionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarehouseTransactionTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_item_warehouse_transaction_types()
    {

        WarehouseTransactionType::factory()->count(3)->create();
        $response = $this->getJson('/api/warehouse-transaction-types');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.warehouse_transaction_types.data')
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'warehouse_transaction_types' => [
                        'current_page',
                        'data' => [
                            '*' => ['id', 'name', 'created_at', 'updated_at']
                        ],
                        'first_page_url',
                        'from',
                        'last_page',

                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_specific_item_warehouse_transaction_type()
    {
        $warehouseTransactionType = WarehouseTransactionType::factory()->create([
            'name' => 'in'
        ]);
        $response = $this->getJson("/api/warehouse-transaction-types/{$warehouseTransactionType->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Success',
                'data' => [
                    'warehouse_transaction_type' => [
                        'name' => 'in',
                        'created_at' => $warehouseTransactionType->created_at->toJSON(),
                        'updated_at' => $warehouseTransactionType->updated_at->toJSON()
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_if_warehouse_transaction_type_not_found()
    {
        $response = $this->getJson('/api/warehouse-transaction-types/999');
        $response->assertStatus(500);
    }

    /** @test */
    public function it_can_create_an_item_warehouse_transaction_type()
    {
        $response = $this->postJson('/api/warehouse-transaction-types', [
            'name' => 'out',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'warehouse transaction type Created successful',
                'data' => [
                    'name' => 'out',
                ]
            ]);

        $this->assertDatabaseHas('warehouse_transaction_types', [
            'name' => 'out',
        ]);
    }

     /** @test */
     public function it_validates_required_fields_when_creating_warehouse_transaction_type()
     {
         $response = $this->postJson('/api/warehouse-transaction-types', []);
 
         $response->assertStatus(422)
             ->assertJsonValidationErrors(['name']);
     }
 
     /** @test */
     public function it_can_update_an_item_warehouse_transaction_type()
     {
         $warehouseTransactionType = WarehouseTransactionType::factory()->create(['name' => 'Old in']);
 
         $response = $this->putJson("/api/warehouse-transaction-types/{$warehouseTransactionType->id}", [
             'name' => 'Updated in',
         ]);
 
         $response->assertStatus(200)
             ->assertJson([
                 'success'=>true,
                 'message'=>'warehouse transaction type updated successful',
                 'data' =>true
             ]);
 
         $this->assertDatabaseHas('warehouse_transaction_types', [
             'id' => $warehouseTransactionType->id,
             'name' => 'Updated in',
         ]);
     }
 
     /** @test */
     public function it_can_delete_an_item_warehouse_transaction_type()
     {
         $warehouseTransactionType = WarehouseTransactionType::factory()->create();
 
         $response = $this->deleteJson("/api/warehouse-transaction-types/{$warehouseTransactionType->id}");
        
         $response->assertStatus(204);
         $this->assertDatabaseMissing('warehouse_transaction_types', ['id' => $warehouseTransactionType->id]);
     }

}
