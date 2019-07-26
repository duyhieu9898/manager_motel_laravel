$(document).ready(function() {
    var dateObj = new Date();
    var month = dateObj.getMonth() + 1; //months from 1-12
    var day = dateObj.getDate();
    var year = dateObj.getFullYear();
    var weekday = new Array(7);
    weekday[0] = "Chủ Nhật";
    weekday[1] = "Thứ Hai";
    weekday[2] = "Thứ Ba";
    weekday[3] = "Thứ Tư";
    weekday[4] = "Thứ Năm";
    weekday[5] = "Thứ Sáu";
    weekday[6] = "Thứ Bảy";

    var weekOfday = weekday[dateObj.getDay()];
    newdate = weekOfday + ", " + day + "/" + month + "/" + year;
    $('.date-curent').html(newdate);


    $("#next").click(function(e) {
        // body...
        console.log("cc");
        var root = $(".active");
        var next = $(".active").next();
        console.log(root);
        console.log(next);
        console.log(next.next());
        console.log(next.next().next());
        console.log(next.next().next().next());
        // var root=document.getElementsByClassName("active");

        // root.classList.remove("active");
        // next.classList.add("active");
    });
    $("#prev").click(function(e) {
        // body...
        console.log("cc");
    });
    window.setTimeout(function() {
        $(".booking-success").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
});