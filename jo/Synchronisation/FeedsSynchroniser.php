<?php

namespace Jo\Synchronisation;

use App\Models\Feed;
use Jo\GuzzleClient;
use Zend\Feed\Reader\Reader;
use Jo\Resources\Repos\PostsRepo;
use Jo\Resources\Repos\FeedsRepo;

class FeedsSynchroniser
{

    protected $postsRepo;
    protected $feedsRepo;

    public function __construct(PostsRepo $postsRepo, FeedsRepo $feedsRepo)
    {
        $this->postsRepo = $postsRepo;
        $this->feedsRepo = $feedsRepo;
    }


    public function syncAll()
    {
        $feeds = $this->feedsRepo->getFeedsToSync();

        // replace zend-http with guzzle
        Reader::setHttpClient(new GuzzleClient());

        // not sure if we need to return the posts now, or just the count
        $posts = [];
        foreach ($feeds as $feed)
        {
            $postsInFeed[$feed->id] = $this->sync($feed);
        }

        // remove posts already found in db
        $posts = collect($postsInFeed)
            ->map(function ($postsCollection) {
                return $postsCollection->filter()->count();
            });

        // collect output
        return $feeds->map(function ($f) use ($posts) {
            $f->new = $posts[$f->id];

            return $f->only(['id', 'name', 'new', 'updated_at']);
        });

//        return $feeds->map(function($f) use ($posts) {
//            $x->new = $posts[$f->id]->count(); })
//                ->get(['id', 'name', 'new', 'updated_at']);
    }


    public function sync(Feed $feed)
    {
        // import our data here with Zend Feed
        $data = Reader::import($feed->url);

        $items = [];
        $models = [];
        foreach ($data as $item)
        {
            /*
            $items[] = [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'link' => $item->getLink(),
                'description' => $item->getDescription(),
                'author' => $item->getAuthor(),
                //'category' => optional($item->getCategory()),
                //'pubDate' => $item->getPubDate(),
            ];
            */

            // now this procedure could be a lot better in terms
            // of performance but we still on proof of concept
            // realm and not production ready

            $models[] = $this->postsRepo->create([
                'post_uid' => $item->getId(),
                'feed_id' => $feed->id,
                'title' => $item->getTitle(),
                'body' => $item->getDescription(),
                'link' => $item->getLink(),
            ]);
        }

        // update the feed, saying we have synced
        $feed->touch();

        // returns the collected Post models
        return collect($models);
    }
}
