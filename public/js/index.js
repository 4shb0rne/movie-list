$(document).ready(function() {
    setUpSliders()
    const movieList = $("#movie-list-container")
    const pages = document.getElementById('pager').textContent;
    var activeGenre
    var activeSort
    var currPage = 1;

    const genreList = document.querySelectorAll('.genre-selector')
    const sortList = document.querySelectorAll('.sort-selector')

    // console.log(genreList)
    $(window).scroll(function () {
        const currScroll = $(window).scrollTop() + $(window).height();
        if (currScroll >= $(document).height() && pages > currPage && !activeGenre && !activeSort) {
            currPage++
            loadMoreData(currPage)
        }

    });
    function loadMoreData(page) {
        console.log(page)
        $.ajax({
                url: "?page="+page,
                type: "get",
            })
            .done(function(data) {
                // console.log(data.html)
                if (data.html == " " || !data.html) {
                    return;
                }
                movieList.append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert(thrownError)
            });
    }

    genreList.forEach((genreBtn) => {
        genreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (genreBtn.classList.contains('btn-active')) {
                genreBtn.classList.remove('btn-active')
                activeGenre = undefined
                movieList.empty()
                currPage = 1;
                loadMoreData(currPage)
            } else {
                if (activeGenre) {
                    activeGenre.classList.remove('btn-active');
                }
                genreBtn.classList.add('btn-active')
                activeGenre = genreBtn;
            }
        })
    });


    sortList.forEach((sortBtn) => {
        sortBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (sortBtn.classList.contains('btn-active')) {
                sortBtn.classList.remove('btn-active')
                activeSort = undefined
            } else {
                if (activeSort) {
                    activeSort.classList.remove('btn-active');
                }
                sortBtn.classList.add('btn-active')
                activeSort = sortBtn;
            }
        })
    });
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

