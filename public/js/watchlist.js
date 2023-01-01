$(document).ready(function () {
    var searchQuery = ""
    var filterQuery = ""

    const container = $("#watchlist-container")
    const search = $('#search-watchlist')
    const filter = $('#filter')
    search.keyup(function (e) {
        if(e.keyCode == 13) {
            searchQuery = $(this).val();
            loadWatchList()
        }
    });

    $('#curr-page').bind('DOMSubtreeModified', function(){
        console.log('changed');
    });

    filter.change(function (e) {
        e.preventDefault();
        filterQuery = e.target.value;
        loadWatchList()
    });

    function loadWatchList() {
        const query = (!searchQuery || searchQuery == "" ? "" : searchQuery.trim())
        if (query && query!="") {
            container.empty()
        }
        $.ajax({
            url: '?search=' + query + '&filter='+filterQuery,
            type: "get",

        }).done(function(data) {
            if (data.view == " " || !data.view) {
                return;
            }
            container.empty()
            container.append(data.view)
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log(jqXHR)
            console.log(ajaxOptions)
            alert(thrownError)
        });
    }

});
