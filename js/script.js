$(document).ready(function () {
    $("#filter").on("submit", function (e) {
        e.preventDefault();
        $.post('/Controller/filter.php', $('#filter').serialize(), function(data){
            $(".corpus").html($(data).find('.box'));
            $('.fail__message').css("display", "block");
            $('.obj').remove();
            $('.footer').remove();
        });
    });
});
$(document).ready(function () {
    $("#adder").on("submit", function (e) {
        e.preventDefault();
        $.post("/Controller/add.php", $('#adder').serialize(), function(data){
            alert('ok');
            console.log(data);
        });
    });
});

(function($) {
    var $wrap = $('#select_platform');
    $wrap.on('change', 'select', function() {
        let i = $('.new-platform').length;
        if (i !== 3) {
        let obj = $(this).clone();
        obj.attr('id', "p_" + i);
        obj.appendTo('.new-platform-box');
    } else {
            alert('Максимальное количество платформ!')
        }
    });
})(jQuery);

(function($) {
    var $wrap = $('#select_type');
    $wrap.on('change', 'select', function() {
        let i = $('.new-type').length;
        if (i !== 2) {
            let obj = $(this).clone();
            obj.attr('id', "t_" + i);
            obj.appendTo('.new-type-box');
        } else {
            alert('Уже выбраны все типы изданий!')
        }
    });
})(jQuery);

(function($) {
    var $wrap = $('#new-photo');
    $wrap.on('change', 'input', function() {
        let i = $('.new-photo').length;
        if (i !== 4) {
            $(this).after('<input type="file" class="new-photo input" value="Загрузите фото" id="ph_'+ i +'">');
        } else {
            alert('Достаточно фотографий!')
        }
    });
})(jQuery);