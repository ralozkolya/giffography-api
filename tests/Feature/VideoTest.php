<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase {

    /*
     * Retrieve list of videos
     * */
    public function testGetList() {
        $this->json('GET', '/api/videos')
            ->assertJson([
                'current_page' => 1,
                'data' => []
            ]);
    }
}
