# Immrama
A live notated graphic score

## Requirements
This requires the python library svgwrite, the Bravura font and inkscape.

## Display
These scripts generate HTML, which you can view in a web browser while running it, or, to view on multiple devices, you will need a web server.

To output to your web directory, *copy* the contents of data to your webdir, then edit config.ini and change dir to be your web dir

## Setup
You will need to decide how long long you wan the overall duration to be, in seconds. Edit the config.ini file to put that number for dur.

Then you will need to decide how long you want each image of notation to display before going on to the next one. Put that duration in seconds for slide_dur

If you want a pause before starting, set init_sleep to any number aside from 0.  This initial pause will be in addition to the pause while the first notation image is generated

Set inkscape to have the path to inkscape on your computer

## Run
From the command line, start the piece:
    ./immrama
