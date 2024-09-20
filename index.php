<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* 기본 스타일 */
        body {
            background-color: black;
            color: rgb(0, 255, 0);
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* 문단 스타일 */
        p {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.5;
        }

        /* 제목 스타일 */
        h2 {
            color: rgb(0, 255, 0);
            font-size: 24px;
            margin: 20px 0;
            line-height: 1.5;
        }

        /* 입력 필드 스타일 */
        input {
            background-color: black;
            color: rgb(0, 255, 0);
            border: 2px solid rgb(0, 255, 0);
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border-radius: 5px;
            outline: none;
        }

        input:focus {
            border-color: rgb(0, 200, 0);
        }

        /* 버튼 스타일 */
        button {
            background-color: rgb(0, 255, 0);
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: rgb(0, 200, 0);
        }

        /* 메시지 스타일 */
        #message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php

    $ip_address = $_SERVER['REMOTE_ADDR'];


    $time = date("Y-m-d H:i:s");


    $user_agent = $_SERVER['HTTP_USER_AGENT'];


    $access_key = 'a0a7e18014a9f6c5b91e52102e8f59d4';


    $location_data = file_get_contents("http://api.ipstack.com/{$ip_address}?access_key={$access_key}");
    $location = json_decode($location_data, true);

    $city = isset($location['city']) ? $location['city'] : 'Unknown City';
    $region = isset($location['region_name']) ? $location['region_name'] : 'Unknown Region';
    $country = isset($location['country_name']) ? $location['country_name'] : 'Unknown Country';
    $zip = isset($location['zip']) ? $location['zip'] : 'Unknown Zip';
    $latitude = isset($location['latitude']) ? $location['latitude'] : 'Unknown Latitude';
    $longitude = isset($location['longitude']) ? $location['longitude'] : 'Unknown Longitude';
    $isp = isset($location['connection']['isp']) ? $location['connection']['isp'] : 'Unknown ISP';
    $timezone = isset($location['time_zone']['id']) ? $location['time_zone']['id'] : 'Unknown Timezone';


    $device_type = 'Unknown Device';
    if (preg_match('/mobile/i', $user_agent)) {
        $device_type = 'Mobile';
    } elseif (preg_match('/tablet/i', $user_agent)) {
        $device_type = 'Tablet';
    } else {
        $device_type = 'Desktop';
    }


    $file = '001.txt';

    $data = "IP: $ip_address - Time: $time - Location: $city, $region, $country - Zip: $zip - Lat: $latitude - Lon: $longitude - ISP: $isp - Timezone: $timezone - Device: $device_type - User-Agent: $user_agent";


    file_put_contents($file, $data . PHP_EOL, FILE_APPEND | LOCK_EX);

    ?>

    <p>
        자자, 지금부터 나의 수수께끼를 시작하지<br>
        먼저 첫번째 수수께끼부터 간다
    </p>
    <h2>"사람들은 나를 얻기 위해 싸우고<br>나를 지키기 위해 희생하고<br>나를 쟁취하기를 갈망하지만,<br>정작 나를 얻고나면<br>모두 타락해버리고 말지"</h2>
    
    <input type="text" id="answer" placeholder="Answer">
    
    <button id="submitButton">Submit</button>
    
    <h4 id="message"></h4>

    <script>
        document.getElementById("submitButton").addEventListener("click", function() {
            var answer = document.getElementById("answer").value;
            
            if (answer === '권력') {
                window.open('https://suj5529.github.io/Enigma2.github.io/', '_blank');
            } else {
                document.getElementById("message").textContent = "틀렸다";
            }
        });
    </script>
</body>
</html>