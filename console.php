<?php
use React\EventLoop\Factory;
use React\ChildProcess\Process;
require 'vendor/autoload.php';
if (DIRECTORY_SEPARATOR === '\\') {
    exit('Process pipes not supported on Windows' . PHP_EOL);
}
$loop = Factory::create();
$first = new Process('sleep 2; echo welt');
$first->start($loop);
$second = new Process('sleep 1; echo hallo');
$second->start($loop);
$first->stdout->on('data', function ($chunk) {
    echo $chunk;
});
$second->stdout->on('data', function ($chunk)  {
    echo $chunk;
});
$loop->run();