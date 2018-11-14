<?php

require 'vendor/autoload.php';

$criteriaX = new \tests\TimeDatum();
$criteriaX->data = 5;
$criteriaX->closeData = [4, 6];
$criteriaY = new \tests\RoomDatum();
$criteriaY->data = 93;
$criteriaY->closeData = [92, 94];

$timetable = new \timetables\TimetableDriver();

try {
    $dimenX = new timetables\cartesius\Dimensions();
    for ($i = 0; $i < 900; $i++) {
        $data = new \tests\TimeDatum();
        $data->data = rand(0, 100);
        $timetable->addDimenX($data);
    }

    $dimenY = new timetables\cartesius\Dimensions();
    for ($i = 0; $i < 500; $i++) {
        $data = new \tests\RoomDatum();
        $data->data = rand(0, 100);
        $timetable->addDimenY($data);
    }

    $result = $timetable->setCriteriaX($criteriaX)->setCriteriaY($criteriaY)->CalculateTimeTable();

    var_dump($result);
} catch (\timetables\cartesius\TimetableException $ex) {
    die('Timetable fatal error');
}
