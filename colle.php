<?php

colle(5, 3, [[0, 0], [3, 2]]);

function colle($x, $y, array $coords = [])
{
    system("clear");
    $table = display($x, $y, $coords);
    prompt($x, $y, $coords, $table);
}

function display($x, $y, $coords)
{
    $border = border_line($x);
    $table = "";
    for ($i = 0; $i <= $y; $i++) {
        $table .= $border;
        for ($j = 0; $j <= $x; $j++) {
            $table .= "| " . isEmpty($j, $i, $coords) . " ";
        }
        $table .= "|\n";
    }
    $table .= $border;
    echo $table;
    return $table;
}

function isEmpty($x, $y, $coords)
{
    foreach ($coords as $key => $value) {
        if ($value[0] == $x && $value[1] == $y) {
            return "X";
        }
    }
    return " ";
}
function prompt($x, $y, $coords, $table)
{
    $prompt = readline("$> ");
    do {
        if (strpos($prompt, "query") !== false) {
            $coord = explode(" ", $prompt)[1];
            $coord = explode(",", $coord);
            if (isEmpty(trim(substr($coord[0], 1, strlen($coord[0]) - 1)), trim(substr($coord[1], 0, 1)), $coords) == " ") {
                echo "empty\n";
            } else {
                echo "full\n";
            }
            $prompt = readline("$> ");
        } elseif (strpos($prompt, "add") !== false) {
            $coord = explode(" ", $prompt)[1];
            $coord = explode(",", $coord);

            $coord = [intval(trim(substr($coord[0], 1, strlen($coord[0]) - 1))), intval(trim(substr($coord[1], 0, 1)))];
            $add = add_coord($coord, $coords, $table);
            if ($add != "") {
                echo $add;
            }
            $prompt = readline("$> ");
        } elseif (strpos($prompt, "remove") !== false) {
            $coord = explode(" ", $prompt)[1];
            $coord = explode(",", $coord);

            $coord = [intval(trim(substr($coord[0], 1, strlen($coord[0]) - 1))), intval(trim(substr($coord[1], 0, 1)))];
            $remove = remove_coord($coord, $coords);
            if ($remove != "") {
                echo $remove;
            }
            $prompt = readline("$> ");

        }elseif (strpos($prompt, "display") !== false) {
            $table = display($x, $y, $coords);
            $prompt = readline("$> ");
        } else {
            $prompt = readline("$> ");
        }
    } while ($prompt != "exit");
}


function remove_coord($coord, &$coords)
{
    if (in_array($coord,$coords)) {
        $key = array_search($coord,$coords);
        unset($coords[$key]);
        return "";
    }else{
        return "No cross exists at this location\n";
    }
}
function add_coord(&$coord, &$coords, $table)
{
    if (isEmpty($coord[0], $coord[1], $coords) == " ") {
        array_push($coords, $coord);
        return "";
    } else {
        return "No cross exists at this location\n";
    }
}

function border_line($x)
{
    $border = "";
    for ($i = 0; $i <= $x; $i++) {
        $border .= "+---";
    }
    $border .= "+\n";
    return $border;
}
