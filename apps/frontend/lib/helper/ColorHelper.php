<?php
$colorCount;
$lastColor;
function get_rand_color($rand = false)
{
  global $colorCount, $lastColor;
  $colorCount = is_null($colorCount) ? 0:$colorCount;
  $colors = array('yellow', 'light-blue', 'grey', 'green', 'orange');
  if ($rand)
  {
    $rand = array_rand($colors);
    $color = $colors[$rand];
    while ($color == $lastColor)
    {
      $rand = array_rand($colors);
      $color = $colors[$rand];
    }
    $lastColor = $color;
  } else {
    $color = $colors[$colorCount];
  }
  if ($colorCount == count($colors))
  {
    $colorCount = 0;
  }
  $colorCount++;
  return $color;
}