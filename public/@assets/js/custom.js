/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/
$(".scrollTop").click(function() {
    $("html, body").animate({ scrollTop: 0 });
});

$(
    ".navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu "
).click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {
    var checker = $("#" + clickchk);
    var multichk = $("." + relChkbox);

    checker.click(function() {
        multichk.prop("checked", $(this).prop("checked"));
    });
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
            var e = $(this).closest("table").find("td:first-child .child-chk"),
                a = $(this).is(":checked");
            $(e).each(function() {
                a
                    ?
                    ($(this).prop("checked", !0),
                        $(this).closest("tr").addClass("active")) :
                    ($(this).prop("checked", !1),
                        $(this).closest("tr").removeClass("active"));
            });
        }),
        tb_var.on("change", "tbody tr .new-control", function() {
            $(this).parents("tr").toggleClass("active");
        });
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {
    var checker = $("#" + clickchk);
    var multichk = $("." + relChkbox);

    checker.click(function() {
        multichk.prop("checked", $(this).prop("checked"));
    });
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$(".bs-tooltip").tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$(".bs-popover").popover();

/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$(".t-dot").tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
});

/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0)
        return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));
    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./)) return 11;
    else return 0; //It is not IE
}

// ============================cutom js==================================== //



// function to format numbers
function numberFormat(number, decimals = 2, decimalSeparator = ".", thousandsSeparator = ",") {
    decimals = typeof decimals !== "undefined" ? decimals : 2;
    decimalSeparator =
        typeof decimalSeparator !== "undefined" ? decimalSeparator : ".";
    thousandsSeparator =
        typeof thousandsSeparator !== "undefined" ? thousandsSeparator : ",";

    var parts = number.toFixed(decimals).split(".");
    var formattedNumber = parts[0].replace(
        /\B(?=(\d{3})+(?!\d))/g,
        thousandsSeparator
    );

    if (decimals > 0) {
        formattedNumber += decimalSeparator + parts[1];
    }

    return formattedNumber;
}

// function to get current date. Format: YYYY-MM-DD
function getCurrentDate() {
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
    var day = String(currentDate.getDate()).padStart(2, '0');

    var formattedDate = year + '-' + month + '-' + day;
    return formattedDate;
}

// function to get age: difference between current date and provided date (YYYY-MM-DD)
function getAge(birthdate) {
    var birthdateObj = new Date(birthdate);
    var currentDate = new Date();

    // Calculate the age
    var age = currentDate.getFullYear() - birthdateObj.getFullYear();

    // Adjust the age if the current month and day are before the birthdate
    if (
        currentDate.getMonth() < birthdateObj.getMonth() ||
        (currentDate.getMonth() === birthdateObj.getMonth() &&
            currentDate.getDate() < birthdateObj.getDate())
    ) {
        age--;
    }
    return age;
}


function formatDate(inputDate) {
    const date = new Date(inputDate);
    const day = date.getDate();
    const monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];
    const monthIndex = date.getMonth();
    const year = date.getFullYear();

    const daySuffix = getDaySuffix(day);

    return `${day}${daySuffix} ${monthNames[monthIndex]}, ${year}`;
}

function getDaySuffix(day) {
    if (day >= 11 && day <= 13) {
        return 'th';
    }
    switch (day % 10) {
        case 1:
            return 'st';
        case 2:
            return 'nd';
        case 3:
            return 'rd';
        default:
            return 'th';
    }
}


/*
 *This section provides list of reusable JS functions that can be called on any view
 */


/**
 * Utilities functions
 **/

//page blocker loader
function blockUiDisplay(message = "") {
    $.blockUI({
        message: message,
        fadeIn: 800,
        //timeout: 2000, //unblock after 2 seconds
        overlayCSS: {
            backgroundColor: "#1b2024",
            opacity: 0.8,
            zIndex: 1200,
            cursor: "wait",
        },
        css: {
            border: 0,
            color: "#fff",
            zIndex: 1201,
            padding: 0,
            backgroundColor: "transparent",
        },
    });
}

function unBlockUiDisplay() {
    $.unblockUI();
}

//function to popup modal for confirming action
function confirmActionModal() {
    if ($(".confirmActionModal")) {
        $(document).on("click", ".confirmActionModal", function(e) {
            e.preventDefault();

            swal({
                title: "Are you sure you want to proceed with this request?",
                confirmButtonText: "Yes, Proceed",
                cancelButtonText: "Cancel",
                showCancelButton: true,
                showCloseButton: true,
                padding: "2em",
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, submit the form
                    document.getElementById(form_id).submit();
                }
            });
        });
    }
}

//this function applies dataTable effect on table with myDataTable class name
function applyDataTable() {
    if ($(".myDataTable")) {
        $(".myDataTable").DataTable({
            dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            oLanguage: {
                oPaginate: {
                    sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                },
                sInfo: "Showing page _PAGE_ of _PAGES_",
                sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                sSearchPlaceholder: "Search...",
                sLengthMenu: "Results :  _MENU_",
            },
            stripeClasses: [],
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"],
            ],
            pageLength: 7,
        });
        // $(".myDataTable").DataTable({
        //     "dom":
        //         "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
        //         "<'table-responsive'tr>" +
        //         "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        //     "oLanguage": {
        //         "oPaginate": {
        //             "sPrevious":
        //                 '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
        //             "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        //         },
        //         "sInfo": "Showing page _PAGE_ of _PAGES_",
        //         "sSearch":
        //             '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        //         "sSearchPlaceholder": "Search...",
        //         "sLengthMenu": "Results :  _MENU_",
        //     },
        //     "stripeClasses": [],
        //     "lengthMenu": [
        //         [7, 10, 20, 50, -1],
        //         [7, 10, 20, 50, "All"],
        //     ],
        //     "pageLength": 7,
        // });
    }
}

