(function ($) {
    "use strict";

    $(document).ready(function () {
        // Function to toggle the front switcher
        $(".dt__frontswitcher-iconcog").on("click", function () {
            var frontSwitcher = $(".dt__frontswitcher");
            var switcherRight = frontSwitcher.css("right");

            if (switcherRight === "-225px") {
                frontSwitcher.animate({ "right": "0" });
            } else {
                frontSwitcher.animate({ "right": "-=225" });
            }
        });

        // Function to handle front switcher background click
        $(".dt__frontswitcher-background").on("click", function () {
            var layout = $(this).attr("value");

            $(".dt__frontswitcher-background").removeClass("active");
            $(this).addClass("active");

            localStorage.setItem("layout", layout);

            if (layout === "wide") {
                $("body").removeClass("background-boxed").css("backgroundImage", "");
                $(".background-pattern").hide();
            } else {
                $("body").addClass("background-boxed");
                $(".background-pattern").show();
            }
        });

        // Function to handle front switcher pattern click
        $(".dt__frontswitcher-pattern").on("click", function () {
            if (localStorage.getItem("layout") === "boxed") {
                var backgroundImage = $(this).css("backgroundImage");
                $("body").css("backgroundImage", backgroundImage);
                localStorage.setItem("backgroundImage", backgroundImage);
            }
        });

        // Function to handle main and secondary color button clicks
        function handleColorButtonClick(button, colorKey, colorType) {
            var id = button.attr("id");
            var color = button.css("backgroundColor");
            var rgbValues = color.match(/\d+/g);
            var RGB = colorType === 'rgb' ? rgbValues[0]+','+rgbValues[1]+','+rgbValues[2] : color;

            $(".custom-color." + colorKey + " button").removeClass("active");
            $("#" + id).addClass("active");

            localStorage.setItem("colorskins_" + colorKey, RGB);

            var rootCss = ":root {--dt-" + colorKey + "-"+colorType+":" + RGB + " !important;}";

            $("#customCss_" + colorKey).html(rootCss);
        }

        // Event handlers for main and secondary color buttons
        $(".custom-color.main button").on("click", function () {
            handleColorButtonClick($(this), "main", "rgb");
        });

        $(".custom-color.secondary button").on("click", function () {
            handleColorButtonClick($(this), "secondary", "color");
        });

        // Initialize color settings based on local storage
        $("body").each(function () {
            var mainColor = localStorage.getItem("colorskins_main");
            var secondaryColor = localStorage.getItem("colorskins_secondary");
            var layout = localStorage.getItem("layout");
            if (mainColor) {
                $(".custom-color.main button").removeClass("active");
                $(".custom-color.main button").each(function () {
                    if ($(this).css("backgroundColor") === mainColor) {
                        $(this).addClass("active");
                    }
                });
                $("#customCss_main").html(":root {--dt-main-rgb:" + mainColor + " !important;}");
            }

            if (secondaryColor) {
                $(".custom-color.secondary button").removeClass("active");
                $(".custom-color.secondary button").each(function () {
                    if ($(this).css("backgroundColor") === secondaryColor) {
                        $(this).addClass("active");
                    }
                });
                $("#customCss_secondary").html(":root {--dt-secondary-color:" + secondaryColor + " !important;}");
            }

            if (!layout) {
                $(".dt__frontswitcher-pattern").removeClass("active");
                $("#wide").addClass("active");
                $("body").removeClass("background-boxed");
                localStorage.setItem("layout", "wide");
                $(".background-pattern").hide();
            }

            $("#" + layout).addClass("active");

            if (layout === "boxed") {
                $("body").css("backgroundImage", localStorage.getItem("backgroundImage"));
                $("body").addClass("background-boxed");
            }
        });

        // Dark mode switch
        $('.switch_btn').on('click', function () {
            var isDarkMode = $(document.documentElement).attr('data-theme') === 'dark';
            $(document.documentElement).attr('data-theme', isDarkMode ? 'light' : 'dark');
            localStorage.setItem('toggled', isDarkMode ? '' : 'dark');
        });

        // Initialize dark mode based on local storage
        var isDarkMode = localStorage.getItem('toggled') === 'dark';
        $(document.documentElement).attr('data-theme', isDarkMode ? 'dark' : 'light');
        $('.switch_btn').prop("checked", isDarkMode);

        // Reset settings
        $(document).on('click', '.dt__frontswitcher-reset', function () {
            localStorage.clear();
            $('#customCss_main, #customCss_secondary').html('');
            $("body").removeClass("background-boxed").css("backgroundImage", '');
            $(".dt__frontswitcher-background").removeClass("active").first().addClass("active");
            $(".custom-color.main button, .custom-color.secondary button").removeClass("active").first().addClass("active");
            $(".background-pattern").hide();
            $(document.documentElement).attr('data-theme', '');
            $('.switch_btn').prop("checked", false);
        });
    });
})(jQuery);
