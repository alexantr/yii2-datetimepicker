if (typeof alexantr === 'undefined' || !alexantr) {
    var alexantr = {};
}

alexantr.dateTimePickerWidget = (function (d) {
    return {
        register: function (inputId, options) {
            var dt = flatpickr('#' + inputId, options);
            var input = d.getElementById(inputId);
            input.onchange = function () {
                dt.setDate(input.value);
            }
        }
    }
})(document);
