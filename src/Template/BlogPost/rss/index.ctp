<?php

	$this->set('channelData', [
    'title' => __("Most Recent Posts"),
    'link' => $this->Url->build('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
]);


foreach ($blogPosts as $post) {
    $created = strtotime($post->blog_post_date_created);

    $link = [
        'controller' => 'BlogPost',
        'action' => 'view',
        $post->blog_post_id
    ];

    // Remove & escape any HTML to make sure the feed content will validate.
    $body = h(strip_tags(html_entity_decode($post->blog_post_body,ENT_QUOTES)));
    $body = $this->Text->truncate($body, 300, [
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ]);

    echo  $this->Rss->item([], [
        'title' => $post->blog_post_topic,
        'link' => $link,
        'guid' => ['url' => $link, 'isPermaLink' => 'true'],
        'description' => $body,
        'pubDate' => $post->blog_post_date_created
    ]);
}
?>