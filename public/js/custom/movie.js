$(document).ready(function () {

    let favCount = $('#nav__fav-icon').data('fav-count');

//movie__fav-icon ===============================================================

    $(document).on('click', '.movie__fav-icon', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        let movieId = $(this).data('movie-id');
        let isFavorite = $(this).hasClass('fw-900');

        toggleMovie(url, movieId, isFavorite);

    });


//movie__fav-btn ==================================================================

    $(document).on('click', '.movie__fav-btn', function (e) {
        e.preventDefault();
        let url = $(this).find('.movie__fav-icon').data('url');
        let movieId = $(this).find('.movie__fav-icon').data('movie-id');
        let isFavorite = $(this).find('.movie__fav-icon').hasClass('fw-900');


        toggleMovie(url, movieId, isFavorite);

    });

    //toggleMovie ==================================================================

    function toggleMovie(url, movieId, isFavorite) {
        !isFavorite ? favCount++ : favCount--;

        $('.movie-' + movieId).toggleClass('fw-900');

        favCount > 9 ? $('#nav__fav-icon').html('9+') : $('#nav__fav-icon').html(favCount);


        if ($('.movie-' + movieId).closest('.favorite').length) {

            $('.movie-' + movieId).closest('.movie').remove();
        }


        $.ajax({
            url: url,
            method: 'POST',
            success: function () {

            }

        });
    }
});
