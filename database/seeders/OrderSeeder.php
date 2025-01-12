<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * Order statuses.
     *
     * @var array
     */
    public const ORDER_STATUSES = [
        'STATUS_STANDBY' => 1,
        'STATUS_TO_PAY' => 2,
        'STATUS_TO_SHIP' => 3,
        'STATUS_COMPLETED' => 4,
        'STATUS_CANCELLED' => 5,
        'OUT_FOR_DELIVERY' => 6,
        'STATUS_ARCHIVED' => 7,
    ];

    public const ORDER_COUNT = 250;

    /**
     * Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * FakerSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<self::ORDER_COUNT; $i++) {
            $orderStatus = $this->faker->randomElement(self::ORDER_STATUSES);
            $randomUser = User::inRandomOrder()->where('user_type',1)->first();

            Order::create([
                'order_number' => $this->faker->unique()->numerify('ORD-##########'),
                'total_amount' => $this->faker->randomDigit(),
                'overall_orderKG' => $this->faker->randomFloat(2, 1, 50),
                'total_price' => $this->faker->randomFloat(2, 1, 1000),
                'order_status' => $orderStatus,
                'order_type' => $this->faker->randomElement([1, 2]),
                'customer_name' => $this->faker->name(),
                'customer_email' => $this->faker->email(),
                'customer_phone' => $this->faker->phoneNumber(),
                'customer_city' => $this->faker->city(),
                'customer_barangay' => $this->faker->streetName(),
                'customer_state' => $this->faker->state(),
                'customer_zip' => $this->faker->postcode(),
                'customer_country' => $this->faker->country(),
                'user_id' => $randomUser->id,
                'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
                'customer_house_number' => $this->faker->buildingNumber(),
                'customer_street' => $this->faker->streetName(),
                'delivery_employee' => $this->faker->name(),
            ]);
        }
            
    }
}
