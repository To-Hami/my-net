$(document).ready(function () {
    $('#movie__file-input').on('change', function () {

        $('#movie__raper').css('display', 'none');
        $('#movie__properties').css('display', 'block');

        var movie = this.files[0];
        var movieId = $(this).data('movie-id');
        var url = $(this).data('url');
        var movieName = movie.name.split('.').slice(0, -1).join('.');
        $("#movie__name").val(movieName);

        console.log(url);
        var formData = new FormData();
        formData.append('movie_id', movieId);
        formData.append('name', movieName);
        formData.append('movie', movie);


        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (movieBeforePossessing) {
                var interval = setInterval(function () {

                    $.ajax({
                        url: `/dashboard/movies/${movieBeforePossessing.id}`,
                        method: 'GET',
                        success: function (movieWhilePressing) {

                            $("#movieUploading__statues").html('Processing');

                            $("#movie__upload-progress")
                                .css('width', movieWhilePressing.percent + '%')
                                .html(movieWhilePressing.percent + "%");


                            if (movieWhilePressing.percent == 100) {
                                clearInterval(interval);

                                $("#movieUploading__statues").html('Processing Done');
                                $("#movie__upload-progress").parent().css('display', 'none');
                                $("#movie__submit-button").css('display', 'block')

                            }
                        },


                    })

                }, 3000);
            },


            xhr: function () {

                let xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round(evt.loaded / evt.total * 100) + "%";
                        // $("#movie__upload-progress").css('width', percentComplete).html(percentComplete)
                    }
                }, false);
                return xhr;
            }

        })


    });

});


