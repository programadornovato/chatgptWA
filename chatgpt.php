<?php
function preguntaChatgpt($pregunta){
    //API KEY DE CHATGPT
    $apiKey='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';
    //INICIAMOS LA CONSULTA DE CURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer '.$apiKey,
    ]);
    //INICIAMOS EL JSON QUE SE ENVIARA A META
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
        \"model\": \"text-davinci-003\",
        \"prompt\": \"".$pregunta."\",
        \"max_tokens\": 4000,
        \"temperature\": 1.0
    }");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //OBTENEMOS EL JSON COMPLETO CON LA RESPUESTA
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded_json = json_decode($response, false);
    //RETORNAMOS LA RESPUESTA QUE EXTRAEMOS DEL JSON
    return  $decoded_json->choices[0]->text;    
}
$respuesta=preguntaChatgpt("Cuanto es 6 mas 6");
echo $respuesta;
