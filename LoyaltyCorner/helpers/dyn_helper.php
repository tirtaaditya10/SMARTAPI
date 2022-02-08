<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

defined('FCPATH') or define('FCPATH', str_replace(APPPATH . 'helpers', '', pathinfo(__FILE__, PATHINFO_DIRNAME)));
defined('ENVIRONMENT') or define('ENVIRONMENT', 'development');

date_default_timezone_set("Asia/Jakarta");

$gBulan = array(1=>'Januari', 'Februari', 'Maret',  'April',  'Mei',  'Juni',  'Juli',  'Agustus',  'September',  'Oktober',  'November',  'Desember');
$gBln 	= array(1=>'Jan', 'Feb', 'Mar',  'Apr',  'Mei',  'Jun',  'Jul',  'Agt',  'Sep',  'Okt',  'Nov',  'Des');

function dump() {
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

// QUERY RESULT RELATED
function rst2Array($sql, $ret="all", $debug='') {
	$out = null;
	$CI  =& get_instance();

	$rst = $CI->db->query($sql);
	$err = $CI->db->error();
	if (isset($err['code']) && $err['code']) {
		dump($err, 'trace');
	}
	else {
		$tot = $rst->num_rows();
		$dat = $rst->result_array();
		$rst->free_result();
		if($tot>0) {
			switch ($ret) {
				case "cel":
					$key = array_keys($dat[0]);
					$out = $dat[0][$key[0]];
					break;
				case "row":
					$out = $dat[0];
					break;
				case "all":
					$out = $dat;
					break;
			}
			unset($dat);
		}
		if($debug)
            switch ($debug) {
                case 'all':
                    foreach ($CI->db->query($sql)->list_fields() as $f)
                        $fields[$f] = null;
                    foreach ($CI->db->query($sql)->field_data() as $m)
                        $meta[$m] = null;
                    $out = array('dat'=>$out, 'tot'=>$tot, 'fields'=>$fields, 'meta'=>$meta);
                    break;

                case 'sql':
                    $out = $sql;
                    break;

                case 'dump':
                    dump($out);
                    break;

                case is_numeric($debug):
                case 'null':
                case 'void':
                    if(!$tot)
                        foreach($CI->db->query($sql)->list_fields() as $f) {
                            if($debug == 'void' || $debug == 'null')
                                $out[$f] = $debug == 'null' ? null : '';
                            else
                                $out[$f] = $debug;
                        }
                    break;
            }
	}
	return $out;
}
function rst2Object($sql, $mode="std") {
	$CI 	=& get_instance();
	$query	= $CI->db->query($sql);
	$fields = $query->list_fields();
	$meta	= $query->field_data();
	$nrows	= $query->num_rows();
	$output	= $query->result();
	$query->free_result();

	switch ($mode) {
		case "std":
			return $output;
			break;
		case "all":
			return array('rows'=>$output, 'nrows'=>$nrows, 'fields'=>$fields, 'meta'=>$meta);
			break;
		case 'sql':
			dump($sql);
			break;
		case "rst":
		case "out":
			dump($output);
			break;
	}
}

function rst2ID($a, $col='id', $keep=true) {
	$o = array();
	if(is_bool($col)) {
		$keep   = $col;
		$col    = 'id';
	}
	
	if($a && is_array($a))
		foreach($a as $k=>$v) {
			$o[$v[$col]] = $v;
			if(!$keep) unset($o[$v[$col]][$col]);
		}
	return $o;
}
function rst2ref($arr) {
	$out = array();

	if($arr) {
		foreach($arr as $k=>$v) {
			$out['id'][$k] = $v['id'];
			$out['nm'][$k] = $v['nm'];
			if(isset($v['icon']))
				$out['icon'][$k] = $v['icon'];
		}
	}
	else {
		$out['id'][0] = '';
		$out['nm'][0] = '';
	}
	return $out;
}
function rst2tree($array, $delimiter = '_', $baseval = false) {
	if(!is_array($array)) return false;
	$splitRE   = '/' . preg_quote($delimiter, '/') . '/';
	$returnArr = array();
	foreach ($array as $key => $val) {
		// Get parent parts and the current leaf
		$parts  	= preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
		$leafPart	= array_pop($parts);

		// Build parent structure
		// Might be slow for really deep and large structures
		$parentArr = &$returnArr;
		foreach ($parts as $part) {
			if (!isset($parentArr[$part])) {
				$parentArr[$part] = array();
			}
			elseif (!is_array($parentArr[$part])) {
				if ($baseval) {
					$parentArr[$part] = array('__base_val' => $parentArr[$part]);
				}
				else {
					$parentArr[$part] = array();
				}
			}
			$parentArr = &$parentArr[$part];
		}

		// Add the final part to the structure
		if (empty($parentArr[$leafPart])) {
			$parentArr[$leafPart] = $val;
		}
		elseif ($baseval && is_array($parentArr[$leafPart])) {
			$parentArr[$leafPart]['__base_val'] = $val;
		}
	}
	return $returnArr;
}
function arr_transpose($dat, $col=null, $idx=null) {
    $out = false;
    if($dat && is_array($dat))
        foreach($dat as $k=>$v)
            if($col && is_string($col)) {
                // col is column
                if ($idx)
                    $out[$v[$idx]] = $v[$col];
                else
                    $out[] = $v[$col];
            }
            else {
                // col is default value
                $out[$v] = $col;
            }
    return $out;
}

function rst2color($arr, $color, $index=0, $colName=false, $colVal=false) {
	if($colName) {
		$tmp = array();
		$key = array_slice(array_keys($arr), $index);
		$idx = 0;
		foreach($key as $k=>$v) {
			$tmp[$idx] = array_slice($arr, 0, $index-1);
			$tmp[$idx][$colName] = $v;
			$tmp[$idx][$colVal]  = $arr[$v];
			$idx++;
		}
		$arr = $tmp;
	}
	if($arr)
		foreach($arr as $k=>$v)
			$arr[$k]['color'] = $color[$k];

	return $arr;
}
function rst2uvCharts($arr, $chart='Bar') {
	$out = array();
	$key = array_keys($arr[0]);
	$axs = array_shift($key);
	$out['cat'] = $key;
	switch($chart) {
		case 'Bar':
			$col = $key[0];
			$out['cat'] = array();
			foreach($arr as $k=>$v) {
				$out['cat'][]               = $v[$col];
				$out['data'][$v[$col]][]    = array('name'=>$v[$axs], 'value'=>$v['total']);
			}
			break;
		case 'Bar2':
			foreach($out['cat'] as $k=>$v) {
				foreach($arr as $x=>$y) {
					$out['data'][$v][] = array('name'=>$arr[$x][$axs], 'value'=>$y[$v]);
				}
			}
			break;
		case 'Bar3':
			$out['cat'] = array();
			foreach($arr as $k=>$v) {
				$out['cat'][] = $cat = $v['catz'];
				unset($v['catz']);
				foreach($v as $x=>$y) {
					$out['data'][$cat][] = array('name' => $x, 'value' => $y ? $y : '');
				}
			}
			break;
		case 'Bar4':
			$out['cat'] = array();
			foreach($arr as $k=>$v) {
				$out['cat'][] = $v['catz'];
				$out['data'][$v['catz']][] = array('name' => $axs, 'value' => $v['total']);
			}
			break;

		case 'Pie':
		case 'Donut':
			$out['cat'] = array($axs);
			foreach($arr as $k=>$v) {
				$out['data'][$axs][$k] = array('name'=>$v[$axs], 'value'=>$v['total']);
			}
			break;
		case 'Pie2':
		case 'Line2':
			$out['cat'] = array($axs);
			foreach($key as $x=>$y) {
				$out['data'][$axs][] = array('name'=>$y, 'value'=>$arr[0][$y]);
			}
			break;
	}
	return $out;
}
function rst2jqPlot($arr, $chart='Bar') {
		$out = array();
		$key = array_keys($arr[0]);
		$axs = array_shift($key);
		$out['cat'] = $key;
		switch($chart) {
			case 'Bar':
				$col = $key[0];
				$out['cat'] = array();
				foreach($arr as $k=>$v) {
					$out['cat'][]         = $v[$col];
					$out['data'][$v[$col]][]    = array('name'=>$v[$axs], 'value'=>$v['total']);
				}
				break;

			case 'Bar2':
				foreach($out['cat'] as $k=>$v) {
					foreach($arr as $x=>$y) {
						$out['data'][$v][$x] = array('name'=>$arr[$x][$axs], 'value'=>$y[$v]);
					}
				}
				break;

			case 'Pie':
			case 'Donut':
				$out['cat'] = array($axs);
				foreach($arr as $k=>$v) {
					$out['data'][$axs][$k] = array('name'=>$v[$axs], 'value'=>$v['total']);
				}
				break;
		}
		return $out;
	}

// CONVERT OBJECT RELATED
function object2array($o) {
	if(is_object($o))
		$o = get_object_vars($o);

	if(is_array($o))
		return array_map(__FUNCTION__, $o);
	else
        return $o;
}
function json2array($j, $a=true, $d=512, $o=0) {
	$j = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $j);
	
	if(version_compare(phpversion(), '5.4.0', '>='))
		$r = json_decode($j, $a, $d, $o);
	elseif(version_compare(phpversion(), '5.3.0', '>='))
		$r = json_decode($j, $a, $d);
	else
		$r = json_decode($j, $a);

	if(json_last_error() == JSON_ERROR_NONE)
	     return $r;
	else
	     return $j;
}