function applyCheckerDataTable() {
    if ($(".myCheckerDataTable")) {
        c2 = $(".myCheckerDataTable").DataTable({
            dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML =
                    '<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>';
            },
            columnDefs: [{
                targets: 0,
                width: "30px",
                className: "",
                orderable: !1,
                render: function(e, a, t, n) {
                    return '<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>';
                },
            }, ],
            oLanguage: {
                oPaginate: {
                    sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                },
                sInfo: "Showing page _PAGE_ of _PAGES_",
                sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                sSearchPlaceholder: "Search...",
                sLengthMenu: "Results :  _MENU_",
            },
            lengthMenu: [
                [7, 10, 20, 50, -1],
                [7, 10, 20, 50, "All"],
            ],
            pageLength: 7,
        });

        multiCheck(c2);
    }
}

//this function applies select2 effect on select element provided in param
function applySelect2(select_element = []) {
    if (select_element.length > 0) {
        $.each(select_element, function(index, value) {
            $(value).select2();
        });
    }
}

//this function applies select2 effect on select element in a modal with provided param
function applySelect2OnModal(select_element, dropdown_parent) {
    if ($(select_element).length && $(dropdown_parent).length) {
        $(select_element).select2({
            dropdownParent: $(dropdown_parent),
        });
    }
}

//this function applies select2 effect on select element in a request for authorization modal with provided param
function applySelect2OnRequestForCodeModal(select_element) {
    var parentElement = $(select_element).parent();
    var id = $(this).attr("rel");
    if ($(select_element).length && $(parentElement).length) {
        $(select_element).select2({
            dropdownParent: $(parentElement),
        });
    }
}

//duplicate elements for multiple input by user
function duplicateItem(add_item_button, duplicate_item, display_area, select_element = []) {
    var form_fields = $(duplicate_item).html();

    $(document).on("click", add_item_button, function(e) {
        e.preventDefault();
        $(display_area).append(
            "<div class='duplicate mt-1''> " +
            form_fields +
            "<button class='btn btn-sm btn-danger col-md-2 removeItem' style='margin-top:-5%'>Remove Item</button></div>"
        );

        if (select_element.length > 0) {
            $.each(select_element, function(index, value) {
                $(value + ":last").select2();
            });
        }
        //$(".cmbDiagnosis:last").select2();
    });

    $(document).on("click", ".removeItem", function(e) {
        e.preventDefault();
        $(this).parent().remove();
    });
}

//handles network/browser error
function formatErrorMessage(jqXHR, exception) {
    if (jqXHR.status === 0) {
        return "Not connected.\nPlease verify your network connection.";
    } else if (jqXHR.status == 404) {
        return "The requested page not found. [404]";
    } else if (jqXHR.status === 419) {
        // CSRF token mismatch error
        return "CSRF token mismatch. Please refresh the page and try again.";
    } else if (jqXHR.status == 500) {
        return "Internal Server Error [500].";
    } else if (exception === "parsererror") {
        return "Requested JSON parse failed.";
    } else if (exception === "timeout") {
        return "Time out error.";
    } else if (exception === "abort") {
        return "Ajax request aborted.";
    } else {
        // return "Uncaught Error.\n" + formatErrorResponseText(jqXHR.responseText);
        return formatErrorResponseText(jqXHR.responseText);
    }
}

function showSnackBar(message, type) {
    if (type == "success") {
        Snackbar.show({
            text: message,
            pos: "top-right",
            actionTextColor: "#fff",
            backgroundColor: "#1abc9c",
        });
    } else if (type == "error") {
        Snackbar.show({
            text: message,
            pos: "top-right",
            actionTextColor: "#fff",
            backgroundColor: "#e7515a",
        });
    } else if (type == "warning") {
        Snackbar.show({
            text: message,
            pos: "top-right",
            actionTextColor: "#fff",
            backgroundColor: "#ffbf00",
            duration: "15000",
        });
    } else {
        Snackbar.show({
            text: message,
            pos: "top-right",
            actionTextColor: "#fff",
        });
    }

    // this is for snackbar
    // Snackbar.show({
    //   text: "{{ session('message') }}",
    //   pos: 'top-right',
    //   actionTextColor: '#fff',
    //   backgroundColor: "{{ session('status') == 'success' ? '#1abc9c' : '#e7515a' }}",
    //   showAction: false,
    // });

    // this is for toast swal
    // const toast = swal.mixin({
    //   toast: true,
    //   position: 'top-end',
    //   showConfirmButton: false,
    //   timer: 3000,
    //   padding: '2em'
    // });

    // toast({
    //   type: "{{ session('status') }}",
    //   title: "{{ session('message') }}",
    //   padding: '2em',
    // })
}

