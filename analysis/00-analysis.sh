#!/bin/sh
AUTHOR="wilke"
DIRECTORY="../"
FILES="*.java"
 
#  -i, --ignore-case         Kein Unterschied zwischen Groß- und Kleinschreibung.
#  -w, --word-regexp         MUSTER passt nur auf ganze Wörter.
#  -r, --recursive           wie --directories=recurse

#  -n, --line-number         gibt mit den Zeilen auch die Zeilennummer an
#  -o, --only-matching       zeigt nur den Teil einer Zeile, der zu MUSTER passt
#  -l, --files-with-matches  nur die Namen von Dateien mit passendem Inhalt ausgeben

echo grep -iwrl --include="$FILES" "$DIRECTORY" -e "$AUTHOR" \> 01-filenames.txt
grep -iwrl --include="$FILES" "$DIRECTORY" -e "$AUTHOR" > 01-filenames.txt

echo grep -iwrno --include="$FILES" "$DIRECTORY" -e "$AUTHOR" \> 02-linenumbers.txt
grep -iwrno --include="$FILES" "$DIRECTORY" -e "$AUTHOR" > 02-linenumbers.txt

