'use strict';
(function (window, $) {
    window.ChangeStatusApp = function ($container) {
        this._s = {
            statusContainer: '.js-status',
            btn: '.js-change_status',
        };
        this.$container = $container;

        //click button with new status
        this.$container.on("click", this._s.btn, this.handleFormSubmit.bind(this));
    };

    $.extend(window.ChangeStatusApp.prototype, {
        handleFormSubmit(e) {
            e.preventDefault();

            const self = this;
            const $target = $(e.currentTarget);
            const url = $target.data('url');
            const param = {'transition': $target.val()};

            $.ajax({
                url: url,
                method: 'POST',
                data: param,
                success: (data) => {
                    $target.closest(self._s.statusContainer).html(data.html);
                },
                error: (jqXHR) => {
                    const responseText = JSON.parse(jqXHR.responseText);
                    const message = responseText.msg;
                    alert(message);
                }
            });
        }
    });
})(window, jQuery);