// XML -> other
function xml2array($xml) {
	return json_decode(json_encode(simplexml_load_file($xml)), true);
}
function xml2json($xml) {
    // XML to JSON conversion without '@attributes'
    $result = null;
    function normalizeSimpleXML($obj, &$result) {
        $data = $obj;
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $res = null;
                normalizeSimpleXML($value, $res);
                if (($key == '@attributes') && ($key)) {
                    $result = $res;
                } else {
                    $result[$key] = $res;
                }
            }
        } else {
            $result = $data;
        }
    }
    normalizeSimpleXML(simplexml_load_string($xml), $result);
    return json_encode($result);
}

// Array -> other
function arr2xml(array $data, SimpleXMLElement $object) {
    /*
    * $xml = new SimpleXMLElement('<rootTag/>');
    * arr2xml($arr, $xml_object);
    */
	foreach ($data as $key => $value) {
		if (is_array($value)) {
			arr2xml($value, $object->addChild($key));
		} else {
			// if the key is an integer, it needs text with it to actually work.
			if ($key === (int) $key) {
				$key = "key_$key";
			}
			$object->addChild($key, htmlspecialchars($value));
		}
	}
}
function arr2csv($data, $size_buff = 1) {
    $delimiter  = ',';
    $enclosure  = '"';
    $size_mem   = 1024 * 1024 * $size_buff;
    // Use a threshold of 1 MB (1024 * 1024)
    $handle     = fopen("php://temp/maxmemory:$size_mem", 'w');
    if ($handle === FALSE)
        return NULL;

    if (is_array($data) === FALSE)
        $data = (array)$data;

    // Check if it's a multi-dimensional array
    if (count($data) !== count($data, COUNT_RECURSIVE)) {
        $headings = array_keys($data[0]);
    } else {
        $headings   = array_keys($data);
        // $data       = [$data];
    }

    // Apply the headings
    fputcsv($handle, $headings, $delimiter, $enclosure);

    foreach ($data as $record) {
        // If the record is not an array, then break. This is because the 2nd param of
        // fputcsv() should be an array
        if (is_array($record) === FALSE) {
            break;
        }

        // Suppressing the "array to string conversion" notice.
        // Keep the "evil" @ here.
        $record = @ array_map('strval', $record);

        // Returns the length of the string written or FALSE
        fputcsv($handle, $record, $delimiter, $enclosure);
    }

    // Reset the file pointer
    rewind($handle);

    // Retrieve the csv contents
    $csv = stream_get_contents($handle);

    // Close the handle
    fclose($handle);

    // Convert UTF-8 encoding to UTF-16LE which is supported by MS Excel
    return mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
}

// BUILD TREE STRUCTURE
// http://kvz.io/blog/2007/10/03/convert-anything-to-tree-structures-in-php/
function explodeTree($array, $delimiter = '_', $baseval = false) {
	if(!is_array($array)) return false;
	$splitRE   = '/' . preg_quote($delimiter, '/') . '/';
	$returnArr = array();
	foreach ($array as $key => $val) {
		// Get parent parts and the current leaf
		$parts  	= preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
		$leafPart	= array_pop($parts);

		// Build parent structure
		// Might be slow for really deep and large structures
		$parentArr = &$returnArr;
		foreach ($parts as $part) {
			if (!isset($parentArr[$part])) {
				$parentArr[$part] = array();
			}
			elseif (!is_array($parentArr[$part])) {
				if ($baseval) {
					$parentArr[$part] = array('__base_val' => $parentArr[$part]);
				}
				else {
					$parentArr[$part] = array();
				}
			}
			$parentArr = &$parentArr[$part];
		}

		// Add the final part to the structure
		if (empty($parentArr[$leafPart])) {
			$parentArr[$leafPart] = $val;
		}
		elseif ($baseval && is_array($parentArr[$leafPart])) {
			$parentArr[$leafPart]['__base_val'] = $val;
		}
	}
	return $returnArr;
}
function plotTree($arr, $indent=0, $mother_run=true){
	if($mother_run){
		// the beginning of plotTree. We're at rootlevel
		echo "startn";
	}
	
	foreach($arr as $k=>$v){
		// skip the baseval thingy. Not a real node.
		if($k == "__base_val") continue;
		// determine the real value of this node.
		$show_val = ( is_array($v) ? $v["__base_val"] : $v );
		
		// show the indents
		echo str_repeat("  ", $indent);
		if($indent == 0){
			// this is a root node. no parents
			echo "O ";
		} elseif(is_array($v)){
			// this is a normal node. parents and children
			echo "+ ";
		} else{
			// this is a leaf node. no children
			echo "- ";
		}
		
		// show the actual node
		echo $k . " (".$show_val.")"."\n";
		
		if(is_array($v)){
			// this is what makes it recursive, rerun for childs
			plotTree($v, ($indent+1), false);
		}
	}
	
	if($mother_run){
		echo "end\n";
	}
}

