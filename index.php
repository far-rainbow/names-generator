<?php
header( 'Content-type: text/html; charset=utf-8' );
$familySize = 1;
$namesPerCountry = 1;

$countries = array(
    
    "ar",
    "au",
    "br",
    "celat",
    "ch",
    "zhtw",
    "hr",
    "cs",
    "dk",
    "nl",
    "en",
    "er",
    "fi",
    "fr",
    "gr",
    "gl",
    "sp",
    "hobbit",
    "hu",
    "is",
    "ig",
    "it",
    "jpja",
    "jp",
    "tlh",
    "ninja",
    "no",
    "fa",
    "pl",
    "ru",
    "rucyr",
    "gd",
    "sl",
    "sw",
    "th",
    "vn"

);

foreach ($countries as $countryCode) {
    
    $namesPerCountryInline = $namesPerCountry;
    
    while ($namesPerCountryInline --) {
        
        $postReq = array(
            'family-size' => $familySize,
            'n' => $countryCode,
            'sim-1-gender' => 'random'
        );
        
        $curlA = curl_init();
        
        curl_setopt($curlA, CURLOPT_URL, "https://www.fakenamegenerator.com/includes/sims.php");
        curl_setopt($curlA, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlA, CURLOPT_POST, true);
        curl_setopt($curlA, CURLOPT_POSTFIELDS, $postReq);
        curl_setopt($curlA, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($curlA);
        
        $pattern = '/^.*\bsim-1-first\b.*$/m';
        $nameLine = array();
        preg_match($pattern, $result, $nameLine);
        
        $resultName = array();
        $pattern = '#<\s*?input\b[^>]*>(.*?)</td\b[^>]*>#s';
        preg_match($pattern, $nameLine[0], $resultName);
        
        // print($countryCode . ' -> '. $resultName[1]);
        print($resultName[1]);
        print '<br>' . PHP_EOL;
        if (ob_get_level()!=0) ob_flush();
        flush();
    }
}
curl_close($curlA);