function formatErrorResponseText(errorResponse) {
    errorResponse = JSON.parse(errorResponse);
    var errors = errorResponse.errors;
    var errorMessage = "";

    $.each(errors, function(fieldName, errorMessageArr) {
        var errMsg = errorMessageArr[0];
        optionalRequired = ['serviceNumber', 'serviceStatus', 'armsOfService', 'rank', 'staffNumber', 'designation', 'department', 'employer'];
        if ($.inArray(fieldName, optionalRequired) !== -1) {
            var parts = errMsg.split('when');
            errMsg = parts[0].trim() + ".";
        }
        errorMessage += "<p style='color: #fff'>" + errMsg + "</p>";
    });
    return errorMessage;
}

function handleErrors(response) {
    // Check if there are validation errors
    if (response.developer_info && response.developer_info.errors) {
        let errorMessages = "";
        const errors = response.developer_info.errors;

        // Loop through the errors and append them to the errorMessages variable
        for (let field in errors) {
            if (errors.hasOwnProperty(field)) {
                errorMessages += errors[field].join(", ") + "<br>"; // Join multiple errors for the same field
            }
        }

        // Call your snackbar function with the combined error messages
        showSnackBar(errorMessages, "error");
    } else if (response.message) {
        showSnackBar(response.message, "error");
    } else {
        // In case there are no specific errors, display the general message
        showSnackBar(response, "error");
    }
}



/**
 *  Ajax Call functions 
 **/


/**
 *  Form Action functions
 **/

//login
function login() {
    if ($("#btnLogin")) {
        $(document).on("click submit", "#btnLogin", function(e) {
            e.preventDefault();

            var formAction = $("#frmLogin").attr("action");
            var formMethod = $("#frmLogin").attr("method");
            var formData = $("#frmLogin").serialize();

            $("#btnLogin").hide();
            $("#loginLoader").show();

            $.ajax({
                url: formAction,
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: formMethod,
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    //console.log(response);
                    if (response.status.trim() == "success") {
                        window.location.href = response.data.redirect;
                        showSnackBar(response.message, "success");

                        $("#frmLogin")[0].reset();
                        $("#btnLogin").show();
                        $("#loginLoader").hide();
                    } else {
                        $("#btnLogin").show();
                        $("#loginLoader").hide();

                        showSnackBar(response.message, "error");
                    }
                },
                error: function(x, e) {
                    $("#btnLogin").show();
                    $("#loginLoader").hide();

                    showSnackBar(formatErrorMessage(x, e), "error");
                },
            });
        });
    }
}

//add new HCP
//register encounter
function addHcp() {
    if ($("#btnAddHcp")) {
        $(document).on("click submit", "#btnAddHcp", function(e) {
            e.preventDefault();

            var formAction = $("#frmAddHcp").attr("action");
            var formMethod = $("#frmAddHcp").attr("method");
            var formData = $("#frmAddHcp").serialize();

            $("#btnAddHcp").hide();
            $("#frmAddHcpLoader").show();

            $.ajax({
                url: formAction,
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: formMethod,
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    //console.log(response);
                    if (response.status.trim() == "success") {
                        showSnackBar(response.message, "success");

                        $("#frmAddHcp")[0].reset();
                        $("#btnAddHcp").show();
                        $("#frmAddHcpLoader").hide();

                        location.reload();
                    } else {
                        $("#btnAddHcp").show();
                        $("#frmAddHcpLoader").hide();

                        showSnackBar(response.message, "error");
                    }
                },
                error: function(x, e) {
                    $("#btnAddHcp").show();
                    $("#frmAddHcpLoader").hide();

                    showSnackBar(formatErrorMessage(x, e), "error");
                },
            });
        });
    }
}

function updateHcp() {
    if ($("#btnUpdateHcp")) {
        $(document).on("click submit", "#btnUpdateHcp", function(e) {
            e.preventDefault();

            var formAction = $("#frmUpdateHcp").attr("action");
            var formMethod = $("#frmUpdateHcp").attr("method");
            var formData = $("#frmUpdateHcp").serialize();

            $("#btnUpdateHcp").hide();
            $("#frmUpdateHcpLoader").show();

            $.ajax({
                url: formAction,
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: formMethod,
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    console.log(response.dev);
                    if (response.status.trim() == "success") {
                        showSnackBar(response.message, "success");

                        $("#frmUpdateHcp")[0].reset();
                        $("#btnUpdateHcp").show();
                        $("#frmUpdateHcpLoader").hide();

                        location.reload();
                    } else {
                        $("#btnUpdateHcp").show();
                        $("#frmUpdateHcpLoader").hide();

                        showSnackBar(response.message, "error");
                    }
                },
                error: function(x, e) {
                    $("#btnUpdateHcp").show();
                    $("#frmUpdateHcpLoader").hide();

                    showSnackBar(formatErrorMessage(x, e), "error");
                },
            });
        });
    }
}


