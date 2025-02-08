<?php

use App\Models\User;


it('has citizens API endpoint', function () {
    $response = $this->get('/api/citizens');
    $response->assertStatus(200);
});

test('can fetch all citizens', function () {
    $response = $this->getJson('/api/citizens');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 '*' => ['id', 'name', 'address'], 
             ]);
});

test('can create a citizen', function () {
    $data = [
        'name' => 'Ivan Ivanov',
        'address' => 'Sofia, Bulgaria',
    ];

    $response = $this->postJson('/api/citizens', $data);

    $response->assertStatus(201)
             ->assertJson(['name' => 'Ivan Ivanov']);
});

test('can fetch a specific citizen', function () {
    $citizen = \App\Models\Citizen::factory()->create();

    $response = $this->getJson("/api/citizens/{$citizen->id}");

    $response->assertStatus(200)
             ->assertJson(['id' => $citizen->id]);
});

test('can update a citizen', function () {
    $citizen = \App\Models\Citizen::factory()->create();

    $data = [
        'name' => 'Updated Name',
        'address' => '456 New Address'
    ];

    $response = $this->putJson("/api/citizens/{$citizen->id}", $data);

    $response->assertStatus(200)
             ->assertJson(['name' => 'Updated Name']);
});

test('can delete a citizen', function () {
    $citizen = \App\Models\Citizen::factory()->create();

    $response = $this->deleteJson("/api/citizens/{$citizen->id}");

    $response->assertStatus(204);
});

test('can fetch a citizen\'s licenses', function () {
    $citizen = \App\Models\Citizen::factory()->create();
    \App\Models\License::factory()->create(['citizen_id' => $citizen->id]);

    $response = $this->getJson("/api/citizens/{$citizen->id}/licenses");

    $response->assertStatus(200)
             ->assertJsonStructure([
                 '*' => ['id', 'type', 'citizen_id', 'created_at', 'updated_at'],
             ]);
});

test('can add a license to a citizen', function () {
    $citizen = \App\Models\Citizen::factory()->create();

    $data = [
        'type' => 'Driver',
        'issue_date' => '2023-01-01',
        'expiry_date' => '2028-01-01',
    ];

    $response = $this->postJson("/api/citizens/{$citizen->id}/licenses", $data);

    $response->assertStatus(201)
             ->assertJson(['type' => 'Driver']);
});

test('can delete a license', function () {
    $citizen = \App\Models\Citizen::factory()->create();
    $license = \App\Models\License::factory()->create(['citizen_id' => $citizen->id]);

    $response = $this->deleteJson("/api/citizens/{$citizen->id}/licenses/{$license->id}");

    $response->assertStatus(204);
});

test('can fetch a license\'s violations', function () {
    $citizen = \App\Models\Citizen::factory()->create();
    $license = \App\Models\License::factory()->create(['citizen_id' => $citizen->id]);
    \App\Models\Violation::factory()->create(['license_id' => $license->id]);

    $response = $this->getJson("/api/citizens/{$citizen->id}/licenses/{$license->id}/violations");

    $response->assertStatus(200)
             ->assertJsonStructure([
                 '*' => ['id', 'type', 'penalty', 'license_id', 'created_at', 'updated_at'],
             ]);
});

test('can add a violation to a license', function () {
    // create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $citizen = \App\Models\Citizen::factory()->create();
    $license = \App\Models\License::factory()->create(['citizen_id' => $citizen->id]);

    $data = [
        'type' => 'Speeding',
        'penalty' => 'Fine of $200',
    ];

    $response = $this->postJson("/api/citizens/{$citizen->id}/licenses/{$license->id}/violations", $data);

    $response->assertStatus(201)
             ->assertJson(['type' => 'Speeding']);
});

test('can delete a violation', function () {
    $citizen = \App\Models\Citizen::factory()->create();
    $license = \App\Models\License::factory()->create(['citizen_id' => $citizen->id]);
    $violation = \App\Models\Violation::factory()->create(['license_id' => $license->id]);

    $response = $this->deleteJson("/api/citizens/{$citizen->id}/licenses/{$license->id}/violations/{$violation->id}");

    $response->assertStatus(204);
});

