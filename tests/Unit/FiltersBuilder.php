<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Email;

class FiltersBuilder extends TestCase
{
    use RefreshDatabase;

    public function getBuilder()
    {
        $builder = $this->app->make('Jo\Filter\Builder');
        
        return $builder;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFiltersName()
    {
        // given we have 10 messages sent from thgs
        $messagesThgs = factory(Email::class, 10)->create([
            'from' => 'thgs'
        ]);

        // and another 5 from Rob
        $messagesRob = factory(Email::class, 5)->create([
            'from' => 'Rob'
        ]);

        // when we try make a filters builder
        $messages = $this->getBuilder()
            ->from('thgs')
            ->get();

        // we should receive 10
        $this->assertCount(10, $messages->toArray());
    }
}
