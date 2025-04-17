<?php

namespace Tests\Feature;

use App\Models\InTransaction;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\WarehouseTransaction;
use App\Models\WarehouseTransactionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarehouseTransactionTest extends TestCase
{
    use RefreshDatabase;

    protected $warehouse, $item, $inType, $outType;

    protected function setUp(): void
    {
        parent::setUp();


        $this->warehouse = Warehouse::factory()->create();
        $this->item = Item::factory()->create();
        $this->inType = WarehouseTransactionType::factory()->create(['name' => 'in']);
        $this->outType = WarehouseTransactionType::factory()->create(['name' => 'out']);
    }

    /** @test */
    public function it_can_create_an_inbound_transaction()
    {
        $response = $this->postJson('/api/warehouse/transactions', [
            'warehouse_id' => $this->warehouse->id,
            'transaction_type_id' => $this->inType->id,
            'items' => [
                [
                    'item_id' => $this->item->id,
                    'quantity' => 10,
                    'comment' => 'stock'
                ]
            ]
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('warehouse_transactions', [
            'warehouse_id' => $this->warehouse->id,
            'transaction_type_id' => $this->inType->id
        ]);

        $this->assertDatabaseHas('in_transactions', [
            'item_id' => $this->item->id,
            'quantity' => 10
        ]);
    }


    /** @test */
    public function it_can_create_an_outbound_transaction()
    {

        WarehouseTransaction::factory()
            ->has(InTransaction::factory()->state([
                'item_id' => $this->item->id,
                'quantity' => 20
            ]), 'inTransactions')
            ->create([
                'warehouse_id' => $this->warehouse->id,
                'transaction_type_id' => $this->inType->id
            ]);

    
        $response = $this->postJson('/api/warehouse/transactions', [
            'warehouse_id' => $this->warehouse->id,
            'transaction_type_id' => $this->outType->id,
            'items' => [
                [
                    'item_id' => $this->item->id,
                    'quantity' => 5,
                    'comment' => 'Order fulfillment'
                ]
            ]
        ]);

        $response->dump();

        $response->assertStatus(201);
            

        $this->assertDatabaseHas('warehouse_transactions', [
            'transaction_type_id' => $this->outType->id
        ]);

        $this->assertDatabaseHas('out_transactions', [
            'item_id' => $this->item->id,
            'quantity' => 5
        ]);
    }

    /** @test */
    public function it_fails_when_outbound_exceeds_available_stock()
    {
        
        WarehouseTransaction::factory()
            ->hasInTransactions(1, [
                'item_id' => $this->item->id,
                'quantity' => 10
            ])
            ->create([
                'warehouse_id' => $this->warehouse->id,
                'transaction_type_id' => $this->inType->id
            ]);

        $response = $this->postJson('/api/warehouse/transactions', [
            'warehouse_id' => $this->warehouse->id,
            'transaction_type_id' => $this->outType->id,
            'items' => [
                [
                    'item_id' => $this->item->id,
                    'quantity' => 15, 
                    'comment' => 'Overselling attempt'
                ]
            ]
        ]);

        $response->assertStatus(400);

    }

    public function it_can_list_all_transactions()
    {
        $transaction = WarehouseTransaction::factory()
            ->hasInTransactions(1, ['item_id' => $this->item->id])
            ->create([
                'warehouse_id' => $this->warehouse->id,
                'transaction_type_id' => $this->inType->id
            ]);

        $response = $this->getJson('/api/warehouse/transactions');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'warehouse_id',
                        'transaction_type_id',
                        'in_transactions',
                        'out_transactions'
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJsonPath('data.0.id', $transaction->id);
    }

    /** @test */
    public function it_can_show_a_single_transaction()
    {
        $transaction = WarehouseTransaction::factory()
            ->hasOutTransactions(1, ['item_id' => $this->item->id])
            ->create([
                'warehouse_id' => $this->warehouse->id,
                'transaction_type_id' => $this->outType->id
            ]);

        $response = $this->getJson("/api/warehouse/transactions/{$transaction->id}");

        $response->assertStatus(200);
            
    }

    /** @test */
    public function it_returns_for_nonexistent_transaction()
    {
        $response = $this->getJson('/api/warehouse/transactions/99999');

        $response->assertStatus(400);
    }

    /** @test */
    public function it_can_delete_a_transaction()
    {
        $transaction = WarehouseTransaction::factory()
            ->hasInTransactions(1)
            ->create();

        $response = $this->deleteJson("/api/warehouse/transactions/{$transaction->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('warehouse_transactions', ['id' => $transaction->id]);
    }
}
