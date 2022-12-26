<?php 
$url = "https://www.tshirthane.com/api/v2/product/save";
$api_key = "50fbcc25-a8e9-433a-99f1-12d38c81be34";
$api_secret = "bb69e63e48c20c767307845fede17c22a44I3bDiMwFyoS0Fnw=="; 
// Data
$data = [
    'products' => [
     
        [   
            // Hızlı ürün oluşturma/güncelleme (sadece zorunlu alanlar baz alınmıştır)
            'code' => 'DSGFDS3433',
            'taxRate' => 18,
            'currency' => 'TL',
            'salePrice' => 49.99,
            'quantity' => 15
        ],

        [ 
            // Ürün oluşturma/güncelleme (tüm alanlar dahil değilmiştir)
            'code' => 'DDDDD',
            'name' => 'Test Ürün',
            'invoiceName' => 'Ürünün fatura adı',
            'status' => 1,
            'seq' => 0,
            'barcode' => '88999000000',
            'mpn' => '',
            'shortDescription' => 'Ürün alt başlığı',
            'brand' => 'Apple',
            'category1' => 'Elektronik',
            'category2' => 'Cep Telefonu',
            'category3' => 'Akıllı Telefonlar',
            'longDescription' => 'HTML açıklama',
            'seoTitle' => 'SEO başlığı',
            'seoKeywords' => 'apple, iphone',
            'seoDescription' => 'Test açıklama',
            'taxRate' => 18,
            'shipmentPayment' => 1,
            'currency' => 'TL',
            'buyPrice' => 25.50,
            'listPrice' => 90.50,
            'salePrice' => 50.99,
            'fastSalePrice' => 33.30,
            'dealerPrice1' => 34.30,
            'dealerPrice2' => 35.30,
            'dealerPrice3' => 36.30,
            'dealerPrice4' => 38.30,
            'unit' => 0,
            'quantity' => 25,
            'desi' => 15,
            'domestic' => 1,
            'specialCode1' => 'aa',
            'specialCode2' => '',
            'specialCode3' => '',
            'variant1Name' => 'Renk',
            'variant2Name' => 'Beden',
            'variant3Name' => '',
            'marketplacePrices' => [
                [
                    'type' => 'n11',
                    'currency' => 'USD',
                    'price' => 5
                ],
                [
                    'type' => 'hb',
                    'currency' => 'USD',
                    'price' => 6
                ],
                [
                    'type' => 'gg',
                    'currency' => 'USD',
                    'price' => 5.35
                ],
                [
                    'type' => 'eptt',
                    'currency' => 'EUR',
                    'price' => 4.3
                ],
                [
                    'type' => 'amz',
                    'currency' => 'USD',
                    'price' => 6.7
                ],
                [
                    'type' => 'ty',
                    'currency' => 'USD',
                    'price' => 5.60
                ],
                [
                    'type' => 'cs',
                    'currency' => 'TL',
                    'price' => 51.99
                ]
            ],
            'variants' => [ 
                [
                    'value1' => 'Kırmızı',
                    'value2' => 'S',
                    'barcode' => '6242005259000',
                    'quantity' => 3,
                    'priceStatus' => 0,
                    'price' => 0
                ],
                [
                    'value1' => 'Kırmızı',
                    'value2' => 'M',
                    'barcode' => '6242005259001',
                    'quantity' => 10,
                    'priceStatus' => 0,
                    'price' => 0
                ],
                [
                    'value1' => 'Sarı',
                    'value2' => 'S',
                    'barcode' => '6242005259002',
                    'quantity' => 5,
                    'priceStatus' => 0,
                    'price' => 0
                ],
                [
                    'value1' => 'Sarı',
                    'value2' => 'M',
                    'barcode' => '6242005259003',
                    'quantity' => 7,
                    'priceStatus' => 1,
                    'price' => 99.99
                ],
            ],
            'images' => [
                [
                    'imageUrl' => 'https://wwww.siteadresi.com/images1.jpg'
                ],
                [
                    'imageUrl' => 'https://wwww.siteadresi.com/images2.jpg'
                ],
                [
                    'imageUrl' => 'https://wwww.siteadresi.com/images3.jpg'
                ]
            ],
            'attributes' => [
                [
                    'name' => 'Sezon',
                    'value' => '2021',
                ],
                [
                    'name' => 'Cinsiyet',
                    'value' => 'Erkek'
                ],
                [
                    'name' => 'Cinsiyet',
                    'value' => 'Kadın'
                ]
            ]
        ],

    ]
];

// Post data via curl

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    "apikey: ".$api_key,
    "apisecret: ".$api_secret,
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
$result = curl_exec ($ch); 
var_dump($result);
$err = curl_error($ch); 

curl_close ($ch);
$response = json_decode($result, true);
var_dump($response);
if (is_array($response)) {

   	print_r($response);

} else{ // Hatalı
    echo "Hata";
}

?>
