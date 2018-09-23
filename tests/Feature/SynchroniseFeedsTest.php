<?php

namespace Tests\Feature;

use Artisan;
use App\User;
use App\Models\Feed;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SynchroniseFeedsTest extends TestCase
{
    use RefreshDatabase;

    protected $feed;

    public function setUp()
    {
        parent::setUp();

        $this->feed = factory(\App\Models\Feed::class)->create([
            'name' => 'Reuters / Arts',
            'url' => 'http://feeds.reuters.com/news/artsculture',
        ]);

    }

    /**
     * Checks if we can retrieve feed entries
     *
     * @return void
     */
    public function testRetrievesFeedEntries()
    {
        // given
        // we have a real feed from setUp

        // below should go to FeedTest
        //$this->assertTrue($feed instanceof Feed);
        //$this->assertDatabaseHas('feeds', ['name' => 'Reuters / Arts']);

        // when
        // we call artisan command feeds:sync
        // we make sure we sleep for 1 sec, so as to give laravel the possibility
        // to update the feed.updated_at at the next second
        $this->callSync(1);

        // then
        // we see updated time in feed change
        $this->assertDatabaseMissing('feeds', [
            'id' => $this->feed->id,
            'updated_at' => $this->feed->created_at,   // we should not have same time
        ]);

        // we see entries in database, in Posts
        $this->assertTrue($this->feed->posts()->count() > 0);
        $this->assertDatabaseHas('posts', ['feed_id' => $this->feed->id]);
    }


    /**
     * Checks if we can retrieve feed entries
     *
     * @return void
     */
    public function testDoesNotTryToStorePostsTwice()
    {
        // given
        // we have a feed from setUp

        // when
        // we sync
        $this->callSync(1);

        $postsInDbFirstSync = $this->feed->posts()->count();

        // if we try sync again after 1 second
        $this->callSync(1);

        // then
        // posts should be the same, except if we are so unlucky and it did
        // update this very second !
        $this->assertEquals($postsInDbFirstSync, $this->feed->posts()->count());
    }

    /**
     * Checks if we can retrieve feed entries
     *
     * @return void
     */
    public function testDisplaysOutput()
    {
        // this should be better in 5.7

        // given
        // we have a feed.. from setUp

        // when
        // we sync
        $this->callSync(1);

        $postsInDbFirstSync = $this->feed->posts()->count();

        $output['first'] = Artisan::output();
        //dump([$output, $postsInDbFirstSync]);

        $this->assertTrue(strpos($output['first'], $this->feed->name) !== false);
        $this->assertTrue(strpos($output['first'], (string) $postsInDbFirstSync) !== false);


        // if we try sync again after 1 second
        $this->callSync(1);

        $output['second'] = Artisan::output();

        //dump([$output, $postsInDbFirstSync]);

        $this->assertTrue(strpos($output['second'], $this->feed->name) !== false);
        $this->assertEquals($postsInDbFirstSync, $this->feed->posts()->count());
        $this->assertTrue(strpos($output['second'], (string) 0) !== false);
    }

    /**
     * Checks if we can retrieve feed entries
     *
     * @return void
     */
    public function testThrowsExceptionIfInvalidUrl()
    {
        // given
        // we have a feed..
        $feed = factory(\App\Models\Feed::class)->create([
            'name' => 'Reuters / Arts',
            'url' => 'http://somethingverywrong',
        ]);

        $this->expectException(\Exception::class);

        $this->callSync(1);
    }


    private function callSync($delayInSeconds = 0)
    {
        sleep($delayInSeconds);
        Artisan::call('feeds:sync');
    }
}
