<?php

use App\position;
use App\sources;
use App\status;
use Illuminate\Database\Seeder;

class basicdataseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status::create(['status' => 'New']);
        status::create(['status' => 'Open']);
        status::create(['status' => 'Pending']);
        status::create(['status' => 'Progress']);
        status::create(['status' => 'Complete']);
        status::create(['status' => 'Close']);
        sources::create(['sources'=>"Web"]);
        sources::create(['sources'=>"Phone Call"]);
        sources::create(['sources'=>"Mobile Phone"]);
        position::create(['emp_position'=>'Web Developer']);
        position::create(['emp_position'=>'Accountant']);
        position::create(['emp_position'=>'Manager']);
        position::create(['emp_position'=>'CEO']);
        position::create(['emp_position'=>'CTO']);
    }
}
