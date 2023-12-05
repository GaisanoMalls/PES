(function ($) {
    "use strict";
    var $wrapper = $(".main-wrapper");
    var $pageWrapper = $(".page-wrapper");
    var $slimScrolls = $(".slimscroll");
    var Sidemenu = function () {
        this.$menuItem = $("#sidebar-menu a");
    };
    function init() {
        var $this = Sidemenu;
        $("#sidebar-menu a").on("click", function (e) {
            if ($(this).parent().hasClass("submenu")) {
                e.preventDefault();
            }
            if (!$(this).hasClass("subdrop")) {
                $("ul", $(this).parents("ul:first")).slideUp(350);
                $("a", $(this).parents("ul:first")).removeClass("subdrop");
                $(this).next("ul").slideDown(350);
                $(this).addClass("subdrop");
            } else if ($(this).hasClass("subdrop")) {
                $(this).removeClass("subdrop");
                $(this).next("ul").slideUp(350);
            }
        });
        $("#sidebar-menu ul li.submenu a.active")
            .parents("li:last")
            .children("a:first")
            .addClass("active")
            .trigger("click");
    }
    init();
    $("body").append('<div class="sidebar-overlay"></div>');
    $(document).on("click", "#mobile_btn", function () {
        $wrapper.toggleClass("slide-nav");
        $(".sidebar-overlay").toggleClass("opened");
        $("html").addClass("menu-opened");
        return false;
    });
    $(".sidebar-overlay").on("click", function () {
        $wrapper.removeClass("slide-nav");
        $(".sidebar-overlay").removeClass("opened");
        $("html").removeClass("menu-opened");
    });
    if ($(".page-wrapper").length > 0) {
        var height = $(window).height();
        $(".page-wrapper").css("min-height", height);
    }
    $(window).resize(function () {
        if ($(".page-wrapper").length > 0) {
            var height = $(window).height();
            $(".page-wrapper").css("min-height", height);
        }
    });
    if ($(".select").length > 0) {
        $(".select").select2({ minimumResultsForSearch: -1, width: "100%" });
    }
    if ($(".datetimepicker").length > 0) {
        $(".datetimepicker").datetimepicker({
            format: "DD/MM/YYYY",
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down",
                next: "fa fa-angle-right",
                previous: "fa fa-angle-left",
            },
        });
        $(".datetimepicker")
            .on("dp.show", function () {
                $(this)
                    .closest(".table-responsive")
                    .removeClass("table-responsive")
                    .addClass("temp");
            })
            .on("dp.hide", function () {
                $(this)
                    .closest(".temp")
                    .addClass("table-responsive")
                    .removeClass("temp");
            });
    }
    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
    }
    if ($(".datatable").length > 0) {
        $(".datatable").DataTable({ bFilter: false });
    }
    if ($(".clickable-row").length > 0) {
        $(document).on("click", ".clickable-row", function () {
            window.location = $(this).data("href");
        });
    }
    $(document).on("click", "#check_all", function () {
        $(".checkmail").click();
        return false;
    });
    if ($(".checkmail").length > 0) {
        $(".checkmail").each(function () {
            $(this).on("click", function () {
                if ($(this).closest("tr").hasClass("checked")) {
                    $(this).closest("tr").removeClass("checked");
                } else {
                    $(this).closest("tr").addClass("checked");
                }
            });
        });
    }
    $(document).on("click", ".mail-important", function () {
        $(this).find("i.fa").toggleClass("fa-star").toggleClass("fa-star-o");
    });
    if ($(".summernote").length > 0) {
        $(".summernote").summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: false,
        });
    }
    if ($(".proimage-thumb li a").length > 0) {
        var full_image = $(this).attr("href");
        $(".proimage-thumb li a").click(function () {
            full_image = $(this).attr("href");
            $(".pro-image img").attr("src", full_image);
            $(".pro-image img").parent().attr("href", full_image);
            return false;
        });
    }
    if ($("#pro_popup").length > 0) {
        $("#pro_popup").lightGallery({ thumbnail: true, selector: "a" });
    }
    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: "auto",
            width: "100%",
            position: "right",
            size: "7px",
            color: "#ccc",
            allowPageScroll: false,
            wheelStep: 10,
            touchScrollStep: 100,
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $(".sidebar .slimScrollDiv").height(wHeight);
        $(window).resize(function () {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $(".sidebar .slimScrollDiv").height(rHeight);
        });
    }
    $(document).on("click", "#toggle_btn", function () {
        if ($("body").hasClass("mini-sidebar")) {
            $("body").removeClass("mini-sidebar");
            $(".subdrop + ul").slideDown();
        } else {
            $("body").addClass("mini-sidebar");
            $(".subdrop + ul").slideUp();
        }
        setTimeout(function () {
            mA.redraw();
            mL.redraw();
        }, 300);
        return false;
    });
    $(document).on("mouseover", function (e) {
        e.stopPropagation();
        if (
            $("body").hasClass("mini-sidebar") &&
            $("#toggle_btn").is(":visible")
        ) {
            var targ = $(e.target).closest(".sidebar").length;
            if (targ) {
                $("body").addClass("expand-menu");
                $(".subdrop + ul").slideDown();
            } else {
                $("body").removeClass("expand-menu");
                $(".subdrop + ul").slideUp();
            }
            return false;
        }
    });
})(jQuery);
$(document).ready(function () {
    $("#employees").DataTable({
        deferRender: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ route('employees.index') }}",
        },
        columns: [
            { data: "employee_id" },
            { data: "name" },
            { data: "department.name" },
            { data: "position" },
            { data: "status" },
            { data: "join_date" },
            { data: "actions" },
        ],
    });
});
$(document).ready(function () {
    $("#role").on("change", function () {
        if ($(this).val() == 2) {
            $("#department-group").show();
        } else {
            $("#department-group").hide();
        }
    });

    // Initially hide the department dropdown if the role is not 'Approver'
    if ($("#role").val() != 2) {
        $("#department-group").hide();
    }
});
$(document).ready(function () {
    $("#bu-group").hide(); // Initially hide the Business Unit dropdown

    $("#role").on("change", function () {
        var selectedRoleId = $(this).val();

        if (selectedRoleId == 2 || selectedRoleId == 3) {
            $("#bu-group").show(); // Show the Business Unit dropdown for roles 2 and 3
        } else {
            $("#bu-group").hide(); // Hide the Business Unit dropdown for other roles
        }
    });

    // Initialize the visibility based on the current selected role
    if ($("#role").val() == 2 || $("#role").val() == 3) {
        $("#bu-group").show();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("recommendations").value =
        "Default recommendation text";
    document.getElementById("ratee_comments").value =
        "Default ratee's comments text";
});

// Show modal when "Disapprove Evaluation" button is clicked
document.getElementById("disapproveBtn").addEventListener("click", function () {
    $("#disapprovalModal").modal("show");
});
// Add an event listener to the clickable footer link
// Function to set date values based on the selected option
function setDates() {
    var dateRangeSelector = document.getElementById("dateRangeSelector");
    var fromDateInput = document.getElementById("fromDate");
    var toDateInput = document.getElementById("toDate");

    var today = new Date();
    var fromDate = new Date();

    if (dateRangeSelector.value === "7") {
        // Last 7 Days
        fromDate.setDate(today.getDate() - 7);
    } else if (dateRangeSelector.value === "30") {
        // Last 30 Days
        fromDate.setDate(today.getDate() - 30);
    } else if (dateRangeSelector.value === "60") {
        // Last 60 Days
        fromDate.setDate(today.getDate() - 60);
    }

    // Set the values of the date inputs
    fromDateInput.valueAsDate = fromDate;
    toDateInput.valueAsDate = today;
}

// Function to be called when the search button is clicked
function searchData() {
    // Perform your search logic here
    // You may want to add an AJAX call to send the selected date range to the server
}

// Set initial dates on page load
setDates();

// Attach the setDates function to the change event of the date range selector
document
    .getElementById("dateRangeSelector")
    .addEventListener("change", setDates);
