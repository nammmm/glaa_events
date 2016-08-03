# GLAA Event Manager

This is a database project for Junior Indepedent Studies course. It is also done for the program officer of GLAA (Global Liberal Arts Alliance) to manage event participation records. It contains a front-end interface and a MySQL database.

## Screenshot

![GLAA Event Manager Screenshot](https://github.com/nammmm/glaa_events/blob/master/dist/img/screenshot.png?raw=true "Overview")

## Installation

1. Install a local server environment (LAMP, MAMP, WAMP or XAMPP) on the computer.
2. Download this repo as a zip and extract the folder under `htdocs/` folder.
3. Start local servers and enter the relative path of the folder in a browser.
4. Create a database named `glaa_events` and import `glaa_events.sql` file in phpMyAdmin.

## Usage

There are four categories of data: *Institutions*, *Participants*, *Events*, and *Participations*. There are 8 pages in the interface:

- **Overview**: Shows overview of the number of items in each category.
- **Report**: Filters records and exports records into a CSV file.
- **Institutions**: Shows institution data.
- **Participants**: Shows participant data.
- **Events**: Shows event data.
- **Participations**: Shows participation data.
- **Import CSV**: Imports data from a CSV file into the database.
- **Back Up**: Provides instruction on how to back up database using phpMyAdmin.

## Libraries Used

- [BootStrap](http://getbootstrap.com)
- [jQuery](https://jquery.com)
- [DataTables](https://datatables.net)
- [Font Awesome](http://fontawesome.io)
- [Bootbox.js](http://bootboxjs.com)
- [Selectize.js](http://selectize.github.io/selectize.js/)

## Template

[SB Admin 2](http://startbootstrap.com/template-overviews/sb-admin-2/) is an open source, admin dashboard template for [Bootstrap](http://getbootstrap.com/) created by [Start Bootstrap](http://startbootstrap.com/).

## Author

Nan Jiang