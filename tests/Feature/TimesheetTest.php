<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Auth;
class TimesheetTest extends TestCase
{

    /**
     * test for activities table's primary key for create timesheet.
     *
     */
    public function testInvalidActivityIDForCreate()
    {
        // integer 19 is primary key of users table
        Auth::loginUsingId(19);

        $data = ['activity_id' => 0];

        $this->json('POST', 'timesheet', $data, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "activity_id" => [
                        "The selected activity id is invalid."
                    ]
                ]
            ]);
    }

    /**
     * test for timesheet table's primary key for update timesheet.
     *
     */
    public function testInvalidTimesheetIDForUpdate()
    {
        // integer 19 is primary key of users table
        Auth::loginUsingId(19);

        $this->json('PUT', 'timesheet/0', ['Accept' => 'application/json'])
            ->assertStatus(404);
    }
}
