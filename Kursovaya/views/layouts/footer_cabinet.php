<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(".button-open-form").click(function() {
        $("#sForm").toggleClass("open");
    });

    $(".button-close-form").click(function() {
        $("#sForm").toggleClass("open");
    });

    $(".controlTd").click(function() {
        $(this).children(".settingsIcons").toggleClass("display");
        $(this).children(".settingsIcon").toggleClass("openIcon");
    });
</script>

<script>
    $but = $('#file-btn');
    $file = $('#file-input');
    $but.bind("click", function() {
        $file.click();
    });

    $file.change(function() {
        //trim removes whitespace
        if ($.trim($file.val()) != "") $but.addClass('selected');
        else $but.removeClass('selected');
    });
</script>

</body>

</html>