function flat2tree($dat, $root=null, $id = 'id', $pid = 'pid', $kid = 'sub') {
	$tree = array();
	// first pass - get the array indexed by the primary id
	if(is_array($dat) && $dat) {
		foreach ($dat as $row) {
			$tree[$row[$id]] = $row;
			$tree[$row[$id]][$kid] = array();
		}

		//second pass
		foreach ($tree as $idx => $row) {
			$tree[$row[$pid]][$kid][$idx] =& $tree[$idx];
			if (is_null($root) && $row[$kid]) {
				$root = $idx;
			}
		}

		// return array($root => $tree[$root]);
		return $tree[$root][$kid];
	}
	else
		return $tree;
}
function buildTree(array &$dat, $piv = 0, $id='id', $pid='pid', $kid='children') {
	$tree = array();
	foreach ($dat as &$row) {
		if ($row[$pid] == $piv) {
			$sub = buildTree($dat, $row[$id], $id, $pid, $kid);
			if ($sub)
				$row[$kid] = $sub;

			$tree[$row[$id]] = $row;
			unset($row);
		}
	}
	
	return $tree;
}

function autherz($flag, $redirect=false) {
	if(!$flag) {
		if(is_xhr()) echo "expired";
		else {
			$redirect = $redirect ? $redirect : $_SERVER['HTTP_HOST'];
			header("Location: http://$redirect");
		}
		exit();
	}
}

function arg_escape($arg, $escape=true) {
	if(is_numeric($arg))
		return $arg + 0;
	else {
		return $escape ? "'$arg'" : str_replace("'", '', $arg);
	}
}
function var_cast($arg) {
	is_numeric($arg) && $arg = $arg + 0;
	return $arg;
}

// PARSE DATA TO QUERY CONDITION RELATED
function parser_whr($arg, &$dat=null) {
	$reg = '/<|>|!|=|\(|\b(not|in|like|between)\b/';
	$whr = '';
	if($arg && is_array($arg)) {
		foreach($arg as $k => $v) {
			$p = strlen($k) > 2 ? substr($k, 0, strlen($k)-2) . 'pid' : $k;
			
			if(is_array($v)) {
				foreach($v as $x => $y) {
					
					if (preg_match('/rsp__dat__*/', $y)) {
						$y = trim(str_replace('rsp__dat__', '', $y));
						if(preg_match($reg, $y)) {
							$opr = explode(' ', $y);
							$idx = end($opr);
							$opr = implode(' ', array_pop($opr));

							if(isset($dat[$idx])) {
								$val = arg_escape($dat[$idx]);
								$whr .= " and $x $opr $val ";
								unset($arg[$k][$x]);
							}
						}
						elseif(isset($dat[$y]))
							$arg[$k][$x] = $dat[$y];
					}
					if(preg_match($reg, $y)) {
						$val = arg_escape($y);
						$whr .= " and $x $val ";
						unset($arg[$k][$x]);
					}
					if(isset($arg[$k][$x]) && isset($arg[$k][$p])) {
						$y = is_numeric($y) ? $y : "'$y'";
						$whr .= " and ($x = $y or $p = $y) ";
						unset($arg[$k][$x], $arg[$k][$p]);
					}
				}
			}
			else {
				$v = trim($v);
				if (preg_match('/rsp__dat__*/', $v)) {
					$v = str_replace('rsp__dat__', '', $v);
					if(preg_match($reg, $v)) {
						$opr = explode(' ', $v);
						$idx = end($opr);
						array_pop($opr);
						$opr = implode(' ', $opr);

						if(isset($dat[$idx])) {
							$whr .= "and $k $opr $v ";
							unset($arg[$k]);
						}
					}
					elseif(isset($dat[$v]))
						$arg[$k] = $dat[$v];
				}
				elseif(preg_match($reg, $v)) {
					$whr .= " and $k $v ";
					unset($arg[$k]);
				}
				elseif(isset($arg[$k]) && isset($arg[$p])) {
					$val = arg_escape($v);
					
					$whr .= " and ($k = $val or $p = $val) ";
					unset($arg[$k], $arg[$p]);
				}
			}
		}

		if($arg)
			foreach($arg as $k=>$v) {
				if(is_array($v))
					foreach ($v as $f => $x)
						$whr .= parser_whr_xtd($f, $x);
				else
					$whr .= parser_whr_xtd($k, $v);
			}
		
	}
	return $whr;
}
function parser_whr_xtd($f, $v) {
	if(!is_array($v))
		$v = trim($v);
	$w = '';
	if($v == 'null' || $v == 'is null' || is_null($v))
		$w = " and $f is null ";
	elseif($v == 'not null' || $v == 'is not null')
		$w = " and $f is not null ";
	elseif(is_bool($v) || in_array($v, array('false', 'true')))
		$w = " and $f = $v ";
	elseif($f == 'dat')
		$w = " and $v ";
	else {
		if(is_array($v)) {
			$t = null;
			foreach($v as $k=>$x)
				$v[$k] = arg_escape($x);

			$v = implode(',', $v);
			$w = " and $f in ($v) ";
		}
		elseif(preg_match('/<|>|!|=|\(|\b(not|in|like|between)\b/', $v)) {
			$w = " and $f $v ";
		}
		else {
			$v = arg_escape($v);
			/*
			if(preg_match('/@/', $v))
				$v = str_replace('@', "'", $v) . "'";
			else
				$v = arg_escape($v);
			*/
			if(!$w)
				if($f == 'sys_module_id')
					$w = " and ($f = $v or sys_module_pid = $v) ";
				elseif(substr($f, 0, 8) == 'audience')
					$w = " and $f like '%$v%' ";
				else
					$w = " and $f = $v ";
		}
	}

	return $w;
}
function parser_cfg_arr($cfg, &$dat=null) {
	$rex = '/(out|dat|sys_(wfs|arg|pst|ext|usr|cfg))__*/';
	$reg = '/<|>|!|=|\(|\b(not|in|like|between)\b/';
	if(is_string($cfg))
		$cfg = json_decode($cfg, true);

	$tmp = $cfg;
	if($cfg && is_array($cfg)) {
		foreach($tmp as $k=>$v) {
			if(is_array($v)) {
				foreach($v as $x => $y) {
					if(preg_match($rex, $y, $m)) {
						$z = null;
						$r = str_replace($m[0], '', $y);
						$o = '';
						$this->util_parser_map_dat($m[1], $z, $dat);

						if(preg_match($reg, $r)) {
							$o = explode(' ', $r);
							$r = end($o);
							$o = implode(' ', array_pop($o));
						}
						if(isset($z[$r])) {
							$val = arg_escape($z[$r]);
							$cfg[$k][$x] = "$o $val";
							unset($tmp[$k][$x]);
						}
						unset($z);
					}
					elseif (preg_match($reg, $v)) {
						unset($tmp[$k][$x]);
					}
					elseif($dat && isset($dat[$y])) {
						$cfg[$k][$x] =  $dat[$y];
						unset($tmp[$k][$x]);
					}
				}
			}
			else {

				if(preg_match($rex, $v, $m)) {
					$z = null;
					$r = str_replace($m[0], '', $v);
					$o = '';
					if(preg_match($reg, $r)) {
						$o = explode(' ', $r);
						$r = end($o);
						$o = implode(' ', array_pop($o));
					}
					$this->util_parser_map_dat($m[1], $z, $dat);
					if(isset($z[$r])) {
						$val = arg_escape($z[$r]);
						$cfg[$k] = "$o $val";
						unset($tmp[$k]);
					}
					unset($z);
				}
				elseif (preg_match($reg, $v)) {
					unset($tmp[$k]);
				}
				elseif(isset($dat[$v]) && $dat[$v]) {
					$cfg[$k] =  $dat[$v];
					unset($tmp[$k]);
				}
			}
		}
	}
	return $cfg;
}
function parser_reg($arg, $pfx='##', $sfx='##') {
	$reg = array();
	if(is_string($arg))
		$arg = explode(',', trim($arg));

	if(is_array($arg))
		foreach($arg as $k=>$v)
			$reg[$k] = '/' . $pfx . $v . $sfx . '/';

	return $reg;
}
/***
	$userDoc    = "cv.doc";
	$text       = parser_file2txt($userDoc);
	echo $text;
****/
function parser_file2txt($F) {
	$fH     = fopen($F, "r");
	$line   = @fread($fH, filesize($F));
	$line   = explode(chr(0x0D),$line);
	$text   = "";
	fclose($fH);
	foreach($line as $L) {
		$pos = strpos($L, chr(0x00));
		if (!(($pos !== FALSE) || (strlen($L)==0)))
			$text .= $L." ";
	}
	$text = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$text);
	return $text;
}