//register encounter
function registerEncounter() {
    if ($("#btnRegisterEncounter")) {
        $(document).on("click submit", "#btnRegisterEncounter", function(e) {
            e.preventDefault();

            swal({
                title: "Do you want to proceed with saving this encounter?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    var formAction = $("#frmRegisterEncounter").attr("action");
                    var formMethod = $("#frmRegisterEncounter").attr("method");
                    var formData = $("#frmRegisterEncounter").serialize();

                    $("#btnRegisterEncounter").hide();
                    $("#frmRegisterEncounterLoader").show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                $("#frmRegisterEncounter")[0].reset();
                                $("#btnRegisterEncounter").show();
                                $("#frmRegisterEncounterLoader").hide();

                                location.reload();
                            } else {
                                $("#btnRegisterEncounter").show();
                                $("#frmRegisterEncounterLoader").hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            $("#btnRegisterEncounter").show();
                            $("#frmRegisterEncounterLoader").hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });

        });
    }
}

//display request for authorization code modal
function showRequestForAuthorizationCodeModal() {
    if ($(".btnShowRequestForAuthorizationCodeModal")) {
        $(document).on("click", ".btnShowRequestForAuthorizationCodeModal", function(e) {
            e.preventDefault();

            var show_modal = $(this).attr("data-target");

            var select_element = $(show_modal).find("[name='cmbReceivingHcp']");
            var parentElement = $(select_element).parent();
            // $(select_element).select2({
            //     dropdownParent: $(parentElement),
            // });

            $(show_modal).modal("show");

        });
    }
}

//request for authorization code
function requestForAuthorizationCode() {
    if ($("#btnRequestForAuthCode")) {
        $(document).on("click submit", "#btnRequestForAuthCode", function(e) {
            e.preventDefault();



            //TO-DO
            //check if receiving hcp is same as referring hcp. If yes, allow request without encounter record
            // if(selectedHcp == hcp_account_id){

            // }else{
            //     //referral is to another hcp. encounter record must be provided
            //     // Check if at least one encounter record is selected
            //     if ($(".encounter_code:checked").length > 0) {

            //     } else {
            //         showSnackBar(
            //             "You must provide an encounter record to successfully request for code",
            //             "error"
            //         );
            //         return false;
            //     }
            // }

            swal({
                title: "Do you want to proceed with saving this encounter?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    var selectedHcp = $("#cmbReceivingHcp").val();
                    var selectedInvestigation = $("#cmbInvestigation").val();
                    var selectedDrug = $("#cmbDrugList").val();
                    var hcp_account_id = $("#hcp_account_id").val();

                    var formAction = $("#frmRequestForAuthCode").attr("action");
                    var formMethod = $("#frmRequestForAuthCode").attr("method");
                    var formData = $("#frmRequestForAuthCode").serialize();

                    $("#btnRequestForAuthCode").hide();
                    $("#frmRequestForAuthCodeLoader").show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                $("#frmRequestForAuthCode")[0].reset();
                                $("#btnRequestForAuthCode").show();
                                $("#frmRequestForAuthCodeLoader").hide();

                                location.reload();
                            } else {
                                $("#btnRequestForAuthCode").show();
                                $("#frmRequestForAuthCodeLoader").hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            $("#btnRequestForAuthCode").show();
                            $("#frmRequestForAuthCodeLoader").hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });


        });
    }
}

//on change of complain category, it picks which fields to display
function complainCategoryOnChange() {
    if ($("#cmbCCategory")) {
        $(document).on("change", "#cmbCCategory", function(e) {
            e.preventDefault();
            var selected = $(this).val();
            if (selected == "1") {
                $(".optional").hide();
                $("#dispHcp").show();
            } else if (selected == "3") {
                $(".optional").hide();
                $("#dispEnrollee").show();
            } else if (selected == "2") {
                $(".optional").hide();
                $("#dispState").show();
            } else if (selected == "4") {
                $(".optional").hide();
                $("#dispDrp").show();
            } else {
                $(".optional").hide();
            }
        });
    }
}

//save complain query
function saveComplainQuery() {
    if ($("#btnSaveComplainQuery")) {
        $(document).on("click submit", "#btnSaveComplainQuery", function(e) {
            e.preventDefault();

            swal({
                title: "Are you sure you want to save this complain query?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    var formAction = $("#frmComplainQuery").attr("action");
                    var formMethod = $("#frmComplainQuery").attr("method");
                    var formData = $("#frmComplainQuery").serialize();

                    $("#btnSaveComplainQuery").hide();
                    $("#frmComplainQueryLoader").show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                $("#frmComplainQuery")[0].reset();
                                $("#btnSaveComplainQuery").show();
                                $("#frmComplainQueryLoader").hide();

                                location.reload();
                            } else {
                                $("#btnSaveComplainQuery").show();
                                $("#frmComplainQueryLoader").hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            $("#btnSaveComplainQuery").show();
                            $("#frmComplainQueryLoader").hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });

        });
    }
}

