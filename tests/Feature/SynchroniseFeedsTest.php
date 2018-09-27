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
        // given -- we have a real feed from setUp

        // when -- we call artisan command feeds:sync
        $this->callSync(1);

        // then -- we see updated time in feed change
        $this->assertDatabaseMissing('feeds', [
            'id' => $this->feed->id,
            'updated_at' => $this->feed->created_at,  // we should not have same time
        ]);

        // we also see entries in database, in Posts
        $this->assertTrue($this->feed->posts()->count() > 0);
        $this->assertDatabaseHas('posts', ['feed_id' => $this->feed->id]);
    }


    /**
     * Checks that Synchroniser does not store duplicates
     *
     * @return void
     */
    public function testDoesNotTryToStorePostsTwice()
    {
        // given -- we have a feed from setUp

        // when -- when we sync..
        $this->callSync(1);

        $postsInDbFirstSync = $this->feed->posts()->count();

        // .. if we try sync again after 1 second
        $this->callSync(1);

        // then -- posts in database should be the same, except if we are so
        // unlucky and the feed updated its content
        $this->assertEquals($postsInDbFirstSync, $this->feed->posts()->count());
    }

    /**
     * Checks if console output is fine
     *
     * @return void
     */
    public function testDisplaysOutput()
    {
        // todo: this should be better in 5.7

        // given -- we have a feed.. from setUp

        // when -- we sync
        $this->callSync(1);

        // then -- the output in console should include the posts count and
        // the feed name
        $postsInDbFirstSync = $this->feed->posts()->count();

        $output['first'] = Artisan::output();

        $this->assertTrue(strpos($output['first'], $this->feed->name) !== false);
        $this->assertTrue(strpos($output['first'], (string) $postsInDbFirstSync) !== false);


        // and if we try to sync again after 1 second, the output should show
        // 0 on new entries, as long as the feed itself hasn't put new content
        $this->callSync(1);

        $output['second'] = Artisan::output();

        $this->assertTrue(strpos($output['second'], $this->feed->name) !== false);
        $this->assertEquals($postsInDbFirstSync, $this->feed->posts()->count());
        $this->assertTrue(strpos($output['second'], (string) 0) !== false);
    }

    /**
     * Checks if an Exception is thrown given an invalid URL
     *
     * @return void
     */
    public function testThrowsExceptionIfInvalidUrl()
    {
        // given -- we have a feed with wrong url
        $feed = factory(\App\Models\Feed::class)->create([
            'name' => 'Reuters / Arts',
            'url' => 'http://somethingverywrong',
        ]);

        // an exception will be thrown
        $this->expectException(\Exception::class);

        // when we call sync
        $this->callSync(1);
    }


    /**
     * Calls feeds:sync command
     *
     * @param int delayInSeconds    Number of seconds to sleep before executing
     */
    private function callSync($delayInSeconds = 0)
    {
        // make sure we sleep for an amount of time, so as to make possible
        // to update the feed.updated_at at a different time than creation
        sleep($delayInSeconds);
        Artisan::call('feeds:sync');
    }
}
