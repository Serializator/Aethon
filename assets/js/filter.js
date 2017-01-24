var timer;

function filter() {
    var data = {},
        title = $.trim($('#filter-title').val()),
        artist = $.trim($('#filter-artist').val()),
        year = $.trim($('#filter-year').val()),
        offset = $.trim($('#filter-offset').val()),
        limit = $.trim($('#filter-limit').val());

    /* Remove entries from the 'data' object that are empty. */
    if(title.length > 0) {
        data.title = title;
    } else if(title in data) {
        delete data.title;
    }

    if(artist.length > 0) {
        data.artist = artist;
    } else if(artist in data) {
        delete data.artist;
    }

    if(year.length > 0) {
        data.year = year;
    } else if(year in data) {
        delete data.year;
    }

    if(offset.length > 0) {
        data.offset = offset;
    } else {
        delete data.offset;
    }

    if(limit.length > 0) {
        data.limit = limit;
    } else {
        delete data.limit;
    }

    /* Append a table body if not exists, otherwise remove all rows from the existing body. */
    if($('#song-table-body').length > 0) {
        $('#song-table-body').empty();
    } else {
        $(document.createElement('tbody'))
            .attr('id', 'song-table-body')
            .appendTo($('#songs'));
    }

    /* Execute the AJAX request that retrieves the rows from MySQL using the specified filters. */
    $.ajax({
        url: 'search.php',
        type: 'GET',
        data: data,

        success: function(response) {
            var json = jQuery.parseJSON(response);

            for(var key in json) {

                /* Generate the table with jQuery using the JSON response from the AJAX request. */
                $(document.createElement('tr'))
                    .append($(document.createElement('img')).attr('src', ('assets/images/thumbnails/' + json[key].position + '.jpg')).on('error', function() {
                            this.src = 'assets/images/thumbnails/no_thumbnail_available.png';
                    }).appendTo($(document.createElement('td'))))
                    .append($(document.createElement('td')).append($(document.createElement('span')).attr('id', 'song-position').html(json[key].position)))
                    .append($(document.createElement('td')).html(json[key].title))
                    .append($(document.createElement('td')).html(json[key].artist))
                    .append($(document.createElement('td')).html(json[key].year))
                    .append($(document.createElement('td')).html(json[key].playtime))
                    .appendTo($('#song-table-body'));
            }
        }, error: function(xhr) {
            /* Something went wrong... */
        }
    });
}