//save claim query
function saveClaimQuery() {
    if ($(".btnSaveClaim")) {
        $(document).on("click submit", ".btnSaveClaim", function(e) {
            e.preventDefault();

            swal({
                title: "Are you sure you want to save this claim?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $("#frmstatus").val();

                    var formAction = $("#frmSubmitClaim").attr("action");
                    var formMethod = $("#frmSubmitClaim").attr("method");
                    var form = $("#frmSubmitClaim")[0];
                    var formData = new FormData(form);

                    var claimDocuments = $("input[name='claimDocument']")[0]
                        .files; // Get the file inputs
                    // Append each file to the FormData object
                    for (var i = 0; i < claimDocuments.length; i++) {
                        formData.append("claimDocument[]", claimDocuments[i]);
                    }

                    $(".btnSaveClaim").hide();
                    $("#frmSubmitClaimLoader").show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        contentType: false,
                        processData: false,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                $("#frmSubmitClaim")[0].reset();
                                $(".btnSaveClaim").show();
                                $("#frmSubmitClaimLoader").hide();
                                $("#authCodeRecordContainer").html("");

                                location.reload();
                            } else {
                                $(".btnSaveClaim").show();
                                $("#frmSubmitClaimLoader").hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            $(".btnSaveClaim").show();
                            $("#frmSubmitClaimLoader").hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });

        });
    }
}

//mark complain query as closed
function markComplainQueryAsClosed(url = "") {
    if ($("#btnMarkComplainAsClosed")) {
        $(document).on(
            "click submit",
            "#btnMarkComplainAsClosed",
            function(e) {
                e.preventDefault();

                var formMethod = $("#frmComplainQuery").attr("method");
                var formData = $("#frmComplainQuery").serialize();

                $("#btnMarkComplainAsClosed").hide();
                $("#frmComplainQueryLoader").show();

                $.ajax({
                    url: url,
                    headers: {
                        "X-CSRF-Token": $('input[name="_token"]').val(),
                    },
                    type: formMethod,
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        //console.log(response);
                        if (response.status.trim() == "success") {
                            showSnackBar(response.message, "success");

                            $("#frmComplainQuery")[0].reset();
                            $("#btnMarkComplainAsClosed").show();
                            $("#frmComplainQueryLoader").hide();

                            location.reload();
                        } else {
                            $("#btnMarkComplainAsClosed").show();
                            $("#frmComplainQueryLoader").hide();

                            showSnackBar(response.message, "error");
                        }
                    },
                    error: function(x, e) {
                        $("#btnMarkComplainAsClosed").show();
                        $("#frmComplainQueryLoader").hide();

                        showSnackBar(formatErrorMessage(x, e), "error");
                    },
                });
            }
        );
    }
}

function htmlDecode(input) {
    var doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}

//approve auth code request
function updateAuthorizationCodeRequestStatus(url) {
    if ($(".btnConfirmCode") || $(".btnDeclineCode") || $(".btnFlagCode")) {
        $(document).on("click", ".btnConfirmCode, .btnDeclineCode, .btnFlagCode", function(e) {
            e.preventDefault();

            var $button = $(this);
            var reference = $button.attr("rel");
            var id = $button.attr("dt");
            var status = $button.attr("st");
            var remark = "";
            var code_specialization = "";
            var $modalContainer = $button.closest('.modal'); // Find the parent modal
            var $declineReasonInput = $("#declineCodeModal" + id + " #decline_reason" + id);
            var $flagReasonInput = $("#flagCodeModal" + id + " #flag_reason" + id);
            var codeSpecializationInput = $("#approveCodeModal" + id + " #code_specialization" + id);

            if (status == "declined") {
                if ($declineReasonInput.val().trim() == "") {
                    showSnackBar("Please provide a reason for action", "error");
                    return false;
                }
                remark = $declineReasonInput.val();
            }

            if (status == "approved") {
                if (codeSpecializationInput.val().trim() == "" || codeSpecializationInput.val().trim() == "-1") {
                    showSnackBar("Please select a code specialization", "error");
                    return false;
                }
                code_specialization = codeSpecializationInput.val();
            }

            if (status == "flagged") {
                if ($flagReasonInput.val().trim() == "") {
                    showSnackBar("Please provide a reason for action", "error");
                    return false;
                }
                remark = $flagReasonInput.val();
            }

            $button.hide();
            $("#loader" + id).show();

            swal({
                title: 'Are you sure you want to proceed with this request?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: 'Yes, Proceed',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: "POST",
                        data: "&ref=" + reference + "&status=" + status + "&remark=" + remark + "&specialization=" + code_specialization,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                $button.show();
                                $("#loader" + id).hide();

                                location.reload();
                            } else {
                                $button.show();
                                $("#loader" + id).hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            $button.show();
                            $("#loader" + id).hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });


        });
    }
}

function saveHcpPayment() {
    if ($(".btnAddHcpPayment")) {
        $(document).on("click submit", ".btnAddHcpPayment", function(e) {
            e.preventDefault();

            var btn = $(this);
            var id = btn.attr("dt");
            var frm = $("#frmAddHcpPayment" + id);
            var loader = $("#frmAddHcpPaymentLoader" + id);

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });
        });
    }
}

function careCordDashboard(values) {
    var data = JSON.parse(htmlDecode(values));
    var data2 = [{
            name: "Approved",
            data: [91, 76, 85, 101, 98, 87, 58, 91, 114, 94, 66, 70],
        },
        {
            name: "Declined",
            data: [58, 44, 55, 57, 56, 61, 58, 63, 60, 66, 56, 63],
        },
    ];
    var d_1options1 = {
        chart: {
            width: "80%",
            height: 350,
            type: "bar",
            toolbar: {
                show: false,
            },
        },
        colors: ["#5c1ac3", "#d6b007"],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            horizontalAlign: "center",
            fontSize: "14px",
            markers: {
                width: 10,
                height: 10,
            },
            itemMargin: {
                horizontal: 0,
                vertical: 8,
            },
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        series: data,
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "light",
                type: "vertical",
                shadeIntensity: 0.3,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 0.8,
                stops: [0, 100],
            },
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val;
                },
            },
        },
    };

    var d_1C_3 = new ApexCharts(
        document.querySelector("#auth_code_request_stat"),
        d_1options1
    );
    d_1C_3.render();
}

