<?php

namespace Tests\Feature;

use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_pet_records_can_be_created_searched_updated_and_deleted(): void
    {
        $this->get('/')->assertRedirect(route('dashboard'));
        $this->get(route('dashboard'))->assertOk()->assertSee('TOTAL REGISTERED PETS');
        $this->get(route('pets.create'))->assertOk()->assertSee('New pet record');

        $this->post(route('pets.store'), $this->petData())->assertRedirect();

        $pet = Pet::firstOrFail();
        $this->assertDatabaseHas('pets', ['id' => $pet->id, 'name' => 'Jasper']);
        $this->get(route('pets.index', ['search' => 'Jasper']))->assertOk()->assertSee('Jasper');
        $this->get(route('pets.index', ['search' => 'Morgan']))->assertOk()->assertSee('Jasper');
        $this->get(route('pets.show', $pet))->assertOk()->assertSee('Morgan Lee');
        $this->get(route('pets.edit', $pet))->assertOk()->assertSee('Edit Jasper');

        $this->patch(route('pets.update', $pet), array_merge($this->petData(), ['name' => 'Jasper II']))
            ->assertRedirect(route('pets.show', $pet));
        $this->assertDatabaseHas('pets', ['id' => $pet->id, 'name' => 'Jasper II']);
        $this->get(route('dashboard'))->assertOk()->assertSee('Jasper II');

        $this->delete(route('pets.destroy', $pet))->assertRedirect(route('pets.index'));
        $this->assertDatabaseMissing('pets', ['id' => $pet->id]);
    }

    public function test_dashboard_counts_pets_by_type(): void
    {
        Pet::create($this->petData());
        Pet::create(array_merge($this->petData(), ['name' => 'Miso', 'type' => 'Cat']));
        Pet::create(array_merge($this->petData(), ['name' => 'Pip', 'type' => 'Other']));

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertViewHas('totalPets', 3)
            ->assertViewHas('dogs', 1)
            ->assertViewHas('cats', 1)
            ->assertViewHas('otherPets', 1);
    }

    public function test_pet_fields_are_validated(): void
    {
        $this->from(route('pets.create'))
            ->post(route('pets.store'), ['name' => '', 'type' => 'Dragon'])
            ->assertRedirect(route('pets.create'))
            ->assertSessionHasErrors(['name', 'type', 'age', 'gender', 'owner_name', 'contact_number', 'address', 'date_registered']);

        $this->assertDatabaseCount('pets', 0);
    }

    private function petData(): array
    {
        return [
            'name' => 'Jasper',
            'type' => 'Dog',
            'breed' => 'Beagle',
            'age' => 4,
            'gender' => 'Male',
            'owner_name' => 'Morgan Lee',
            'contact_number' => '555-0142',
            'address' => '14 Cedar Street',
            'date_registered' => '2026-11-17',
        ];
    }
}