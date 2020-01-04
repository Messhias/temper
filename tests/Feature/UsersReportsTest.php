<?php

/**
 * @file     UsersReportsTest.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    04/01/2020
 * @version  1.0
 */


namespace Tests\Feature;


use Tests\TestCase;

class UsersReportsTest extends TestCase
{
    protected \Illuminate\Foundation\Testing\TestResponse $response;

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = $this->get('/api/users/reports');
    }

    /**
     * First we test if the url at least is giving us the 200 as status response.
     */
    public function testGetAssertStatus()
    {
        $this->response->assertStatus(200);
    }

    /**
     * See if the some JSON fragment is matching and working.
     */
    public function testGetAssertJSON()
    {
        $this->response->assertJsonFragment([
            'code' => 200,
            'error' => false,
            'success' => true,
        ]);
    }
}