function getFullDate() {
    var months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    var today = new Date();
    var day = today.getDate();
    var month = months[today.getMonth()];
    var year = today.getFullYear();

    return month + " " + day + ", " + year;
}

function getCurrentYear() {
    var today = new Date();
    var year = today.getFullYear();

    return year;
}

function getCurrentMonth() {
    var months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    var today = new Date();
    var month = months[today.getMonth()];

    return month;
}

function handlePaymentSummaryReportCategory() {

    if ($("#reportcategory")) {
        $("#display_others").hide();
        $(document).on("change", "#reportcategory", function(e) {
            e.preventDefault();
            var selected = $(this).val();

            if (selected == "-1") {
                display_area.hide();
                $("#display_others").hide();
                return false;
            }

            if (selected.toLowerCase() == "annual") {
                $("#display_others").hide();
            } else {
                $("#display_others").show();
            }
        });
    }

}

//submit post transaction request
function postTransactionRequest() {
    if ($("#btnPostTransaction")) {
        $(document).on("click submit", "#btnPostTransaction", function(e) {
            e.preventDefault();

            var frm = $("#frmPostTransaction");
            var btn = $("#btnPostTransaction");
            var loader = $("#frmPostTransactionLoader");

            var formAction = frm.attr("action");
            var formMethod = "POST";
            var formData = frm.serialize();

            btn.hide();
            loader.show();

            var $msg = "";
            // if (status == "submit") {
            //     $msg = "You won't be able to revert this!";
            // }

            swal({
                title: "Do you want to proceed with saving this transaction?",
                text: $msg,
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {

                if (result.value) {

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");
                                frm[0].reset();
                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();
                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });

                }

            });

        });
    }
}

//load customer savings plan into combo
function loadCustomerSavingsPlan(cmb_id) {
    if ($(cmb_id)) {
        $(document).on("change", cmb_id, function(e) {
            e.preventDefault();

            var customer_id = $(this).val();

            blockUiDisplay("Loading Customer Savings Plan. Please wait...");

            $.ajax({
                url: "/customer/savings-plan/get/" + customer_id + "",
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val(),
                },
                type: "GET",
                data: "",
                dataType: "JSON",
                success: function(response) {
                    unBlockUiDisplay();
                    if (response.status == "success") {
                        // Update the component's HTML in the container element
                        $("#savings_plan").html(response.message);
                    } else {
                        $("#savings_plan").html("");
                        showSnackBar(response.message, "error");
                    }
                },
                error: function(x, e) {
                    unBlockUiDisplay();
                    showSnackBar(formatErrorMessage(x, e), "error");
                },
            });
        });
    }
}

//approve transaction
function performActionOnTransaction() {
    if ($(".btnApproveTransaction") || $(".btnFlagTransaction") || $(".btnRejectTransaction")) {
        $(document).on("click submit", ".btnApproveTransaction, .btnFlagTransaction, .btnRejectTransaction", function(e) {
            e.preventDefault();

            var curBtn = $(this);

            swal({
                title: "Are you sure you want to proceed with this transaction?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    var rel = curBtn.attr("rel");
                    var btn = curBtn.attr('id');
                    var loader = $("#btnApproveTransactionLoader" + rel);
                    var formAction = curBtn.attr("rte");
                    var formMethod = "POST";

                    curBtn.hide();
                    loader.show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: "&_id=" + rel,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");
                                location.reload();
                            } else {
                                curBtn.show();
                                loader.hide();
                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            curBtn.show();
                            loader.hide();
                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });
        });
    }
}

//approve selected transaction
function bulkActionOnSelectedTransaction() {
    if ($(".btnApproveAllTransaction") || $(".btnFlagAllTransaction") || $(".btnRejectAllTransaction")) {
        $(document).on("click", ".btnApproveAllTransaction, .btnFlagAllTransaction, .btnRejectAllTransaction", function(e) {
            e.preventDefault();

            // Get the selected checkboxes
            var selectedCheckboxes = $(".checkAllTransaction:checked");

            var formAction = $(this).attr("rte");
            var formStatus = $(this).attr("sta");

            // Check if any checkboxes are selected
            if (selectedCheckboxes.length > 0) {
                swal({
                    title: "Are you sure you want to proceed on the selected transactions?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Proceed",
                    padding: "2em",
                }).then(function(result) {
                    if (result.value) {
                        // Prepare data to send
                        var formData = {
                            _token: $('input[name="_token"]').val(),
                            status: formStatus,
                            selectedTransactions: selectedCheckboxes
                                .map(function() {
                                    return $(this).val();
                                })
                                .get(),
                        };

                        // Make AJAX request
                        $.ajax({
                            url: formAction,
                            type: "POST",
                            data: formData,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status.trim() == "success") {
                                    showSnackBar(response.message, "success");
                                    $(".checkAllTransaction").prop("checked", false);
                                    location.reload();
                                } else {
                                    showSnackBar(response.message, "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                showSnackBar(
                                    formatErrorMessage(xhr, status, error),
                                    "error"
                                );
                            },
                        });
                    }
                });
            } else {
                // If no checkboxes are selected, show an error message
                showSnackBar("Please select at least one transaction.", "error");
            }
        });
    }
}

