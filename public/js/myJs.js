$(document).ready(function() {
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var checkin = $('#datepickerarrival').datepicker({
        format: 'yyyy-mm-dd',
        beforeShowDay: function(date) {
            return date.valueOf() >= now.valueOf();
        },
        autoclose: true
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
            var newDate = new Date(ev.date);
            newDate.setDate(newDate.getDate() + 1);
            checkout.datepicker("update", newDate);
        }
        $('#datepickerdeparture')[0].focus();
    });
    var checkout = $('#datepickerdeparture').datepicker({
        format: 'yyyy-mm-dd',
        beforeShowDay: function(date) {
            if (!checkin.datepicker("getDate").valueOf()) {
                return date.valueOf() >= new Date().valueOf();
            } else {
                return date.valueOf() > checkin.datepicker("getDate").valueOf();
            }
        },
        autoclose: true
    }).on('changeDate', function(ev) {});
    //format money
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this));
        }
    });
    //
    setMenuActive()
});
function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.
    // get input value
    var input_val = input.val();
    // don't validate empty input
    if (input_val === "") { return; }
    // original length
    var original_len = input_val.length;
    // initial caret position
    var caret_pos = input.prop("selectionStart");
    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");
        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        // add commas to left side of number
        left_side = formatNumber(left_side);
        // validate right side
        right_side = formatNumber(right_side);
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);
        // join number by .
        input_val = "$" + left_side + "." + right_side;
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "$" + input_val;
        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    // send updated string to input
    input.val(input_val);
    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function setMenuActive() {
    const listItem = $('#navbarSupportedContent > .nav.mr-auto > li');
    const categoryId = document.location.pathname.replace('room','').replace(/\//g, '')
    $.each(listItem, (index, item) => {
        if(item.id === categoryId) {
            item.classList.add('active')
        } else {
            item.classList.remove('active')
        }
    })
}
