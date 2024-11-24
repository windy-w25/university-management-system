<?php
namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function test_admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertStatus(200);
    }

    public function test_student_cannot_access_admin_routes()
    {
        $student = User::factory()->create(['role' => 'Student']);
        $this->actingAs($student)
            ->get('/admin/dashboard')
            ->assertStatus(403);
    }
}