function selectAllTransaction() {
    $("#checkAllTransaction").click(function() {
        $(".checkAllTransaction").prop("checked", $(this).prop("checked"));
        computeTotalAmount();
    });

    $(".checkAllTransaction").click(function() {
        computeTotalAmount();
    });
}

function computeTotalAmount() {
    var totalAmount = 0;
    if ($(".checkAllTransaction:checked").length === 0) {
        $(".checkAllTransaction").each(function() {
            var row = $(this).closest("tr");
            var amount = parseFloat(row.find(".amt").val().trim());
            totalAmount += amount;
        });
    } else {
        $(".checkAllTransaction:checked").each(function() {
            var row = $(this).closest("tr");
            var amount = parseFloat(row.find(".amt").val().trim());
            totalAmount += amount;
        });
    }
    $("#displayTransactionTotal").text(
        totalAmount.toLocaleString("en-US", { maximumFractionDigits: 2 })
    );
}

function transactionFilterOnChange() {
    var report_category = $("#filter_type");

    // Attach the change event handler
    $(document).on("change", "#filter_type", function(e) {
        e.preventDefault();
        var report_type = report_category.val().toLowerCase();

        if (report_type == "-1") {
            $(".cmbOptions").hide();
            return false;
        }

        if (report_type == "account-officer") {
            $(".cmbOptions").hide();
            $("#cmbFilterAccountOfficer").show();
        } else if (report_type == "transaction-date") {
            $(".cmbOptions").hide();
            $(".date_range").show();
        } else {
            $(".cmbOptions").hide();
        }
    });

    // Trigger the change event on page load if there's a selected option
    if (report_category.length > 0) {
        report_category.trigger("change");
    }
}

//submit post transaction request
function addNewCustomer() {
    if ($(".btnProceedToNext")) {
        var nextButton = $('a[href="#next"][role="menuitem"]');
        if (nextButton.length > 0) {
            //console.log("Next button found:", nextButton);
            $(nextButton).hide();
        }

        $(document).on("click submit", ".btnProceedToNext", function(e) {
            e.preventDefault();

            var rel = $(this).attr('rel');
            var id = $(this).attr("id");
            //var frm = $("#"+rel);
            var frm = $("form[name='" + rel + "']");
            var btn = $("#" + id);
            var loader = $("#frmAddCustomerLoader");

            var formAction = frm.attr("action");
            var formMethod = "POST";
            var formData = frm.serialize();

            btn.hide();
            loader.show();

            //nextButton.click();
            //return;

            var $msg = "";
            // if (status == "submit") {
            //     $msg = "You won't be able to revert this!";
            // }

            swal({
                title: "Do you want to proceed?",
                text: $msg,
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");
                                if (response.data) {
                                    $(".customer_account_id").val(response.data.__id);
                                }
                                nextButton.click();
                                btn.show();
                            } else {
                                btn.show();
                                loader.hide();
                                handleErrors(response);
                                //showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();
                            handleErrors(formatErrorMessage(x, e));
                            //showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });
        });
    }
}

//approve customer account
function performActionOnOpenCustomerAccount() {
    if ($(".btnApproveCustomer") || $(".btnFlagCustomer") || $(".btnRejectCustomer")) {
        $(document).on("click submit", ".btnApproveTransaction, .btnFlagTransaction, .btnRejectTransaction", function(e) {
            e.preventDefault();

            var curBtn = $(this);

            swal({
                title: "Are you sure you want to proceed with this transaction?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    var rel = curBtn.attr("rel");
                    var btn = curBtn.attr('id');
                    var loader = $("#btnApproveTransactionLoader" + rel);
                    var formAction = curBtn.attr("rte");
                    var formMethod = "POST";

                    curBtn.hide();
                    loader.show();

                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: "&_id=" + rel,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");
                                location.reload();
                            } else {
                                curBtn.show();
                                loader.hide();
                                showSnackBar(response.message, "error");
                            }
                        },
                        error: function(x, e) {
                            curBtn.show();
                            loader.hide();
                            showSnackBar(formatErrorMessage(x, e), "error");
                        },
                    });
                }
            });
        });
    }
}

