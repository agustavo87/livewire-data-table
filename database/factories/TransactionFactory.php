<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'title' => 'Payment to ' . $this->faker->name,
        'amount' => rand(10, 500),
        'status' => Arr::random(['success', 'processing', 'failed']),
        'date' => Carbon::now()->subDays(rand(1, 365))->startOfDay(),
    ];
});
