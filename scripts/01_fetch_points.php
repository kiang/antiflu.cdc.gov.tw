<?php
$cities = ['臺北市', '基隆市', '新北市', '新竹市', '新竹縣', '桃園市', '苗栗縣', '臺中市', '彰化縣', '南投縣', '雲林縣', '嘉義市', '嘉義縣', '臺南市', '高雄市', '屏東縣', '宜蘭縣', '臺東縣', '花蓮縣', '金門縣', '連江縣', '澎湖縣'];
$targetPath = dirname(__DIR__) . '/raw/covid19';
if(!file_exists($targetPath)) {
    mkdir($targetPath, 0777, true);
}

foreach($cities AS $city) {
    $pCity = urlencode($city);
    $points = exec("curl 'https://antiflu.cdc.gov.tw/Covid19/SearchHospital?SearchValue=&City={$pCity}&District=' -H 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0' -H 'Accept: */*' -H 'Accept-Language: en-US,en;q=0.5' --compressed -H 'X-Requested-With: XMLHttpRequest' -H 'Origin: https://antiflu.cdc.gov.tw' -H 'Connection: keep-alive' -H 'Referer: https://antiflu.cdc.gov.tw/Covid19' -H 'Save-Data: on' -H 'Pragma: no-cache' -H 'Cache-Control: no-cache' -H 'TE: Trailers' --data-raw ''");
    $points = json_decode(json_decode($points), true);
    file_put_contents($targetPath . '/' . $city . '.json', json_encode($points, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
