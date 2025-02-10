In PHP, a common yet subtle error arises when dealing with variable scope within functions and loops.  Consider this example:

```php
function processArray(array $arr) {
  $sum = 0;
  foreach ($arr as $value) {
    $sum += $value;
  }
  return $sum; // Returns the correct sum
}

$numbers = [1, 2, 3, 4, 5];
$total = processArray($numbers);
echo "Sum: " . $total; // Outputs: Sum: 15

function modifyArray(array &$arr) {
  foreach ($arr as &$value) {
    $value *= 2;
  }
}

$numbers = [1, 2, 3, 4, 5];
modifyArray($numbers);
echo "Modified Array: ";
print_r($numbers); // Outputs: Modified Array: Array ( [0] => 2 [1] => 4 [2] => 6 [3] => 8 [4] => 10 )

$numbers = [1, 2, 3, 4, 5];
$sum = 0;
foreach ($numbers as &$value) {
    $sum += $value; 
    $value *=2;   //Modifying the array value during iteration
}
echo "Sum: " . $sum; // Outputs: Sum: 15
print_r($numbers); // Outputs: Array ( [0] => 2 [1] => 4 [2] => 6 [3] => 8 [4] => 10 ) 
}
```

The issue lies in modifying the array within the loop while simultaneously iterating over it using a reference (`&$value`). The array changes, causing unexpected results.  The loop may skip elements or process them multiple times.  This is especially true when you add or remove elements within the loop itself.