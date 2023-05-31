<?php

colle(3,2);

function colle($x,$y,array $coords = []){
    display($x,$y,$coords);
    prompt($x,$y,$coords);
}

function display($x,$y,$coords){
    $border = border_line($x);
    static $table = "";
    for ($i=0; $i <= $y; $i++) { 
        $table .= $border;
        for ($j=0; $j <= $x; $j++) { 
            $table .= "| ".isEmpty($x,$y,$coords)." "; 
        }
        $table .= "|\n";
    }
    $table .= $border;
    echo $table;
}

function isEmpty($x,$y,$coords){
    
    return " ";
}
function prompt($x,$y,$coords){

}

function border_line($x){
    $border = "";
    for ($i=0; $i <= $x; $i++) { 
        $border .= "+---";
    }
    $border .= "+\n";
    return $border;
}