function txt_shorten($a, $l=50) {
	$t = 0;
	$c = '';
	$b = explode(' ', trim($a));
	foreach($b as $k=>$v) {
		if($t+strlen($v)+$k <= $l) {
			$t += strlen($v);
			$c = substr($a, 0, $t+$k);
		}
	}
	return "$c ...";
}
function txt_random($l = 6) {
	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $l);
}

function build_table($array) {
	$html = '<table><thead><tr>';
	$html .= '<tr>';
	foreach($array[0] as $key=>$value){
		$html .= '<th>' . $key . '</th>';
	}
	$html .= '</tr></thead><tbody>';
	foreach( $array as $key=>$value){
		$html .= '<tr>';
		foreach($value as $key2=>$value2){
			$html .= '<td>' . $value2 . '</td>';
		}
		$html .= '</tr>';
	}
	$html .= '</tbody></table>';
	return $html;
}
function array2empty(&$arr, $val='') {
	foreach($arr as $k)
		$arr[$k] = $val;
	return $arr;
}
function array2table($array, $table = true, $init=true) {
	$out = '';

	if($init && isset($array[0]) && is_array($array[0])) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				unset($value['event_id']);
				//$value = array_filter($value, 'strlen');
				if (!isset($tableHeader)) {
					$tableHeader =
						'<th>' .
						implode('</th><th>', array_keys($value)) .
						'</th>';
				}
				$out .= '<tr>';
				$out .= array2table($value, false, false);
				$out .= '</tr>';
			} else {
				$out .= "<td>$value</td>";
			}
		}
	}
	else {
		unset($array['event_id']);
		$tableHeader =
			'<tr><th>' .
			implode('</th><th>', array_keys($array)) .
			'</th></tr>';
		$out .= '<tr><td>';
		$out .= implode('</td><td>', $array);
		$out .= '</td></tr>';
	}

	if ($table) {
		$table = is_string($table) ? '<caption style="float:left; color:darkred; font-weight:bold; margin-bottom:10px">' . strtoupper($table) . '</caption>' : '';
		return '<table style="border:1px solid">' . $table . $tableHeader . $out . '</table><br />';
	}
	else {
		return $out;
	}
}
function array2clone($arr, $val=null) {
	foreach($arr as $k=>$v)
		$new[$k] = $val;
	return $new;
}

function array_change_key($arr, $set) {
    // src: http://fellowtuts.com/php/change-array-key-without-changing-order/
    if (is_array($arr) && is_array($set)) {
        $new = array();
        foreach ($arr as $k => $v) {
            $key        = array_key_exists( $k, $set) ? $set[$k] : $k;
            $new[$key]  = is_array($v) ? array_change_key($v, $set) : $v;
        }
        return $new;
    }
    return $arr;
}
function array_explode($str, $delim =',', $def = null) {
	foreach(explode($delim, str_replace(' ', '', $str)) as $k=>$v)
		$arr[$v] = $def;
	return $arr;
}
/*
$dir = array(
    'iop' => array(
        '__aaa' => array('aaa'),
        '__sys' => array('sys'),
        '__hrs' => array('org', 'f360', 'kpi'),
        '__cms' => array('cms', 'inet'),
        '__dms' => array('dms'),
        '__grc' => array('gcg', 'lcs')
    ),
    'ppo' => array(
        '__ppo' => array('ppoa', 'ppos')
    )
);

$skey = 'dms';
$path = array_search_path($skey, $dir);
print_r($path);
*/
function array_search_path($needle, array $haystack, array $path = array()) {
    foreach ($haystack as $key => $value) {
        $currentPath = array_merge($path, array($key));
        if (is_array($value) && $result = array_search_path($needle, $value, $currentPath)) {
            return $result;
        }
        else
            if ($value === $needle) {
                unset($currentPath[count($currentPath)-1]);
                return implode('/', $currentPath);
            }
    }
    return false;
}

