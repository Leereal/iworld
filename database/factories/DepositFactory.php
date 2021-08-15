<?php

namespace Database\Factories;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositFactory extends Factory {
    /**
    * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deposit::class;

    /**
     * Define the model's default state.
    *
    * @return array
    */

    public function definition() {
        return [
            'amount' => $this->faker->randomFloat( 2, 10, 3000 ), 
            'bank_id' => mt_rand( 1, 4 ),
            'plan_id' => mt_rand( 1, 1 ),
            'user_id' => mt_rand( 1, 20 ),
            'ipaddress'=>$this->faker->ipv4,
        ];
    }
}
