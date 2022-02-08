<?php



function runPOSTsRequests($url_array, $totArray=0, $thread_width = 10,$Token) {

    $threads = 0;
    $results = array();
    $count = 0;
    $no=0;

    $master = curl_multi_init();

   
    for($i=0; $i<= $totArray-1;$i++) {
		
        $ch = curl_init();

	if($url_array[$i]['Channel']=="1"){
		    
		    $headers = array(
    			'Content-Type:application/json'
			);

		$curl_opts = array(CURLOPT_FOLLOWLOCATION => true,
        			   CURLOPT_MAXREDIRS => 5,
			           CURLOPT_CONNECTTIMEOUT => 15,
			           CURLOPT_TIMEOUT => 15,
			           CURLOPT_RETURNTRANSFER => 1,
				   CURLOPT_HEADER => 0,
			           CURLOPT_URL => $url_array[$i]['URL'].'?'.$url_array[$i]['Data']
				);

		}else{
			$headers = array(
    			'Content-Type:application/json',
    			'Authorization: Bearer '. $Token,
			'Coster:  '. $url_array[$i]['Coster']
			);

			$curl_opts = array(CURLOPT_FOLLOWLOCATION => true,
        			   	   CURLOPT_MAXREDIRS => 5,
			           	   CURLOPT_CONNECTTIMEOUT => 15,
			           	   CURLOPT_TIMEOUT => 15,
			                   CURLOPT_RETURNTRANSFER => 1,
			                   CURLOPT_POST =>1,	
				           CURLOPT_HTTPHEADER => $headers,
				           CURLOPT_POSTFIELDS => $url_array[$i]['Data'],
 				           CURLOPT_URL => $url_array[$i]['URL']
				          );


		}
		$no++;
        curl_setopt_array($ch, $curl_opts);
        curl_multi_add_handle($master, $ch); //push URL for single rec send into curl stack
        $results[$count] = array("ID" => $url_array[$i]['ID'],"WAID" => $url_array[$i]['WAID'], "handle" => $ch);
        $threads++;
        $count++;
        if($threads >= $thread_width) { //start running when stack is full to width
            while($threads >= $thread_width) {
                usleep(100);
                while(($execrun = curl_multi_exec($master, $running)) === -1){}
                curl_multi_select($master);
                // a request was just completed - find out which one and remove it from stack
                while($done = curl_multi_info_read($master)) {
                    foreach($results as &$res) {
                        if($res['handle'] == $done['handle']) {
                            $res['result'] = curl_multi_getcontent($done['handle']);
			      echo 'Thread Results: '.$res['WAID'].':' .$res['result']. '<br/>';                        
			}
                    }
                    curl_multi_remove_handle($master, $done['handle']);
                    curl_close($done['handle']);
                    $threads--;
                }
            }
        }
    }

    do { //finish sending remaining queue items when all have been added to curl
        usleep(100);
        while(($execrun = curl_multi_exec($master, $running)) === -1){}
        curl_multi_select($master);
        while($done = curl_multi_info_read($master)) {
            foreach($results as &$res) {
                if($res['handle'] == $done['handle']) {
                    $res['result'] = curl_multi_getcontent($done['handle']);
		    echo 'Thread Result: '.$res['WAID'].':' .$res['result'];

                }
            }
            curl_multi_remove_handle($master, $done['handle']);
            curl_close($done['handle']);
            $threads--;
        }
    } while($running > 0);
    curl_multi_close($master);
    return $results;
}


?>