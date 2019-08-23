# Retroarch playlist generator

Lakka (https://www.lakka.tv/) is my favourite retrogaming distribution for Raspberry Pi. The built-in scanner can create playlist automagically for a bunch of game's platforms but has some problems with MAME. So I wrote this script to generate the playlist file (.lpl) for MAME2003-Plus romsets. If you have different MAME romset version, you can simply modify the constants in the script to matching your collection. The list of the supported sets could be found here (https://github.com/libretro?utf8=%E2%9C%93&q=mame&type=&language=)

## Usage

```
$ php generate_playlist.php
```

