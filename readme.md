# Project: API Backend with Frontend Integration

This project is an API backend that receives a file through a POST request, stores it on the server, and saves it to
a MySQL database. The file is stored in a designated directory and can be searched for using a unique hash field.
## How It Works

The API server is built without the use of any frameworks and uses Medoo library for the database interaction.
The allowed file formats are PDF and JPEG, and the maximum file size is 5MB. The server returns a hash on successful
upload and an error message on unsuccessful upload.

The frontend is a user-facing part that allows users to select a file from their hard drive and upload it to the API
server. The start page displays a single button, "Start Upload," which opens a pop-up window for selecting and 
uploading the file. During the upload process, a loader is displayed, and an error message is shown in red if there are
any issues. Upon successful upload, a success message is displayed along with the hash received from the API server. 
The "Submit" button is then changed to a "Close" button, which closes the pop-up window when clicked.
## Technologies Used

    PHP
    MySQL
    HTML/CSS
    JavaScript
    Docker

## Future Plans

    Implement authorization on the API server
    Expand the list of allowed file formats
    Improve error handling and messaging

## Start

First of all, you should be able to run `make` commands and have installed Docker.

Run command `make setup` to launch the project.

## Troubleshooting
First start of database docker container can take some time (up to 10 minutes).

If you see `Could not connect to the database!` message while running `make setup`:
1. Check database docker container logs and wait until database is ready for connections;
2. launch `make db-create` to create database