$(document).ready(function() {
    setUpSliders()
    const movieList = $("#movie-list-container")
    const pages = document.getElementById('pager').textContent;
    var activeGenre
    var activeSort
    var searchQuery = ""
    var currPage = 1;

    const genreList = document.querySelectorAll('.genre-selector')
    const sortList = document.querySelectorAll('.sort-selector')
    const search = $('#search-movie')
    // console.log(genreList)
    $(window).scroll(function () {
        const currScroll = $(window).scrollTop() + $(window).height() + 1;
        if (currScroll >= $(document).height() && pages > currPage && !activeGenre && !activeSort) {
            currPage++
            loadMovies(currPage)
        }

    });

    search.keyup(function (e) {
        if(e.keyCode == 13) {
            searchQuery = $(this).val();
            movieList.empty()
            loadMovieQuery()
        }
    });

    genreList.forEach((genreBtn) => {
        genreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (genreBtn.classList.contains('btn-active')) {
                genreBtn.classList.remove('btn-active')
                activeGenre = undefined
                emptyMovieList()
            } else {
                if (activeGenre) {
                    activeGenre.classList.remove('btn-active');
                }
                genreBtn.classList.add('btn-active')
                activeGenre = genreBtn;
                loadMovieQuery()
            }
        })
    });


    sortList.forEach((sortBtn) => {
        sortBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (sortBtn.classList.contains('btn-active')) {
                sortBtn.classList.remove('btn-active')
                activeSort = undefined
                emptyMovieList()
            } else {
                if (activeSort) {
                    activeSort.classList.remove('btn-active');
                }
                sortBtn.classList.add('btn-active')
                activeSort = sortBtn;
                loadMovieQuery()
            }
        })
    });

    function loadMovies(page) {
        console.log(page)
        $.ajax({
                url: "?page="+page,
                type: "get",
            })
            .done(function(data) {
                if (data.html == " " || !data.html) {
                    return;
                }
                movieList.append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log(jqXHR)
                console.log(ajaxOptions)
                alert(thrownError)
            });
    }


    function loadMovieQuery() {
        const sort = (!activeSort ? "-1" : activeSort.textContent.trim())
        const genre = (!activeGenre ? "-1" : activeGenre.textContent.trim())
        const search = (!searchQuery || searchQuery == "" ? "-1" : searchQuery.trim())
        if (sort == "-1" && genre == "-1" && search == "-1") {
            currPage = 1;
            loadMovies(currPage);
            return;
        }
        $.ajax({
            url: "?sort="+sort+'&genre='+genre+'&search='+search,
            type: "get",
        })
        .done(function(data) {
            // console.log(data.html)
            if (data.html == " " || !data.html) {
                return;
            }
            movieList.empty()
            movieList.append(data.html)
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log(jqXHR)
            console.log(ajaxOptions)
            alert(thrownError)
        });
    }

    function emptyMovieList() {
        movieList.empty()
        currPage = 1;
        loadMovies(currPage)
    }
});


function setUpSliders() {
    const property = {
        auto:true,
        item : 5,
        pauseOnHover: true,
        slideMargin : 30,
        addClass: '',
        mode: "slide",
        useCSS: true,
        cssEasing: 'ease',
        easing: 'linear',
    }

    $('.movie-slider').lightSlider(property);
    const updatedProperty = property
    updatedProperty.item = 6;
    $('.movie-genre-slider').lightSlider(updatedProperty);
}

