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

    function watchListActions() {
        const actionInput = $('.actionInput')
        actionInput.each(function (indexInArray, valueOfElement) {
            $(this).off('change')
            $(this).on('change', function (e) {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/action/"+$(this).attr('id'),
                    type: "POST",
                    data: {
                        'status': $(this).val(),
                    },
                    contentType: false,
                    processData: false,
                    error: (data) => {
                        console.log(data.responseJSON);
                    },
                    // success: (data) => {
                    //     if (data.isAdd) {
                    //         $(this).html('<i class="fas fa-check text-danger"></i>');
                    //     } else {
                    //         $(this).html('<i class="fas fa-plus text-muted"></i>');
                    //     }
                    // }
                })
            });
        });
    }
});
