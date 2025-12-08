<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_routes()
    {
        $routes = [
            '/admin/about',
            '/admin/project',
            '/admin/skill',
            '/admin/hero',
            '/admin/setting',
        ];

        foreach ($routes as $route) {
            $resp = $this->get($route);
            $resp->assertRedirect('/login');
        }
    }

    public function test_authenticated_user_can_access_admin_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Visit a page that does not require existing DB rows (create form)
        $resp = $this->get('/admin/about/create');
        $resp->assertStatus(200);
    }
}
