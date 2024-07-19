(function ($) {
  $('.panel-search').each((index, element) => {
    const input = $(element);
    const target = $(`${input.data('search-target')}`);
    const url = input.data('search-url');
    const state = target.html();

    let
      pending,
      jqXHR = null;

    input.on('input', function () {
      input.prev('div').addClass('spinner-grow');
      clearTimeout(pending);
      jqXHR && jqXHR.abort();

      pending = setTimeout(() => {
        const value = input.val();

        if (0 === value.length || '' === value) {
          input.prev('div').removeClass('spinner-grow');
          return target.html(state);
        }

        jqXHR = $.get(url, { token: value }, (response) => {
          input.prev('div').removeClass('spinner-grow');
          target.html(response);
        });

      }, 500);
    });
  });
})(jQuery);
