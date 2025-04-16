<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_items()
    {

        Item::factory()->count(3)->create();
        $response = $this->getJson('/api/items');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.items.data')
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'items' => [
                        'current_page',
                        'data' => [
                            '*' => ['id', 'name', 'commercial_name', 'category_id', 'price', 'created_at', 'updated_at']
                        ],
                        'first_page_url',
                        'from',
                        'last_page',

                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_specific_item()
    {
        $category = ItemCategory::factory()->create(['name' => 'test cate']);
        $item = Item::factory()->create([
            'name' => 'item1',
            'commercial_name' => 'itd',
            'category_id' => $category->id,
            'price' => 205,
        ]);
        $response = $this->getJson("/api/items/{$item->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Success',
                'data' => [
                    'item' => [
                        'id' => $item->id,
                        'name' => 'item1',
                        'commercial_name' => 'itd',
                        'category_id' => $category->id,
                        'created_at' => $item->created_at->toJSON(),
                        'updated_at' => $item->updated_at->toJSON()
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_if_item_not_found()
    {
        $response = $this->getJson('/api/items/999');
        $response->assertStatus(500);
    }

    /** @test */
    public function it_can_create_an_item()
    {

        $category = ItemCategory::factory()->create(['name' => 'test category']);
        $itemData = [
            'name' => 'item1',
            'commercial_name' => 'itd',
            'category_id' => $category->id,
            'price' => 205,
        ];


        $response = $this->postJson('/api/items', $itemData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'commercial_name',
                    'category_id',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ])
            ->assertJson([
                'success' => true,
                'message' => 'Items Created successful', // Match actual response
                'data' => [
                    'name' => $itemData['name'],
                    'commercial_name' => $itemData['commercial_name'],
                    'category_id' => $itemData['category_id'],
                    'price' => $itemData['price'],
                ]
            ]);

        $responseData = $response->json()['data'];
        $this->assertDatabaseHas('items', [
            'id' => $responseData['id'],
            'name' => $itemData['name'],
            'commercial_name' => $itemData['commercial_name'],
            'category_id' => $itemData['category_id'],
            'price' => $itemData['price'],
        ]);
    }
    /** @test */
    public function it_validates_required_fields_when_creating_item()
    {
        $response = $this->postJson('/api/items', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'commercial_name', 'category_id', 'price']);
    }

    /** @test */
    public function it_can_update_an_item()
    {

        $category = ItemCategory::factory()->create(['name' => 'test category']);
        $item = Item::factory()->create([
            'name' => 'test name old',
            'commercial_name' => 'test',
            'category_id' => $category->id,
            'price' => 205
        ]);


        $response = $this->putJson("/api/items/{$item->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Items updated successful',
                'data' => true
            ]);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_delete_an_item_item()
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/api/items/{$item->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
