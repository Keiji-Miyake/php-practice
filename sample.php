<?php

function sayHello(string $argString): void
{
    echo "Hello" . $argString . PHP_EOL;
}

sayHello("world");
