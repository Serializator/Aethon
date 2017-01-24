<!DOCTYPE html>
<html>
    <head>
        <title>Aethon - ROC Ter AA (Web Development): Top 2000</title>
        <link type="text/css" rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body onload="filter()">
        <div id="container">
            <div id="filters">
                <input type="text" placeholder="Specify the Title" id="filter-title" onchange="filter()" />
                <input type="text" placeholder="Specify the Artist" id="filter-artist" onchange="filter()" />
                <input type="text" placeholder="Specify the Year" id="filter-year" onchange="filter()" />
                <input type="text" placeholder="Specify the Offset" id="filter-offset" onchange="filter()" />
                <input type="text" placeholder="Specify the Limit" id="filter-limit" onchange="filter()" />
            </div>

            <table id="songs" cellspacing="0">
                <thead>
                    <th></th>
                    <th>Nr.</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Playtime</th>
                </thead>
            </table>
        </div>

        <script src="assets/js/filter.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </body>
</html>