/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey (http://benramsey.com)
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column')) {
	/**
	 * Returns the values from a single column of the input array, identified by
	 * the $columnKey.
	 *
	 * Optionally, you may provide an $indexKey to index the values in the returned
	 * array by the values from the $indexKey column in the input array.
	 *
	 * @param array $input A multi-dimensional array (record set) from which to pull
	 *                     a column of values.
	 * @param mixed $columnKey The column of values to return. This value may be the
	 *                         integer key of the column you wish to retrieve, or it
	 *                         may be the string key name for an associative array.
	 * @param mixed $indexKey (Optional.) The column to use as the index/keys for
	 *                        the returned array. This value may be the integer key
	 *                        of the column, or it may be the string key name.
	 * @return array
	 */
	function array_column($input = null, $columnKey = null, $indexKey = null) {
		// Using func_get_args() in order to check for proper number of
		// parameters and trigger errors exactly as the built-in array_column()
		// does in PHP 5.5.
		$argc = func_num_args();
		$params = func_get_args();

		if ($argc < 2) {
			trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
			return null;
		}

		if (!is_array($params[0])) {
			trigger_error(
				'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
				E_USER_WARNING
			);
			return null;
		}

		if (!is_int($params[1])
				&& !is_float($params[1])
				&& !is_string($params[1])
				&& $params[1] !== null
				&& !(is_object($params[1]) && method_exists($params[1], '__toString'))
		) {
			trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
			return false;
		}

		if (isset($params[2])
				&& !is_int($params[2])
				&& !is_float($params[2])
				&& !is_string($params[2])
				&& !(is_object($params[2]) && method_exists($params[2], '__toString'))
		) {
			trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
			return false;
		}

		$paramsInput = $params[0];
		$paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

		$paramsIndexKey = null;
		if (isset($params[2])) {
			if (is_float($params[2]) || is_int($params[2])) {
				$paramsIndexKey = (int) $params[2];
			} else {
				$paramsIndexKey = (string) $params[2];
			}
		}

		$resultArray = array();

		foreach ($paramsInput as $row) {
			$key = $value = null;
			$keySet = $valueSet = false;

			if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
				$keySet = true;
				$key = (string) $row[$paramsIndexKey];
			}

			if ($paramsColumnKey === null) {
				$valueSet = true;
				$value = $row;
			} elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
				$valueSet = true;
				$value = $row[$paramsColumnKey];
			}

			if ($valueSet) {
				if ($keySet) {
					$resultArray[$key] = $value;
				} else {
					$resultArray[] = $value;
				}
			}
		}

		return $resultArray;
	}
}

function array_column_multi(array $input, array $column_keys) {
	$result = array();
	$column_keys = array_flip($column_keys);
	foreach($input as $key => $el) {
		$result[$key] = array_intersect_key($el, $column_keys);
	}
	return $result;
}

function uuid($uuid = null) {
    if(empty($uuid)) {
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    elseif($uuid = 'plain')
        $uuid = sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    else {
        // 00000000-0000-0000-0000-000000000000
        if(preg_match('-', $uuid))
            $uuid = str_replace('-', '', $uuid);
        else
            $uuid = substr($uuid, 0, 8) . '-' .
                substr($uuid, 8, 4)  . '-' .
                substr($uuid, 12, 4) . '-' .
                substr($uuid, 16, 4) . '-' .
                substr($uuid, 20, 12);
    }
    return $uuid;
}
function unique_numeric($l=16) {
    return mt_rand(pow(10,$l-1),pow(10,$l)-1);
}

// IP RELATED
function is_ip($ip) {
    return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false;
}
function is_localhost($ip) {
    return in_array($ip, array('127.0.0.1', '0.0.0.0'));
}
function cidr_range($cidr) {
    // Assign IP / mask
    list($ip,$mask) = explode("/",$cidr);

    // Sanitize IP
    $ip1 = preg_replace( '_(\d+\.\d+\.\d+\.\d+).*$_', '$1', "$ip.0.0.0" );

    // Calculate range
    $ip2 = long2ip( ip2long( $ip1 ) - 1 + ( 1 << ( 32 - $mask) ) );

    // are we cidr range cheking?
    return "$ip1 - $ip2";
}
function ip_cidr($ip, $cidr) {
    // Assign IP / mask
    list($net, $mask) = explode("/", $cidr);
    // Sanitize IP
    $ipS = preg_replace( '_(\d+\.\d+\.\d+\.\d+).*$_', '$1', "$net.0.0.0" );
    // Calculate range
    $ipR = long2ip( ip2long( $ipS ) - 1 + ( 1 << ( 32 - $mask) ) );

    if (is_ip($ip))
        return ip2long( $ipS ) <= ip2long( $ip ) && ip2long( $ipR ) >= ip2long( $ip ) ? true : false;
    else
        return false;
}
function ip_allow($ip, $white_list) {
    $allow      = false;
    $white_list = is_array($white_list) ? $white_list : array($white_list);
    foreach($white_list as $k => $idx) {
        if(is_ip($idx) && $ip == $idx) {
            $allow = true;
            break;
        }
        elseif(ip_cidr($ip, $idx)) {
            $allow = true;
            break;
        }
    }
    return $allow;
}

function is_xhr() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' : false;
}
function is_valid_callback($subject) {
	// jsonp callback

	$identifier_syntax
			= '/^[$_\p{L}][$_\p{L}\p{Mn}\p{Mc}\p{Nd}\p{Pc}\x{200C}\x{200D}]*+$/u';

	$reserved_words = array('break', 'do', 'instanceof', 'typeof', 'case',
			'else', 'new', 'var', 'catch', 'finally', 'return', 'void', 'continue',
			'for', 'switch', 'while', 'debugger', 'function', 'this', 'with',
			'default', 'if', 'throw', 'delete', 'in', 'try', 'class', 'enum',
			'extends', 'super', 'const', 'export', 'import', 'implements', 'let',
			'private', 'public', 'yield', 'interface', 'package', 'protected',
			'static', 'null', 'true', 'false');

	return $subject ? preg_match($identifier_syntax, $subject)
				&& ! in_array(mb_strtolower($subject, 'UTF-8'), $reserved_words) : true;
}

function ping($method, $host=null, $port=80, $ttl=255) {
	$latency = 0;
	$live    = 0;
	if(!in_array($method, array('exec', 'fsockopen', 'socket', 'ping'))) {
		$host   = $method;
		$method = 'fsockopen';
	}

	switch ($method) {
		case 'ping':
			$host   = $host ? $host : 'google.com';
			@system("ping -c 1 $host", $live);
			if($live == 0) {
				// this means you are connected
				$live = 1;
			}
			else
				$live = 0;
			break;
		case 'exec':
			$ttl  = escapeshellcmd($ttl);
			$host = escapeshellcmd($host);
			// Exec string for Windows-based systems.
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				// -n = number of pings; -i = ttl.
				$exec_string = 'ping -n 1 -i ' . $ttl . ' ' . $host;
			}
			// Exec string for UNIX-based systems (Mac, Linux).
			else {
				// -n = numeric output; -c = number of pings; -t = ttl.
				$exec_string = 'ping -n -c 1 -t ' . $ttl . ' ' . $host;
			}
			exec($exec_string, $output, $return);

			// Strip empty lines and reorder the indexes from 0 (to make results more
			// uniform across OS versions).
			$output = array_values(array_filter($output));

			// If the result line in the output is not empty, parse it.
			if (!empty($output[1])) {
				// Search for a 'time' value in the result line.
				$response = preg_match("/time(?:=|<)(?<time>[\.0-9]+)(?:|\s)ms/", $output[1], $matches);

				// If there's a result and it's greater than 0, return the latency.
				if ($response > 0 && isset($matches['time'])) {
					$latency = round($matches['time']);
				}
			}
			break;

		case 'fsockopen':
			$start = microtime(true);
			// fsockopen prints a bunch of errors if a host is unreachable. Hide those
			// irrelevant errors and deal with the results instead.
			$fp = @fsockopen($host, $port, $errno, $errstr, $ttl);
			if (!$fp) {
				$latency = false;
			}
			else {
				$live    = 1;
				$latency = round((microtime(true) - $start) * 1000);
			}
			break;

		case 'socket':
			// Create a package.
			$type = "\x08";
			$code = "\x00";
			$checksum = "\x00\x00";
			$identifier = "\x00\x00";
			$seq_number = "\x00\x00";
			$package = $type . $code . $checksum . $identifier . $seq_number . $this->data;

			// Calculate the checksum.
			$checksum = $this->calculateChecksum($package);

			// Finalize the package.
			$package = $type . $code . $checksum . $identifier . $seq_number . $this->data;

			// Create a socket, connect to server, then read socket and calculate.
			if ($socket = socket_create(AF_INET, SOCK_RAW, 1)) {
				socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array(
						'sec' => 10,
						'usec' => 0,
				));
				// Prevent errors from being printed when host is unreachable.
				@socket_connect($socket, $this->host, null);
				$start = microtime(true);
				// Send the package.
				@socket_send($socket, $package, strlen($package), 0);
				if (socket_read($socket, 255) !== false) {
					$live    = 1;
					$latency = microtime(true) - $start;
					$latency = round($latency * 1000);
				}
				else {
					$latency = false;
				}
			}
			else {
				$latency = false;
			}
			// Close the socket.
			socket_close($socket);
			break;
	}
	// Return the latency.
	return $live;
}

