<?php

$http = new swoole_http_server("0.0.0.0", 8101);

$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:8101\n";
});

$http->on('receive', function ($http, $fd, $from_id, $data)
{
    if(trim($data) == "stop")
    {
        $http->stop();
    }
    else
    {
        $http->send($fd, "Echo to #{$fd}: \n".$data);
        $http->close($fd);
    }
});

$http->on('WorkerStop', function($http, $worker_id)
{
    echo $worker_id . " stop\n";
});

$http->on('close', function ($http, $fd)
{
    echo "Connection closed: #{$fd}.\n";
});

$http->on('Request', function(Swoole\Http\Request $request, Swoole\Http\Response $response) use($app)
{
    $response->header('Content-Type', 'text/event-stream');
    $response->header('Cache-Control', 'no-cache');

    $counter = rand(1, 10);

    while(true)
    {
        $data = "event: ping\n";

        $response->write($data);

        $curDate = date(DATE_ISO8601);

        $data = 'data: {"time": "' . $curDate . '"}';
        $data .= "\n\n";

        $response->write($data);

        $counter--;
        if(!$counter)
        {
            $data = 'data: This is a message at time ' . $curDate . "\n\n";
            $response->end($data);
            break;
        }

        co::sleep(1);

    }
});
$http->start();