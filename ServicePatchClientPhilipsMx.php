<?php
Header("Access-Control-Allow-Origin: *");
Header("Access-Control-Allow-Credentials: true");
Header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
Header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, X-Requested-With");
Header("Content-Type: application/json; charset=utf-8");

$curl = curl_init();

/* $body = Array(
    "orderItems" => [
        "seller" => $_POST["seller"],     
        "quantity" => $_POST["quantity"],
        "id" => $_POST["id"]
    ]
); */


$json = file_get_contents('php://input');

$data = json_decode($json);
$orderItems = $data->orderItems;


/* $pages_array = array(
     array(
         'seller' => $_POST["seller"],
         'quantity' => $_POST["quantity"],
         'id' => $_POST["id"]
     ),
); */

curl_setopt_array($curl, [
    CURLOPT_URL => $data->url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS => json_encode(array("orderItems" => $orderItems)),
  CURLOPT_HTTPHEADER => [
   "Accept: application/vnd.vtex.ds.v10+json",
    "Content-Type: application/json",
    "X-VTEX-API-AppKey: vtexappkey-philipsmx-TGAUDF",
    "X-VTEX-API-AppToken: ESWGGMLRLNPRUWNVROKOMITYTRFDOYCXKBUMEEOVNFGGXRQAYMHUXWXVZYMOHICNLSHTBBQNAOBHCMABBFFBRHAOEZNGRZOECTUFKWYWVTTIVQSMYKNCDAVDRTPCOKWB"
  ],
]);

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}



