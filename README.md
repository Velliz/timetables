# Timetable

Timetable algorithm implemented with 2 dimensional cartesius diagram.

### Install

```bash
composer require velliz/timetables
```

### Usage

**Criteria**

Instance a criteria for X and Y dimensions with provided example.
You can have your customized **TimeDatum** and **RoomDatum** class with extending it to ```Datum``` abstraction.

```php
$criteriaX = new \tests\TimeDatum();
$criteriaX->data = 5;
$criteriaX->closeData = array(4, 6);
```

```php
$criteriaY = new \tests\RoomDatum();
$criteriaY->data = 93;
$criteriaY->closeData = array(92, 94);
```

```$criteriaY->data``` is what exactly you want to search and ```$criteriaY->closeData```
is acceptable if the data not found in the XY dimensions.

**Driver**

```php
$timetable = new \timetables\TimetableDriver();
```

**Dimensions**

This example create a 900 length size random **TimeDatum** with range value from 0 to 100. 

```php
$dimenX = new timetables\cartesius\Dimensions();
for ($i = 0; $i < 900; $i++) {
    $data = new \tests\TimeDatum();
    $data->data = rand(0, 100);
    $timetable->addDimenX($data);
}
```

This example create a 100 length size random **RoomDatum** with range value from 0 to 100.

```
$dimenY = new timetables\cartesius\Dimensions();
for ($i = 0; $i < 500; $i++) {
    $data = new \tests\RoomDatum();
    $data->data = rand(0, 100);
    $timetable->addDimenY($data);
}
```

**Results**

Algorithm will find a match **TimeDatum** with value 5 and **RoomDatum** with value 93.

```php
$result = $timetable->setCriteriaX($criteriaX)->setCriteriaY($criteriaY)->CalculateTimeTable();
```

And result from calculation:

```php
array(6) {
  ["BestX"]=>
  int(893)
  ["BestY"]=>
  int(83)
  ["Criteria"]=>
  array(2) {
    ["X"]=>
    int(5)
    ["Y"]=>
    int(93)
  }
  ["Result"]=>
  array(2) {
    ["X"]=>
    int(5)
    ["Y"]=>
    int(93)
  }
  ["Iteration"]=>
  int(13812)
  ["Remark"]=>
  string(5) "CLEAR"
}
```

### Calculation

To create custom comparison rules, you can implement custom classes and *extends* it to **Datum**

```php
class CustomRoomDatum extends Datum
```

and implements **CalculateFits** function.

```php
public function CalculateFits(Datum $comparator)
{
    //simple comparison logic
    if ($comparator->data === $this->data) {
        return Datum::EQUALS;
    } else if (in_array($this->data, $comparator->closeData)) {
        return Datum::CLOSE;
    }
    return Datum::NOT_MATCH;
}
```

* ```$comparator->data``` is your criteria passed from function parameter
* ```$this->data``` is primary usage for comparison and populated from the **Dimensions**

Then return a constant provided:

* ```Datum::EQUALS``` if data is match
* ```Datum::CLOSE``` if data close matched
* ```Datum::NOT_MATCH``` if data not match