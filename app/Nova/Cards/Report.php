<?php

namespace App\Nova\Cards;
use Auth;
use DB;

class Report extends \Mako\CustomTableCard\CustomTableCard
{
    public function __construct()
    {
        $header = collect(['User Name', 'Activity Name', 'Minutes Spent', 'Files Worked']);

        $this->title('Daily Report ' . date("Y-m-d"));
        $this->viewall(['label' => 'Export report to excel', 'link' => '/export']);

        $today = date('Y-m-d');
        $start_time = "00:00:00";
        $end_time = "23:59:59";
        $temp = "";

        if (Auth::user()->isManager()) {
            $temp = "AND users.manager_guid = '" . Auth::user()->guid . "'";
        }

        $sql_query = "SELECT t.fullname,activities.`name` AS activity_name,ROUND(time_to_sec((TIMEDIFF(t.finish_time,t.start_time)))/60) AS spent_minute,t.file_worked FROM (SELECT t.*,count(*) AS file_worked FROM (SELECT sheet.*,users.initials,users.manager_guid,users.fullname FROM (SELECT user_id,activity_id,IF (date(started_at)='" . $today . "',time(started_at),IF (date(started_at)< '" . $today . "','" . $start_time ."','" . $end_time . "')) AS start_time,IF (date(finished_at)='" . $today . "',time(finished_at),IF (date(finished_at)> '" . $today . "','" . $end_time . "','" . $start_time ."')) AS finish_time FROM timesheets) AS sheet,users WHERE users.id=sheet.user_id " . $temp . ") AS t,legacy_work WHERE t.initials=legacy_work.user_initials AND t.start_time<=legacy_work.account_start_time AND t.finish_time>=legacy_work.account_start_time GROUP BY user_id,activity_id) AS t,activities WHERE t.activity_id=activities.id";
        $report = collect(DB::SELECT($sql_query));

        $this->header($header->map(function($value) {
            return (new \Mako\CustomTableCard\Table\Cell($value))->sortable(true);
        })->toArray());

        $this->data($report->map(function($order) {
            return new \Mako\CustomTableCard\Table\Row(
                new \Mako\CustomTableCard\Table\Cell($order->fullname),
                new \Mako\CustomTableCard\Table\Cell($order->activity_name),
                new \Mako\CustomTableCard\Table\Cell($order->spent_minute),
                new \Mako\CustomTableCard\Table\Cell($order->file_worked)
            );
        })->toArray());
    }
}
