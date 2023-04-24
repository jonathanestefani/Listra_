<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cars extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            [
                "country_id" => 1,
                "state_id" => 24,
                "city_id" => 4201406,
                "photo" => "car.jpeg",
                "brand" => "Volkswagen",
                "model" => "Comfortline",
                "name" => "Volkswagen T-Cross",
                "description" => "1.0 200 TSI Total Flex Confortline",
                "year" => 2015,
                "mileage" => 70000,
                "gearbox_type" => "Automatic",
                "phone" => "(48) 99934-0600",
                "total" => 52000,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
                "deleted_at" => null,
            ],
            [
                "country_id" => 1,
                "state_id" => 24,
                "city_id" => 4201406,
                "photo" => "car2.jpg",
                "brand" => "Volkswagen",
                "model" => "Comfortline",
                "name" => "VW T-Cross",
                "description" => "VW T-Cross 2024 Total Flex Confortline",
                "year" => 2018,
                "mileage" => 3000,
                "gearbox_type" => "Automatic",
                "phone" => "(48) 99934-0600",
                "total" => 57800,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
                "deleted_at" => null,
            ],
            [
                "country_id" => 1,
                "state_id" => 24,
                "city_id" => 4201406,
                "photo" => "car3.jpeg",
                "brand" => "Audi",
                "model" => "e-tron",
                "name" => "Audi e-tron",
                "description" => "E-Tron é o primeiro modelo totalmente elétrico",
                "year" => 2023,
                "mileage" => 0,
                "gearbox_type" => "Automatic",
                "phone" => "(48) 99934-0600",
                "total" => 100000,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
                "deleted_at" => null,
            ],
            [
                "country_id" => 1,
                "state_id" => 24,
                "city_id" => 4201406,
                "photo" => "car4.png",
                "brand" => "Audi",
                "model" => "e-tron S Sportback",
                "name" => "Audi S Sportback",
                "description" => "Audi e-tron S Sportback impressiona com seus três potentes motores",
                "year" => 2023,
                "mileage" => 0,
                "gearbox_type" => "Automatic",
                "phone" => "(48) 99934-0600",
                "total" => 100000,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
                "deleted_at" => null,
            ],
        ]);
    }
}
