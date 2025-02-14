<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServiceType;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $Clients = Client::factory()->count(10)->create();

        $Services = [];

        foreach($Clients as $key => $Client) {
            $Services[] = Service::factory()->create([
                'client_id' => $Client->id,
                'service' => Carbon::now()->format('Ym') . str_pad($key + 1, 4, '0', STR_PAD_LEFT),
            ]);
        }

        foreach($Services as $key => $Service) {
            ServiceItem::factory()->create([
                'service_id' => $Service->id,
            ]);
        }

        ServiceType::factory()->create(['name' => 'Bainha original', 'value' => 1000]);
        ServiceType::factory()->create(['name' => 'Bainha comum', 'value' => 1000]);
        ServiceType::factory()->create(['name' => 'Apertar perna', 'value' => 1500]);
        ServiceType::factory()->create(['name' => 'Apertar cintura', 'value' => 1500]);
    }
}
