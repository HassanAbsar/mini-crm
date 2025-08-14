<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadApiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->agent = User::factory()->create(['role' => 'agent']);
    }
    /** @test */
    public function admin_can_list_all_leads()
    {
        Lead::factory()->count(5)->create();

        $this->actingAs($this->admin, 'sanctum');

        $response = $this->getJson('/api/lead');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    /** @test */
    public function admin_can_filter_leads_by_status()
    {
        Lead::factory()->create(['status' => 'new']);
        Lead::factory()->create(['status' => 'closed']);

        $this->actingAs($this->admin, 'sanctum');

        $response = $this->getJson('/api/lead?status=new');

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'new'])
                 ->assertJsonMissing(['status' => 'closed']);
    }

    /** @test */
    public function admin_can_create_a_lead()
    {
        $this->actingAs($this->admin, 'sanctum');

        $data = [
            'name' => 'John Doe',
            'email' => 'johna@example.com',
            'phone' => '1234567890',
            'status' => 'new'
        ];

        $response = $this->postJson('/api/lead', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'John Doe']);

        $this->assertDatabaseHas('leads', ['email' => 'johna@example.com']);
    }

    /** @test */
    public function admin_can_update_a_lead()
    {
        $lead = Lead::factory()->create(['name' => 'Old Name']);

        $this->actingAs($this->admin, 'sanctum');

        $response = $this->putJson("/api/lead/{$lead->id}", [
            'name' => 'Updated Name',
            'email' => $lead->email,
            'phone' => $lead->phone,
            'status' => $lead->status
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('leads', ['name' => 'Updated Name']);
    }

    /** @test */
    public function admin_can_delete_a_lead()
    {
        $lead = Lead::factory()->create();

        $this->actingAs($this->admin, 'sanctum');

        $response = $this->deleteJson("/api/lead/{$lead->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Lead deleted successfully']);

        $this->assertSoftDeleted('leads', ['id' => $lead->id]);
    }

    /** @test */
    public function agent_can_only_see_assigned_leads()
    {
        $assignedLead = Lead::factory()->create(['assigned_to' => $this->agent->id]);
        $unassignedLead = Lead::factory()->create();

        $this->actingAs($this->agent, 'sanctum');

        $response = $this->getJson('/api/lead');

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $assignedLead->id])
                 ->assertJsonMissing(['id' => $unassignedLead->id]);
    }
}
