// This is a page-specific JS. You have to add Entry
// (addEntry() function) inside webpack.config.js file
$(document).ready(function () {
    $('.js-toggle-word').click(function (event) {
        console.log("works in reverse file");
        event.preventDefault();

        let $link = $(event.currentTarget);
        let $word = $link.html();
        let $translation = $link.data('toggle');

        if ($link.html() === $word) {
            $link.html($translation);
            $link.data('toggle', $word);
        } else {
            $link.html($word);
            $link.data('toggle', $translation);
        }
    })
});


