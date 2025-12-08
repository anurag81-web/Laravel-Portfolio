<?php

namespace Tests\Feature\Admin;

use App\Models\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutCrudTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_guest_cannot_access_about_index()
    {
        $resp = $this->get('/admin/about');
        $resp->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_about_index()
    {
        $this->actingAs($this->user);
        About::factory()->count(3)->create();

        $resp = $this->get('/admin/about');
        $resp->assertStatus(200);
        $resp->assertViewHas('abouts');
    }

    public function test_authenticated_user_can_view_create_form()
    {
        $this->actingAs($this->user);

        $resp = $this->get('/admin/about/create');
        $resp->assertStatus(200);
    }

    public function test_authenticated_user_can_store_about_entry()
    {
        $this->actingAs($this->user);

        $data = [
            'name' => 'John Doe',
            'description' => 'A passionate developer',
        ];

        $resp = $this->post('/admin/about', $data);
        $resp->assertRedirect('/admin/about');

        $this->assertDatabaseHas('abouts', $data);
    }

    public function test_authenticated_user_can_view_edit_form()
    {
        $this->actingAs($this->user);
        $about = About::factory()->create();

        $resp = $this->get("/admin/about/{$about->id}/edit");
        $resp->assertStatus(200);
        $resp->assertViewHas('about', $about);
    }

    public function test_authenticated_user_can_update_about_entry()
    {
        $this->actingAs($this->user);
        $about = About::factory()->create(['name' => 'Old Name']);

        $data = [
            'name' => 'Updated Name',
            'description' => 'Updated description',
        ];

        $resp = $this->put("/admin/about/{$about->id}", $data);
        $resp->assertRedirect('/admin/about');

        $this->assertDatabaseHas('abouts', ['id' => $about->id, 'name' => 'Updated Name']);
    }

    public function test_authenticated_user_can_delete_about_entry()
    {
        $this->actingAs($this->user);
        $about = About::factory()->create();

        $resp = $this->delete("/admin/about/{$about->id}");
        $resp->assertRedirect('/admin/about');

        $this->assertDatabaseMissing('abouts', ['id' => $about->id]);
    }

    public function test_validation_fails_when_name_is_missing()
    {
        $this->actingAs($this->user);

        $data = [
            'description' => 'Missing name',
        ];

        $resp = $this->post('/admin/about', $data);
        $resp->assertSessionHasErrors('name');
    }
}
