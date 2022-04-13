<?php
// show tasks, redirect errors to NUL (hide errors)

exec("tasklist 2>NUL", $task_list);
echo "<pre>";
print_r($task_list);
