export default {
    enableApi : true,
    thumbnails : {
        box : '<div class="fileuploader-items">' +
            '<ul class="fileuploader-items-list">' +
            '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">' +
            '<div class="flex min-h-full">' +
            '<div class="flex-1 self-center">' +
            '+' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</li>' +
            '</ul>' +
            '</div>',
        item : '<li class="fileuploader-item">' +
            '<div class="fileuploader-item-inner">' +
            '<div class="thumbnail-holder">${image}</div>' +
            '<div class="actions-holder">' +
            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
            '<span class="fileuploader-action-popup"></span>' +
            '</div>' +
            '<div class="progress-holder">${progressBar}</div>' +
            '</div>' +
            '</li>',
        item2 : '<li class="fileuploader-item">' +
            '<div class="fileuploader-item-inner">' +
            '<div class="thumbnail-holder">${image}</div>' +
            '<div class="actions-holder">' +
            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
            '<span class="fileuploader-action-popup"></span>' +
            '</div>' +
            '</div>' +
            '</li>',
        startImageRenderer : true,
        canvasImage : false,
        _selectors : {
            list : '.fileuploader-items-list',
            item : '.fileuploader-item',
            start : '.fileuploader-action-start',
            retry : '.fileuploader-action-retry',
            remove : '.fileuploader-action-remove'
        },
        onItemShow : function (item, listEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input');

            plusInput.hide();

            if (item.format == 'image') {
                item.html.find('.fileuploader-item-icon').hide();
            }
        },
        onItemRemove : function (itemEl, listEl, parentEl, newInputEl, inputEl) {
            itemEl.children().remove();
            $('.file-has-popup').remove();

            var plusInput = listEl.find('.fileuploader-thumbnails-input');

            plusInput.show();
        },
    },
    afterRender : function (listEl, parentEl, newInputEl, inputEl) {
        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
            api       = $.fileuploader.getInstance(inputEl.get(0));

        plusInput.on('click', function () {
            api.open();
        });
    },
}