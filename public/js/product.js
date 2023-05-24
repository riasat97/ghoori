/**
 * Created by riasatraihan on 3/31/2015.
 */

$(".category").change(function(){
    //$(".ad").hide();
    /*alert("hello !!!");*/
    $(".sub-category").show();


});
$(".sub-category").change(function(){
    //$(".ad").hide();
    /*alert("hello !!!");*/
    $(".sub-sub-category").show();


});
/*
$(function() {
    $('select').select2({ 'width':'resolve' });
});
*/


$(".js-data-example-ajax").select2({
    placeholder: "Select a Category",
    ajax: {
        url: "categoryDropDown",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            var input = $('#categoryId').val();
            //console.log(input);
            return {
                s: input,
                // inputBox: inputBoxValue,
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function (data, page) {

            return {

                results: data
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatResults,
    templateSelection : formatSelection

});

function formatResults(data){
    if (data.loading) return data.text;
    // debugger;
    var markup = "<span >"+data.name+"</span>";
    return markup;
}

function formatSelection(data){
    return data.name ;
}

$(".subCategory").select2({
    placeholder: "Select a Sub Category",
    ajax: {
        url: "subCategoryDropDown",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            var input = $('#categoryId').val();
            console.log(input);
            return {
                categoryId: input,
                // inputBox: inputBoxValue,
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function (data, page) {

            return {

                results: data
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatResults,
    templateSelection : formatSelection

});

function formatResults(data){
    if (data.loading) return data.text;
    // debugger;
    var markup = "<span >"+data.name+"</span>";
    return markup;
}

function formatSelection(data){
    return data.name ;
}


$(".subSubCategory").select2({
    placeholder: "Select a Sub Sub Category",
    ajax: {
        url: "subSubCategoryDropDown",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            var input = $('#subCategoryId').val();
            console.log(input);
            return {
                subCategoryId: input,
                // inputBox: inputBoxValue,
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function (data, page) {

            return {

                results: data
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatResults,
    templateSelection : formatSelection

});

function formatResults(data){
    if (data.loading) return data.text;
    // debugger;
    var markup = "<span >"+data.name+"</span>";
    return markup;
}

function formatSelection(data){
    return data.name ;
}