function file_name_rfc($name) {
	return str_replace(array('\\', ' ', '/', ':', '+', '=', '*', '?', '"', '<', '>', '|'), '-', $name);
}
function file_ext_by_mime($file_name, $case = 'lower') {
	$ext = array_search_path(mime_content_type($file_name), get_mimes());
	switch ($case) {
		case 'ucfirst':
			$ext = $case($ext);
			break;
		case 'upper':
		case 'lower':
			$cmd = 'strto' . $case;
			$ext = $cmd($ext);
			break;
		default:
			$ext =  strtolower($ext);
			break;
	}
	return $ext;
}
function util_img_tools($path, $cfg, $dat) {
	require_once APPPATH.'libraries/SimpleImage.php';

	if(!preg_match('/(http|https):\/\//', $path)) {
		$atr   = json_decode($cfg, true);
		$flx   = pathinfo($path);
		$ext   = strtolower($flx['extension']);
		$dir   = $flx['dirname'];
		$file  = $flx['filename'];
		$thumb = "{$file}-thumb.{$ext}";

		if(in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
			$img = new SimpleImage($path);

			list($w, $h, $t, $a) = getimagesize($path);

			if($atr['type'] == 'fit') $img->best_fit($atr['width'], $atr['height'])->save($path);
			elseif($atr['type'] == 'fix') {
				if(isset($atr['overlay']) && $atr['overlay']) {
					if(isset($dat['bg']) && $dat['bg']) $atr['bg'] = $dat['bg'];
					else
						$atr['bg'] = isset($atr['bg']) ? $atr['bg'] : '#000C46';

					$img->fit_to_height($atr['height'])->save($path);
					$bsx = new abeautifulsite\SimpleImage(null, $atr['width'], $atr['height'], $atr['bg']);
					$bsx->overlay($path, 'bottom center')->save($path);
				}
				else
					$img->resize($atr['width'], $atr['height'])->save($path);
			}
			if(isset($atr['thumb']) && $atr['thumb']) $img->thumbnail(256, 128)->save($dir.'/'.$thumb);
		}
	}
}
// IMG in string
function util_img_parser($q, $s) {
	$o = '';
	switch($q) {
		case 'img':
			$p = '/(<img[^>]+>)/i';
			preg_match_all($p, $s, $o);
			return $o[0];
			break;
		case 'src':
			$p = '/<img\s+src="(([^"]+)(.)(jpeg|png|jpg))"/';
			preg_match_all($p, $s, $o);
			return $o[1];
			break;
		default:
			return false;
			break;
	}
}

function get_caller() {
	$trace = debug_backtrace();
	$name = $trace[2]['function'];
	return empty($name) ? 'global' : $name;
}
function get_fn_caller(){
	$back_trace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 3);
	return $back_trace[2]['function'];
}

// CRYPT RELATED
function auth_crypt($string, $encrypt=true) {
	$method = "AES-256-CBC";
	$key    = hash('sha256', CIKEY_IOP);
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv     = substr(hash('sha256', CIKIV_IOP), 0, 16);
	return $encrypt === true ?
			base64_encode(openssl_encrypt($string,  $method, $key, 0, $iv)) :
			openssl_decrypt(base64_decode($string), $method, $key, 0, $iv);
}
function auth_save($usr, $pwd, $ath) {
	$ath = strtolower($ath);

	$doc = FCPATH.'__app/config/'.ENVIRONMENT.'/auth.conf.xml';
	$xml = simplexml_load_file($doc);
	$xml->$ath->user = auth_crypt($usr);
	$xml->$ath->pswd = auth_crypt($pwd);
	$xml->asXML($doc);
}
function auth_read($prm, $ath='mysql', $dec=true) {
	$out = false;
	$ath = strtolower($ath);
	if(in_array($ath, array('mysql', 'ldap'))) {
		include APPPATH . 'config/ldap.php';
		$xml = APPPATH.'config/'.ENVIRONMENT.'/auth.conf.xml';
		$rst = xml2array($xml);
		
		if($prm == 'all') {
			foreach($rst[$ath] as $k=>$v)
				$out[$k] = $dec ? auth_crypt($v, 'decrypt') : $v;
			if($dec && $ath == 'ldap' && isset($out['user']))
				$out['user'] = $config['ldap_dc'] . '\\' . $out['user'];
		}
		elseif(isset($rst[$ath][$prm])) {
			$out = $rst[$ath][$prm];
			if($dec) {
				$out = auth_crypt($out, 'decrypt');
				if($ath == 'ldap' && $prm == 'user')
					$out = $config['ldap_dc'] . '\\' . $out;
			}
		}
	}
	return $out;
}
function auth_help($com='') {
	$xtd = $com ? "_$com" : '';
	$aut = (array)simplexml_load_file(FCPATH."__app/config/auth$xtd.xml");
	$arr = array('dbu', 'dbp', 'adu', 'adp');
	foreach($arr as $k=>$v)
		$out[$v] = auth_crypt($aut[$v], 'decrypt');
	print_r($out);
}
function auth_sos($p) {
	return $p === auth_crypt(BPKEY_IOP, 'decrypt') || $p === auth_crypt(SUKEY_IOP, 'decrypt');
}