//approve selected OpenCustomerAccount
function bulkActionOnSelectedOpenCustomerAccount() {
    if ($(".btnApproveAllCustomer") || $(".btnFlagAllCustomer") || $(".btnRejectAllCustomer")) {
        $(document).on("click", ".btnApproveAllCustomer, .btnFlagAllCustomer, .btnRejectAllCustomer", function(e) {
            e.preventDefault();

            // Get the selected checkboxes
            var selectedCheckboxes = $(".checkAllCustomer:checked");

            var formAction = $(this).attr("rte");
            var formStatus = $(this).attr("sta");

            // Check if any checkboxes are selected
            if (selectedCheckboxes.length > 0) {
                swal({
                    title: "Are you sure you want to proceed on the selected customers?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Proceed",
                    padding: "2em",
                }).then(function(result) {
                    if (result.value) {
                        // Prepare data to send
                        var formData = {
                            _token: $('input[name="_token"]').val(),
                            status: formStatus,
                            selectedTransactions: selectedCheckboxes
                                .map(function() {
                                    return $(this).val();
                                })
                                .get(),
                        };

                        // Make AJAX request
                        $.ajax({
                            url: formAction,
                            type: "POST",
                            data: formData,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status.trim() == "success") {
                                    showSnackBar(response.message, "success");
                                    $(".checkAllCustomer").prop("checked", false);
                                    location.reload();
                                } else {
                                    showSnackBar(response.message, "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                showSnackBar(
                                    formatErrorMessage(xhr, status, error),
                                    "error"
                                );
                            },
                        });
                    }
                });
            } else {
                // If no checkboxes are selected, show an error message
                showSnackBar("Please select at least one customer.", "error");
            }
        });
    }
}

function selectAllCustomer() {
    $("#checkAllCustomers").click(function() {
        $(".checkAllCustomer").prop("checked", $(this).prop("checked"));

    });

    $(".checkAllCustomer").click(function() {

    });
}



/**
 * 
 */
function showModal(buttonId, modalID) {
    $(document).on("click", buttonId, function(e) {
        e.preventDefault();

        $(modalID).modal('show');
    });
}

function saveItem() {
    if ($("#btnSaveItem")) {
        $(document).on("click submit", "#btnSaveItem", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveItem");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveCategory() {
    if ($("#btnSaveCategory")) {
        $(document).on("click submit", "#btnSaveCategory", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveCategory");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveSubCategory() {
    if ($("#btnSaveSubCategory")) {
        $(document).on("click submit", "#btnSaveSubCategory", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveSubCategory");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveUnit() {
    if ($("#btnSaveUnit")) {
        $(document).on("click submit", "#btnSaveUnit", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveUnit");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveWarehouse() {
    if ($("#btnSaveWarehouse")) {
        $(document).on("click submit", "#btnSaveWarehouse", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveWarehouse");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveWarehouseType() {
    if ($("#btnSaveWarehouseType")) {
        $(document).on("click submit", "#btnSaveWarehouseType", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveWarehouseType");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveSupplier() {
    if ($("#btnSaveSupplier")) {
        $(document).on("click submit", "#btnSaveSupplier", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveSupplier");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function savePurchaseOrder() {
    if ($("#btnSavePurchaseOrder")) {
        $(document).on("click submit", "#btnSavePurchaseOrder", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSavePurchaseOrder");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function savePurchaseOrderItem() {
    if ($("#btnSavePurchaseOrderItem")) {
        $(document).on("click submit", "#btnSavePurchaseOrderItem", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSavePurchaseOrderItem");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function getSubCategoryByCategory(){

    $(document).on('change', '.categoryIDMain', function (e) {
        e.preventDefault();
        let categoryID = $(this).val();
        let $subCategory = $('#subCategoryID');

        $subCategory.html('<option value="">Loading...</option>');

        if (categoryID) {
            $.ajax({
                url: '/get-sub-categories/' + categoryID,
                type: 'GET',
                success: function (data) {
                    let options = '<option value="">-- Select Sub Category --</option>';
                    data.forEach(function (subCat) {
                        options += `<option value="${subCat.sn}">${subCat.name}</option>`;
                    });
                    $subCategory.html(options);
                    applySelect2([".subCategoryID"]);
                },
                error: function () {
                    $subCategory.html('<option value="-1">Error loading sub-categories</option>');
                }
            });
        } else {
            $subCategory.html('<option value="-1">-- No Data Available --</option>');
        }
    });

    $('.categoryIDMain').trigger('change');
}

function saveCustomer() {
    if ($("#btnSaveCustomer")) {
        $(document).on("click submit", "#btnSaveCustomer", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveCustomer");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}

function saveItemBatch() {
    if ($("#btnSaveItemBatch")) {
        $(document).on("click submit", "#btnSaveItemBatch", function(e) {
            e.preventDefault();

            var btn = $(this);
            var frm = $("#frmSaveItemBatch");
            var loader = $("#frmAddHcpPaymentLoader");

            var formAction = frm.attr("action");
            var formMethod = frm.attr("method");
            var formData = frm.serialize();

            //btn.hide();
            loader.show();

            swal({
                title: "Do you want to proceed with this request?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, Proceed",
                padding: "2em",
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: formAction,
                        headers: {
                            "X-CSRF-Token": $('input[name="_token"]').val(),
                        },
                        type: formMethod,
                        data: formData,
                        dataType: "JSON",
                        success: function(response) {
                            //console.log(response);
                            if (response.status.trim() == "success") {
                                showSnackBar(response.message, "success");

                                frm[0].reset();
                                btn.show();
                                loader.hide();

                                location.reload();
                            } else {
                                btn.show();
                                loader.hide();

                                handleErrors(response);
                            }
                        },
                        error: function(x, e) {
                            btn.show();
                            loader.hide();

                            handleErrors(formatErrorMessage(x, e));
                        },
                    });
                }
            });
        });
    }
}
