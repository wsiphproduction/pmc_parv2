$(function(){
    'use strict'
    // Basic with search
    $('.select2').select2({
        placeholder: 'Choose one',
        searchInputPlaceholder: 'Search options'
    });

    // Disable search
    $('.select2-no-search').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose Search Category'
    });

    // Disable search
    $('.select2-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose Status'
    });
});