// DATE RELATED
function last_week_day($d, $t='last') {
	list($y, $m, $h) = preg_split('/[-\/]/', $d);

	$dt = date_create("$d last day of $t month");
	$ls = $dt->format('Y-m-d');
	$wd = $dt->format('w');
	list($y, $m, $h) = preg_split('/[-\/]/', $ls);

	if($wd == 0)
		$h -= 2;
	elseif($wd == 6)
		$h -= 1;
	return "$y-$m-$h";
}
function date_fix($date) {
	return preg_replace('/(\/|\.)/', '-', $date);
}
function is_date($date) {
	$d = date_fix($date);
	$t = strtotime($date);
	$f = preg_match('/:/', $d) ? 'Y-m-d H:i:s' : 'Y-m-d';
	$d = $t ? date($f, $t) : false;  //see explanation below for this replacement
	return $d;
}
function date_if($date) {
	$date   = date_fix($date);
	$t = strtotime($date);
	$f = preg_match('/:/', $date) ? 'Y-m-d H:i:s' : 'Y-m-d';
	
	$d = $t ? date($f, $t) : $date;  //see explanation below for this replacement
	dump($d);
	return $d;
}
function date_id($date, $f='d M Y') {
	$date   = date_fix($date);
	return date($f, strtotime($date));
}
function date_iso8601($date) {
	$date   = date_fix($date);
	$regex  = array(
		'datetime_iso'   => array('sign' => '/^([0-9]{4})-([0-9]{2})-([0-9]{2}) (\d{2}):(\d{2}):(\d{2})$/'),
		'datetime_id'    => array('sign' => '/^([0-9]{2})-([0-9]{2})-([0-9]{4}) (\d{2}):(\d{2}):(\d{2})$/',    'iso' => "$3-$2-$1 $4:$5:$6"),
		'datetime_us'    => array('sign' => '/^([0-9]{2})-([0-9]{2})-([0-9]{4}) (\d{2}):(\d{2}):(\d{2})$/',    'iso' => "$3-$1-$2 $4:$5:$6"),
		'date_iso'       => array('sign' => '/^(\d{4})-(\d{2})-(\d{2})$/'),
		'date_id'        => array('sign' => '/^(\d{2})-(\d{2})-(\d{4})$/',  'iso' => "$3-$2-$1"),
		'date_us'        => array('sign' => '/^(\d{2})-(\d{2})-(\d{4})$/',  'iso' => "$3-$1-$2")
	);
	
	$format = null;
	foreach($regex as $i => $reg) {
		if(preg_match($reg['sign'], $date, $result)) {
			$format = $result[2] > 12 ? preg_replace('/_id/', '/_us/', $i) : $i;
			break;
		}
	}
	if($format && !in_array($format, array('date_iso', 'datetime_iso'))) {
		$date = preg_replace($regex[$format]['sign'], $regex[$format]['iso'], $date);
	}
	
	return $date;
}
function date_of($date, $format='id') {
	$date = date_fix($date);
	if($date == 'now')
		$date = 'today';
	switch($format) {
		case 'id':
			$format='d-m-Y';
			break;
		case 'us':
			$format='m-d-Y';
			break;
		case 'iso':
			$format='Y-m-d';
			break;
	}
	return date($format, strtotime($date));
}
function date_diff_of( $date_1, $date_2, $format="%y year %m month %d day") {
		// %y Year %m Month %d Day %h Hours %i Minute %s Seconds
		$date_time_1    = date_create($date_1);
		$date_time_2    = date_create($date_2);
		$interval       = date_diff($date_time_1, $date_time_2);
		return $interval->format($format);
	}
function date_between($date_1, $date_2=null) {
	$date_2 = $date_2 ? $date_2 : $date_1;
	$d1 = date('Y-m-d', strtotime($date_1));
	$d2 = date('Y-m-d', strtotime($date_2));
	return " between '$d1 00:00:00' and '$d2 23:59:59'";
}
	/**
 * https://gist.github.com/Synchro/1139429
 * Encode arbitrary data into base-62
 * Note that because base-62 encodes slightly less than 6 bits per character (actually 5.95419631038688), there is some wastage
 * In order to make this practical, we chunk in groups of up to 8 input chars, which give up to 11 output chars
 * with a wastage of up to 4 bits per chunk, so while the output is not quite as space efficient as a
 * true multiprecision conversion, it's orders of magnitude faster
 * Note that the output of this function is not compatible with that of a multiprecision conversion, but it's a practical encoding implementation
 * The encoding overhead tends towards 37.5% with this chunk size; bigger chunk sizes can be slightly more space efficient, but may be slower
 * Base-64 doesn't suffer this problem because it fits into exactly 6 bits, so it generates the same results as a multiprecision conversion
 * Requires PHP 5.3.2 and gmp 4.2.0
 * @param string $data Binary data to encode
 * @return string Base-62 encoded text (not chunked or split)
 */
function base62encode($data) {
	$outstring = '';
	$l = strlen($data);
	for ($i = 0; $i < $l; $i += 8) {
		$chunk = substr($data, $i, 8);
		$outlen = ceil((strlen($chunk) * 8)/6); //8bit/char in, 6bits/char out, round up
		$x = bin2hex($chunk);  //gmp won't convert from binary, so go via hex
		$w = gmp_strval(gmp_init(ltrim($x, '0'), 16), 62); //gmp doesn't like leading 0s
		$pad = str_pad($w, $outlen, '0', STR_PAD_LEFT);
		$outstring .= $pad;
	}
	return $outstring;
}

/**
 * Decode base-62 encoded text into binary
 * Note that because base-62 encodes slightly less than 6 bits per character (actually 5.95419631038688), there is some wastage
 * In order to make this practical, we chunk in groups of up to 11 input chars, which give up to 8 output chars
 * with a wastage of up to 4 bits per chunk, so while the output is not quite as space efficient as a
 * true multiprecision conversion, it's orders of magnitude faster
 * Note that the input of this function is not compatible with that of a multiprecision conversion, but it's a practical encoding implementation
 * The encoding overhead tends towards 37.5% with this chunk size; bigger chunk sizes can be slightly more space efficient, but may be slower
 * Base-64 doesn't suffer this problem because it fits into exactly 6 bits, so it generates the same results as a multiprecision conversion
 * Requires PHP 5.3.2 and gmp 4.2.0
 * @param string $data Base-62 encoded text (not chunked or split)
 * @return string Decoded binary data
 */
function base62decode($data) {
	$outstring = '';
	$l = strlen($data);
	for ($i = 0; $i < $l; $i += 11) {
		$chunk = substr($data, $i, 11);
		$outlen = floor((strlen($chunk) * 6)/8); //6bit/char in, 8bits/char out, round down
		$y = gmp_strval(gmp_init(ltrim($chunk, '0'), 62), 16); //gmp doesn't like leading 0s
		$pad = str_pad($y, $outlen * 2, '0', STR_PAD_LEFT); //double output length as as we're going via hex (4bits/char)
		$outstring .= pack('H*', $pad); //same as hex2bin
	}
	return $outstring;
}
// end of file db_helper.php
/* Location: ./application/helper/db_helper.php */

