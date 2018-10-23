<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Email::class, function (Faker $faker) {
    return [
        'uid' => $faker->randomNumber(4),
        'mailbox' => 'INBOX',
        'from' => $faker->name .'<'. $faker->safeEmail .'>',
        'cc' => $faker->name,
        'bcc' => $faker->name,
        'to' => $faker->name,
        'reply_to' => $faker->name,
        'subject' => $faker->sentence(35),
        'body' => $faker->realText(250),
        'flags' => 1,
        'priority' => 1,

        'email_account_id' => factory(App\Models\EmailAccount::class)->create()->id,
    ];
});
