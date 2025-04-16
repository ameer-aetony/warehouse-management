<?php

namespace Tests\Feature;

use App\Models\ItemCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_item_categories()
    {

        ItemCategory::factory()->count(3)->create();
        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.categories.data')
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'categories' => [
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
    public function it_can_show_a_specific_item_category()
    {
        $category = ItemCategory::factory()->create([
            'name' => 'electronics'
        ]);
        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Success',
                'data' => [
                    'category' => [
                        'id' => $category->id,
                        'name' => 'electronics',
                        'created_at' => $category->created_at->toJSON(),
                        'updated_at' => $category->updated_at->toJSON()
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_if_category_not_found()
    {
        $response = $this->getJson('/api/categories/999');
        $response->assertStatus(500);
    }

    /** @test */
    public function it_can_create_an_item_category()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Category Created successful',
                'data' => [
                    'name' => 'Electronics',
                ]
            ]);

        $this->assertDatabaseHas('item_categories', [
            'name' => 'Electronics',
        ]);
    }

     /** @test */
     public function it_validates_required_fields_when_creating_category()
     {
         $response = $this->postJson('/api/categories', []);
 
         $response->assertStatus(422)
             ->assertJsonValidationErrors(['name']);
     }
 
     /** @test */
     public function it_can_update_an_item_category()
     {
         $category = ItemCategory::factory()->create(['name' => 'Old Name']);
 
         $response = $this->putJson("/api/categories/{$category->id}", [
             'name' => 'Updated Name',
         ]);
 
         $response->assertStatus(200)
             ->assertJson([
                 'success'=>true,
                 'message'=>'Category updated successful',
                 'data' => [
                     'id' => $category->id,
                     'name' => 'Updated Name',
                 ]
             ]);
 
         $this->assertDatabaseHas('item_categories', [
             'id' => $category->id,
             'name' => 'Updated Name',
         ]);
     }
 
     /** @test */
     public function it_can_delete_an_item_category()
     {
         $category = ItemCategory::factory()->create();
 
         $response = $this->deleteJson("/api/categories/{$category->id}");
 
         $response->assertStatus(204);
         $this->assertDatabaseMissing('item_categories', ['id' => $category->id]);
     }

}
