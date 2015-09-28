<?php
function array_orderby()
//Credits "jimpoz at jimpoz dot com" @ http://php.net/manual/en/function.array-multisort.php
{
  $args = func_get_args();
  $data = array_shift($args);
  foreach ($args as $n => $field) {
      if (is_string($field)) {
          $tmp = array();
          foreach ($data as $key => $row)
              $tmp[$key] = $row[$field];
          $args[$n] = $tmp;
          }
  }
  $args[] = &$data;
  call_user_func_array('array_multisort', $args);
  return array_pop($args);
}


 ?>
