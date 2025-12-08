<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessControlTest extends TestCase
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
        $this->get('/admin/about')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_about_create()
    {
        $this->get('/admin/about/create')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_project_index()
    {
        $this->get('/admin/project')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_skill_index()
    {
        $this->get('/admin/skill')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_hero_index()
    {
        $this->get('/admin/hero')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_access_setting_index()
    {
        $this->get('/admin/setting')
            ->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_about_create_form()
    {
        $this->actingAs($this->user)
            ->get('/admin/about/create')
            ->assertStatus(200);
    }

    public function test_authenticated_user_can_access_project_create_form()
    {
        $this->actingAs($this->user)
            ->get('/admin/project/create')
            ->assertStatus(200);
    }

    public function test_authenticated_user_can_access_skill_create_form()
    {
        $this->actingAs($this->user)
            ->get('/admin/skill/create')
            ->assertStatus(200);
    }
}
