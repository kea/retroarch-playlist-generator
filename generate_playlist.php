<?php

const ROMS_DIR = '/Users/kea/Roms/roms/arcade/';
const REMOTE_ROMS_DIR = '/storage/roms/arcade/';
const LOCAL_XML_DAT_FILE = __DIR__.'/mame2003-plus.xml';
const REMOTE_XML_DAT_FILE = 'https://raw.githubusercontent.com/libretro/mame2003-plus-libretro/master/metadata/mame2003-plus.xml';
const ADD_CRC = false;

if (!file_exists(LOCAL_XML_DAT_FILE)) {
    echo 'Downloading xml file... ';
    copy(REMOTE_XML_DAT_FILE, LOCAL_XML_DAT_FILE);
    echo "done.\n";
}

$xml = simplexml_load_file(LOCAL_XML_DAT_FILE);

$games = [];
$gamesCount = 0;
foreach ($xml as $game) {
    $filename = ROMS_DIR.$game['name'].'.zip';
    if (!file_exists($filename)) {
        continue;
    }
    $crc32 = ADD_CRC ? hash('crc32b', file_get_contents($filename)) : 'DETECT';
    $games[] = [
        'path' => REMOTE_ROMS_DIR.$game['name'].'.zip',
        'label' => (string)$game->description,
        'core_path' => '/tmp/cores/mame2003_plus_libretro.so',
        'core_name' => 'DETECT',
        'crc32' => $crc32,
        'db_name' => 'MAME.lpl'
    ];
    $gamesCount++;
}
echo $gamesCount." games found\n";

$playlist = ['version' => '1.0', 'items' => $games];
$playlistContent = strtr(json_encode($playlist, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), ['    ' => '  ']);
file_put_contents('MAME.lpl', $playlistContent);
