<?php
    include_once('./simple_html_dom.php');

    // URL to GET
    $url = 'http://localhost/novo';
    // DOM a partir da URL
    $html = file_get_html($url);

    #section
    $forms = [];
    $inputs = [];

    // Todos os forms
    foreach ($html->find('form') as $form) {
        array_push($forms, $form);
    }

    // Todos inputs
    foreach($html->find('input') as $input) { 
        array_push($inputs, $input);
    }

    // Identifica o método
    if ($form->method == 'POST') {
        $response = postRequest();   
    } else {
        $response = getRequest();
    }

    // Identifica se tem erro ou não
    if (strpos($response, 'success')) {
        echo 'Possivelmente há um erro de SQL Injection em: ' . $url;
    } else {
        echo 'Não foram encontrados erros de SQL Injection no website: ' . $url;
    }

    #endsection

    function postRequest() {
        global $inputs, $url, $forms;

        $data = array();
        foreach($inputs as $input) {
            $data[$input->name] = "' OR '1'='1";
        }
        
        if (strpos($url, 'http')) {
            $curl = curl_init($url);
        } else {
            $curl = curl_init($url . '/' . $forms[0]->action);
        }

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    function getRequest() {
        global $url, $forms, $inputs;

        $sqlStr = "' OR '1'='1";

        foreach($inputs as $input) {
            echo $input->name;
            echo $input;
            $urlGet .= $input->name;
            $urlGet .= $sqlStr;
        }

        //Once again, we use file_get_contents to GET the URL in question.
        $contents = file_get_contents($urlGet);
        
        //If $contents is not a boolean FALSE value.
        if($contents !== false){
            //Print out the contents.
            echo 'ERRO';
            echo $contents;
            die();
        }

        return $contents;
    }

    // Finaliza execução 
    die();