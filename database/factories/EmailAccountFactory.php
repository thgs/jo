<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmailAccount::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory(App\User::class)->create()->id,
        'username' => $faker->name,
        'password' => $faker->password,
        'host' => 'mail.'.$faker->domainName,
        'port' => 993,
        'encryption' => 'tls',
        'protocol' => 'imap',

        'sync_every' => 15,
        'inbound_repository' => '',
    ];
});
