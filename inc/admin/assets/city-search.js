jQuery(document).ready(function ($) {

    let searchTerm = '';

    function getData(){
        
        $.ajax({
            url: citySearchAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'search_cities',
                search: searchTerm,
            },
            beforeSend: function () {
                $('#city-results tbody').html('<tr><td colspan="3">Loading...</td></tr>');
            },
            success: function (response) {
                $('#city-results tbody').html(response);
            },
            error: function () {
                $('#city-results tbody').html('<tr><td colspan="3">An error occurred.</td></tr>');
            },
        });

    }

    $('#city-search-button').on('click', function () {
        searchTerm = $('#city-search').val();
        getData();
    });

    $('#city-clear-button').on('click', function () {
        searchTerm = '';
        $('#city-search').val('');
        getData();
    });

    getData();

});