/**
 * Generate a License Key.
 * Optional Suffix can be an integer or valid IPv4, either of which is converted to Base36 equivalent
 * If Suffix is neither Numeric or IPv4, the string itself is appended
 *
 * @param   string  $suffix Append this to generated Key.
 * @return  string
 * http://stackoverflow.com/questions/3687878/serial-generation-with-php
 */
function generate_license($suffix = null) {
	// Default tokens contain no "ambiguous" characters: 1,i,0,o
	if(isset($suffix)) {
		// Fewer segments if appending suffix
		$num_segments  = 3;
		$segment_chars = 6;
	}
	else {
		$num_segments  = 4;
		$segment_chars = 5;
	}
	$tokens         = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	$license_string = '';
	// Build Default License String
	for($i = 0; $i < $num_segments; $i++) {
		$segment = '';
		for($j = 0; $j < $segment_chars; $j++) {
			$segment .= $tokens[rand(0, strlen($tokens) - 1)];
		}
		$license_string .= $segment;
		if($i < ($num_segments - 1)) {
			$license_string .= '-';
		}
	}
	// If provided, convert Suffix
	if(isset($suffix)) {
		if(is_numeric($suffix)) {   // Userid provided
			$license_string .= '-' . strtoupper(base_convert($suffix, 10, 36));
		}
		else {
			$long = sprintf("%u\n", ip2long($suffix), true);
			if($suffix === long2ip($long)) {
				$license_string .= '-' . strtoupper(base_convert($long, 10, 36));
			}
			else {
				$license_string .= '-' . strtoupper(str_ireplace(' ', '-', $suffix));
			}
		}
	}

	return $license_string;
}

// CURL
function curl_file_send($file, $end_point) {
	// $file        = 'c:/www/dev/wyeth_crm/asset/img/loading.gif';
	// end_point    = 'http://winkerz/crm/home/gw/';
	$file['file']   = function($file) {
		$mime = mime_content_type($file);
		$info = pathinfo($file);
		$name = $info['basename'];
		$output = new CURLFile($file, $mime, $name);
		return $output;
	};
	$request        = curl_init();
	curl_setopt($request, CURLOPT_URL, $end_point);
	curl_setopt($request, CURLOPT_POST, 1);
	curl_setopt($request, CURLOPT_POSTFIELDS, $file);
	
	// output the response
	$rsp    = curl_exec($request);
	$inf    = curl_getinfo($request);
	$err    = curl_error($request);
	curl_close($request);
}
function curl_file_get($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	curl_setopt($ch, CURLOPT_URL, $url);

	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}
function curl_get($url) {
    $ch = curl_init();

    //Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $url);

    //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //Execute the request.
    $rsp = curl_exec($ch);

    //Close the cURL handle.
    curl_close($ch);

    return $rsp;
}
function curl_post($url, $dat) {
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL, $url );
    curl_setopt( $curl, CURLOPT_POST, TRUE );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($dat) );
    curl_setopt( $curl, CURLOPT_HEADER, FALSE );
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    $rsp = curl_exec($curl);

    if(curl_errno($curl) !== 0) {
        $rsp = -1;
    }
    curl_close($curl);
    return $rsp;
}

function copy_file($source, $dir) {
	$file = pathinfo($source,  PATHINFO_BASENAME);
	!is_dir($dir) && !@mkdir($dir, 0777, true);
	copy($source, $dir . $file);
}
// Format Phone
function msisdn_prefix($arg, $prefix='08') {
		$arg = str_replace('+', '', $arg);
		$len = strlen($prefix);
		$pre = substr($arg, 0, $len);
		if($pre != $prefix) {
			switch ($prefix) {
				case '08':
					// 62 -> 08
					$arg = '0' . substr($arg, 2, strlen($arg) - 2);
					break;
				case '62':
					// 08 -> 628
					$arg = $prefix . substr($arg, 1, strlen($arg) - 1);
					break;
			}
		}
		return $arg;
	}
function format_phone($phone, $country='id') {
	$function = 'format_phone_' . $country;
	if(function_exists($function)) {
		return $function($phone);
	}
	return $phone;
}
function format_phone_id($phone) {
	// note: making sure we have something
	if(!isset($phone{3})) { return ''; }
	// note: strip out everything but numbers
	$phone  = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	if(preg_match('/^08/', $phone)) {
		switch ($length) {
			case 10:
				// 0811 888-005
				$phone = preg_replace("/([0-9]{4})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone);
				break;
			case 11:
				// 0811 888-0055
				$phone = preg_replace("/([0-9]{4})([0-9]{3})([0-9]{4})/", "$1 $2-$3", $phone);
				break;
			case 12:
				// 0811 8888-0055
				$phone = preg_replace("/([0-9]{4})([0-9]{4})([0-9]{4})/", "$1 $2-$3", $phone);
				break;
			case 13:
				// 0811 8888-00555
				$phone = preg_replace("/([0-9]{4})([0-9]{4})([0-9]{5})/", "$1 $2-$3", $phone);
				break;
			case 14:
				// 0811 88123-00555
				$phone = preg_replace("/([0-9]{4})([0-9]{5})([0-9]{5})/", "$1 $2-$3", $phone);
				break;
		}
	}
	elseif(preg_match('/628/', $phone)) {
		switch ($length) {
			case 11:
				// (62)811-888-005
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{3})/", "$(1)$2 $3-$4", $phone);
				break;
			case 12:
				// (62)811-888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
				break;
			case 13:
				// (62)811-8888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
				break;
			case 14:
				// (62)811-8888-00555
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{5})/", "$(1)$2 $3-$4", $phone);
				break;
			case 15:
				// (62)811-8888-0055
				$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{5})([0-9]{5})/", "$(1)$2 $3-$4", $phone);
				break;
		}
	}
	else {
		if(preg_match('/^62(21|22|24|31|61)/', $phone)) {
			switch ($length) {
				case 9:
					// (62)21-88-005
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{3})/", "$(1)$2 $3-$4", $phone);
					break;
				case 10:
					// (62)21-888-005
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{3})([0-9]{3})/", "$(1)$2 $3-$4", $phone);
					break;
				case 11:
					// (62)21-888-0055
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{3})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
					break;
				case 12:
					// (62)21-8888-0055
					$phone = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
					break;
			}
		}
		elseif(preg_match('/^62(230-799)/', $phone)) {
			switch($length) {
				case 9:
					// (62)230-88-05
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "$(1)$2 $3-$4", $phone);
					break;
				case 10:
					// (62)230-88-005
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{3})/", "$(1)$2 $3-$4", $phone);
					break;
				case 11:
					// (62)230-888-055
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{3})/", "$(1)$2 $3-$4", $phone);
					break;
				case 12:
					// (62)230-888-0555
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
					break;
				case 13:
					// (62)230-8888-0555
					$phone = preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})([0-9]{4})/", "$(1)$2 $3-$4", $phone);
					break;
			}
		}
	}
	return $phone;
}

// MISC
/*
 *
 */