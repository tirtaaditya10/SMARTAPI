<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function dbg() {
    $args = func_get_args();
    if($args[0] === 'br') {
        echo '<br clear="both" />';
        unset($args[0]);
    }
    elseif($args[0] != 'p')
        echo "<div class='row'>";

    foreach ($args as $k => $arg) {
        if(!empty($arg) && !is_bool($arg)) {
            switch($arg) {
                case 'p':
                    break;

                case '#':
                case 'die':
                    http_response_code(200);
                    die('</div>');
                    break;

                case 'bt':
                case 'trace':
                case 'backtrace':
                    echo "<pre style='font-size:8pt; color:darkblue; padding:0 20px; border:1px yellowgreen solid'>";
                    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);
                    echo "</pre>";
                    break;

                default:
                    switch(gettype($arg)) {
                        case 'string':
                        case 'integer':
                        case 'double':
                            echo "<pre style='float:left; padding:0 20px; border:1px #78828c solid'>";
                            echo $arg;
                            echo "</pre>";
                            break;

                        case 'array':
                        case 'resources':
                            echo "<pre style='float:left; padding:0 20px; border:1px #00A0D1 solid'>";
                            print_r($arg);
                            echo "</pre>";
                            break;
                        case 'object':
                            echo "<pre style='float:left; padding:0 20px; border:1px #00A0D1 solid'>";
                            // echo 'This thing is an Object';
                            print_r($arg);
                            echo "</pre>";
                            break;
                        case 'NULL':
                            echo "<pre style='float:left; padding:0 20px; border:1px #78828c solid'>NULL</pre>";
                            break;


                        default:
                            echo "<pre style='float:left; padding:0 20px; border:1px #c91032 solid'> Don't Recognize the Object Type";
                            var_export($arg);
                            echo "</pre>";
                            break;
                    }
                    break;
            }
        }
        else {
            echo "<pre style='float:left; padding:0 20px; border:1px red solid; color:red;'>";
            if(is_bool($arg))
                echo $arg ? 'true' : 'false';
            elseif(is_null($arg))
                echo 'NULL';
            elseif($arg == 0)
                echo $arg;
            else
                echo 'empty-string';
            echo "</pre>";
        }
    }
    if($args[0] != 'p')
        echo "</div>";
}
