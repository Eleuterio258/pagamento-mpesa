<?php
    require_once('vendor/autoload.php');
    use Paymentsds\MPesa\Client;


    $celular = $_POST['celular'];
    $valor = $_POST['valor'];
    $reference = $_POST['reference'];
    
    $client = new Client([
        'apiKey' => 'pqwwaxz3ov27r944hvp1dofv1aehkghn',                // API Key
        'publicKey' => 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAmptSWqV7cGUUJJhUBxsMLonux24u+FoTlrb+4Kgc6092JIszmI1QUoMohaDDXSVueXx6IXwYGsjjWY32HGXj1iQhkALXfObJ4DqXn5h6E8y5/xQYNAyd5bpN5Z8r892B6toGzZQVB7qtebH4apDjmvTi5FGZVjVYxalyyQkj4uQbbRQjgCkubSi45Xl4CGtLqZztsKssWz3mcKncgTnq3DHGYYEYiKq0xIj100LGbnvNz20Sgqmw/cH+Bua4GJsWYLEqf/h/yiMgiBbxFxsnwZl0im5vXDlwKPw+QnO2fscDhxZFAwV06bgG0oEoWm9FnjMsfvwm0rUNYFlZ+TOtCEhmhtFp+Tsx9jPCuOd5h2emGdSKD8A6jtwhNa7oQ8RtLEEqwAn44orENa1ibOkxMiiiFpmmJkwgZPOG/zMCjXIrrhDWTDUOZaPx/lEQoInJoE2i43VN/HTGCCw8dKQAwg0jsEXau5ixD0GUothqvuX3B9taoeoFAIvUPEq35YulprMM7ThdKodSHvhnwKG82dCsodRwY428kg2xM/UjiTENog4B6zzZfPhMxFlOSFX4MnrqkAS+8Jamhy1GgoHkEMrsT5+/ofjCx0HjKbT5NuA2V/lmzgJLl3jIERadLzuTYnKGWxVJcGLkWXlEPYLbiaKzbJb2sYxt+Kt5OxQqC1MCAwEAAQ==',             // Public Key
        'serviceProviderCode' => '171717'    // input_ServiceProviderCode
    ]);

    if(!empty($celular) && !empty($valor) && !empty($reference)){
        $paymentData = [
            'from' => '258' . $celular,                 // input_CustomerMSISDN
            'reference' => $reference,          // input_ThirdPartyReference
            'transaction' => 'T12344CC',        // input_TransactionReference
            'amount' => $valor                  // input_Amount
        ]; 

        $result = $client->receive($paymentData);

        if ($result->success) {
            header('Location: home.php');
        } else {
            header('Location: index.php');
        }
    }else{
        echo "Preencha todos os campos do formulário";
    }
?>