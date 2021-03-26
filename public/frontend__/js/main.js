$(document).ready(function () {
    //filter
    $(".addon__filter .filter__title").on("click", function () {
        $(".addon__filter .filter__body").slideToggle();
        $(this).toggleClass("active");
    });
   
    $(".form__cart--group .btn__number").click(function () {

        let hPlus = $(this).hasClass('btn__plus');
        let hMinus = $(this).hasClass('btn__minus');
        if (hPlus) {
            let val = $(this).prev().val();
            let kq = parseInt(val) + 1;
            $(this).prev().val(kq);
        }

        if (hMinus) {
            let val = $(this).next().val();
            if (val > 1) {
                let kq = val - 1;
                $(this).next().val(kq);
            } else {
                let kq = '1';
            }
        }
    });

    $('#iDplay__1').click(function () {
        $('.form__bank').css("display", "none");
    });
    $('#iDplay__2').click(function () {
        $('.form__bank').css("display", "block");
    })
});


