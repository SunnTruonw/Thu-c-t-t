
const PRODUCT_ID = $("#productId").val();
const page = $("#page").val() ?? 1;
const MODAL_CLASS = "modal--is-visible";
const DISABLE_SCROLL = "disable-scroll";
const TOKEN = { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") };
var previousScrollY = 0;
var removeChar = function (strInput) {
    return strInput.replace(/(<([^>]+)>)/gi, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
};


function disableScroll() {
    previousScrollY = window.scrollY;
    $("html").css({ marginTop: -previousScrollY }).addClass("disable-scroll-safari");
}


function openModalReplyComment() {
    $(document).on("click", ".open-modal-reply-comment", function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        $("#replyNameComment").text(name);
        $("#replyIdComment").val(id);
    });
}


function openModalCreateComment() {
    $(document).on("click", ".show-modal-create-comment", function () {
        var content = removeChar($("#contentComment").val());
        if (content == "" || content.replace(/\s/g, "").length < 3) {
            $("#errorContentComment").show();
            $("#contentComment").addClass("is-invalid");
            return false;

        } else {
            $("#errorContentComment").hide();
            $("#contentComment").removeClass("is-invalid");
            $("#modal-comment").modal('show');

        }
    });
}

function clearInputComment() {
    $("#replyIdComment").val("");
    $("input[name='danhXungReplyComment']:checked").prop("checked", false);
    $(".danh-xung-reply-comment").removeClass("checked");
    $("input[name='nameReplyComment']").val("");
    $("input[name='phoneReplyComment']").val("");
    $("input[name='emailReplyComment']").val("");
    $("textarea[name='contentReplyComment']").val("");
    $("textarea[name='contentCreateCommentMb']").val("");
    $("input[name='danhXungComment']:checked").prop("checked", false);
    $(".danh-xung-comment").removeClass("checked");
    $("input[name='nameComment']").val("");
    $("input[name='phoneComment']").val("");
    $("input[name='emailComment']").val("");
    $("textarea[name='contentComment']").val("");
}

function clearInputReview() {
    $("input[name='danhXungReview']:checked").prop("checked", false);
    $(".danh-xung-review").removeClass("checked");
    $("input[name='nameReview']").val("");
    $("input[name='phoneReview']").val("");
    $("input[name='emailReview']").val("");
    $("textarea[name='contentReview']").val("");
    $(".lc__rating-star").find("li.m-r-8").removeClass("selected");

    $("#messrating").html("");
    $("input[name='danhXungReplyReview']:checked").prop("checked", false);
    $(".danh-xung-reply-review").removeClass("checked");
    $("input[name='nameReplyReview']").val("");
    $("input[name='phoneReplyReview']").val("");
    $("input[name='emailReplyReview']").val("");
    $("textarea[name='contentReplyReview']").val("");
    $("#replyName").val("");
    $("#replyId").val("");
}

/**
 * Bình luận
 * @param {*} danhXung 
 * @param {*} name 
 * @param {*} phone 
 * @param {*} email 
 * @returns 
 */
function validateCreateComment(danhXung, name, phone, email) {
    if (typeof danhXung == "undefined") {
        $("#errorDanhXungComment").show();
        $(".check-form-create-comment").addClass("is-invalid");
        var errorDanhXungComment = false;
    } else {
        $("#errorDanhXungComment").hide();
        $(".check-form-create-comment").removeClass("is-invalid");
    }
    if (name == "" || name.replace(/\s/g, "").length < 1 || removeChar(name) == "") {
        $("#errorNameComment").show();
        $("#nameComment").parent().addClass("is-invalid");
        var errorNameComment = false;
    } else {
        $("#errorNameComment").hide();
    }
    if (phone == "" || phone.replace(/\s/g, "").length < 1) {
        $("#errorPhoneComment").show();
        $("#phoneComment").parent().addClass("is-invalid");
        var errorPhoneComment = false;
    } else {
        if (phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false) {
            $(".text-phone-error-comment").text("Số diện thoại không hợp lệ");
            $("#errorPhoneComment").show();
            $("#phoneComment").parent().addClass("is-invalid");
            var errorPhoneComment = false;
        } else {
            $("#errorPhoneComment").hide();
        }
    }
    if (email != "" || email.length > 0 || email.replace(/\s/g, "").length > 0 || removeChar(email) != "") {
        if (isEmail(email) == false) {
            $("#errorEmailComment").show();
            return false;
        } else {
            $("#errorEmailComment").hide();
        }
    } else {
        $("#errorEmailComment").hide();
    }
        
    if (errorDanhXungComment == false || errorNameComment == false || errorPhoneComment == false) {
        return false;
    }
}

function validateReplyComment(danhXung, name, phone, email, content) {
    if (typeof danhXung == "undefined") {
        $("#errorDanhXungReplyComment").show();
        $(".check-form-reply-comment").addClass("is-invalid");
        var errorDanhXungReplyComment = false;
    } else {
        $("#errorDanhXungReplyComment").hide();
        $(".check-form-create-comment").removeClass("is-invalid");
    }
    if (name == "" || name.replace(/\s/g, "").length < 1 || removeChar(name) == "") {
        $("#errorNameReplyComment").show();
        $("#nameReplyComment").parent().addClass("is-invalid");
        var errorNameReplyComment = false;
    } else {
        $("#errorNameReplyComment").hide();
    }
    if (phone == "" || phone.replace(/\s/g, "").length < 1) {
        $("#errorPhoneReplyComment").show();
        $("#phoneReplyComment").parent().addClass("is-invalid");
        var errorPhoneReplyComment = false;
    } else {
        if (phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false) {
            $(".phone-error-reply-comment-text").text("Số diện thoại không hợp lệ");
            $("#errorPhoneReplyComment").show();
            $("#phoneReplyComment").parent().addClass("is-invalid");
            var errorPhoneReplyComment = false;
        } else {
            $("#errorPhoneReplyComment").hide();
        }
    }
    if (email != "" || email.length > 0 || email.replace(/\s/g, "").length > 0 || removeChar(email) != "") {
        if (isEmail(email) == false) {
            $("#errorEmailReplyComment").show();
            return false;
        } else {
            $("#errorEmailReplyComment").hide();
        }
    } else {
        $("#errorEmailReplyComment").hide();
    }
    if (content == "" || content.length < 3 || content.replace(/\s/g, "").length < 3 || removeChar(content) == "") {
        $("#errorContentReplyComment").show();
        $("#contentReplyComment").parent().addClass("is-invalid");
        var errorContentReplyComment = false;
    } else {
        $("#errorContentReplyComment").hide();
    }
    if (errorDanhXungReplyComment == false || errorNameReplyComment == false || errorPhoneReplyComment == false || errorContentReplyComment == false) {
        return false;
    }
}

function loadComment(){
    var idProduct =$("#productId").val();
    var urlRequest = '/load/comment?page='+page;
    // var page = $('#page').val() ?? 1;

    $.ajax({
        url : urlRequest,
        headers: TOKEN,
        method : 'POST',
        data : {idProduct : idProduct, page: page, type_comment: 1},
        success : function(data){
            $('#comments').html(data.data);

            $("#countLoadMoreCm").val(data.totalItems);
            var countLoadMoreCm = $("#countLoadMoreCm").val();
            var countLoadMore = parseInt(countLoadMoreCm) - 5;
            $("#countLoadMoreCm").val(countLoadMore);
            if (countLoadMore >= 5) {
                var countLoadMore = 5;
            }
            if (data.totalItems > 1) {
                $("#lcViewMoreCm").show();
            }
        } 
    });
}


function loadScrollComment(){

    let checkScroll = true;
    $(window).scroll(function(){
        if($(this).scrollTop()>=500 && checkScroll){
            checkScroll = false;
            loadComment();
        }
    });
}

function sendComment() {
    $(document).on("click", "#sendComment", function () {
        var contentWrap = $('#modal_ajax');
        var url = $(this).data('url');
        var danhXung = $("input[name='danhXungComment']:checked").val();
        var name = $("input[name='nameComment']").val();
        var type_comment = 1;
        var phone = $("input[name='phoneComment']").val();
        var email = $("input[name='emailComment']").val();
        var content = removeChar($("textarea[name='contentComment']").val());

        var validate = validateCreateComment(danhXung, name, phone, email);
        $("#commentSuccess").modal('hide')

        if (validate == false) {
            return false;
        }

        $.ajax({
            url: url,
            headers: TOKEN,
            type: "POST",
            data: { product_id: $("#productId").val(), type_comment : type_comment,  name: removeChar(name), phone: removeChar(phone), pageName: $("#pageName").val(), email: email, content: content, danh_xung: removeChar(danhXung) },
            success: function (response) {
                if (response.code == 200) {
                    let html = response.html;
                    contentWrap.html(html);
                    $("#modal-comment-success").modal('show');
                    $('#modal-comment').modal('hide'); 
                    loadComment(page);
                }

                clearInputComment();
            },
            error: function (response) {
                let html = response.html;
                contentWrap.html(html);
                $("#modal-comment-error").modal('show');
                $('#modal-comment').modal('hide'); 
            },
        });
    });
}

// load more comment
function loadMoreComments() {
    $(document).on("click", "#loadMoreComments", function () {
        var type_comment = 1; // type_comment = 1 -> binhf luaanj
        var page = $("#pageComment").val();
        var type = $("#typeFilterComment").val();
        if (type == "" || typeof type == "undefined") {
            var type = "desc";
        }
        if (page == "" || typeof page == "undefined") {
            var page = 2;
        }
        $.ajax({
            url: "/filter/comment",
            type: "GET",
            data: { productId: $("#productId").val(), pageName: $("#pageName").val(), type: type, type_comment: type_comment, page: page },
            success: function (response) {
                $("#comments").append(response.data);
                $("#pageComment").val(parseInt(page) + 1);
                var countLoadMoreCm = $("#countLoadMoreCm").val();
                var countLoadMore = parseInt(countLoadMoreCm) - 5;
                $("#countLoadMoreCm").val(countLoadMore);
                if (countLoadMore >= 5) {
                    var countLoadMore = 5;
                }
                $(".count-load-more-cm").text(countLoadMore);
                if (parseInt(page) == response.totalPage) {
                    $("#lcViewMoreCm").hide();
                }
            },
        });
    });
}

function sendReplyComment() {
    $(document).on("click", "#sendReplyComment", function () {
        var url = $(this).data('url');
        var contentWrap = $('#modal_ajax');
        var parent_id = $("#replyIdComment").val();
        var type_comment = $("#replyTypeComment").val();
        var danhXung = $("input[name='danhXungReplyComment']:checked").val();
        var name = $("input[name='nameReplyComment']").val();
        var phone = $("input[name='phoneReplyComment']").val();
        var email = $("input[name='emailReplyComment']").val();
        var content = removeChar($("textarea[name='contentReplyComment']").val());
        var validate = validateReplyComment(danhXung, name, phone, email, content);
        if (validate == false) {
            return false;
        }
        $.ajax({
            url: url,
            headers: TOKEN,
            type: "POST",
            data: { parent_id: removeChar(parent_id), product_id: $("#productId").val(), name: removeChar(name), phone: removeChar(phone), email: email, content: content, danh_xung: removeChar(danhXung), type_comment : type_comment },
            // success: function (response) {
            //     console.log('thanh cong');

            //     return false;
            //     $("#sendReplyComment").prop("disabled", false);
            //     $(".text-success-comment").text("Gá»­i CĂ¢u Tráº£ Lá»i ThĂ nh CĂ´ng");
            //     $(".text-success-comment-sub").text("CĂ¢u tráº£ lá»i Ä‘Ă£ Ä‘Æ°á»£c ghi nháº­n vĂ  sáº½ cáº­p nháº­t trong thá»i gian sá»›m nháº¥t.");
            //     $("#modalReplyComment").removeClass(MODAL_CLASS);
            //     openModal("success");
            //     $(".feedback-" + response.commentId).html(response.data);
            //     $("#pageComment" + response.commentId).val(2);
            //     clearInputComment();
            // },
            success: function (response) {
                if (response.code == 200) {
                    let html = response.html;
                    contentWrap.html(html);
                    $(".text-success-comment").text("Gửi Câu Trả Lời Thành Công");
                    $(".text-success-comment-sub").text("Câu trả lời đã được ghi nhận và sẽ cập nhật trong thời gian sớm nhất.");
                    $("#modal-comment-success").modal('show');
                    $('#modalReplyComment').modal('hide'); 
                    if(type_comment == 1){
                        loadComment();
                        clearInputComment();
                    }else{
                        loadReview();
                        clearInputReview();
                    }
                }
            },
            error: function (response) {
                let html = response.html;
                contentWrap.html(html);
                $("#modal-comment-error").modal('show');
                $('#modalReplyComment').modal('hide'); 
            },
        });
    });
}

/**
 * Đánh giá
 * @param {*} danhXung 
 * @param {*} name 
 * @param {*} phone 
 * @param {*} email 
 * @param {*} content 
 * @param {*} star 
 * @returns 
 */

function validateForm(danhXung, name, phone, email, content, star) {
    if (danhXung == "" || typeof danhXung == "undefined") {
        $("#errorDanhXungReview").show();
        $(".check-form-review").addClass("is-invalid");
        var errorDanhXungReview = false;
    } else {
        $("#errorDanhXungReview").hide();
        $(".check-form-review").removeClass("is-invalid");
    }
    if (name == "" || name.replace(/\s/g, "").length < 1 || removeChar(name) == "") {
        $("#errorNameReview").show();
        $("#nameReview").parent().addClass("is-invalid");
        var errorNameReview = false;
    } else {
        $("#errorNameReview").hide();
    }
    if (phone == "" || phone.replace(/\s/g, "").length < 1) {
        $("#errorPhoneReview").show();
        $("#phoneReview").parent().addClass("is-invalid");
        var errorPhoneReview = false;
    } else {
        if (phone.length < 10 || phone.length > 10 || !$.isNumeric(phone) || phonenumber(phone) == false) {
            $("#errorPhoneReview").show();
            $("#phoneReview").parent().addClass("is-invalid");
            $(".error-phone-review-text").text("Số điện thoại không hợp lệ!");
            var errorPhoneReview = false;
        } else {
            $("#errorPhoneReview").hide();
        }
    }
    if (email != "" || email.length > 0 || email.replace(/\s/g, "").length > 0 || removeChar(email) != "") {
        if (isEmail(email) == false) {
            $("#errorEmailReview").show();
            return false;
        } else {
            $("#errorEmailReview").hide();
        }
    } else {
        $("#errorEmailReview").hide();
    }
    if (content == "" || content.length < 3 || content.replace(/\s/g, "").length < 3) {
        $("#errorContentReview").show();
        $("#contentReview").parent().addClass("is-invalid");
        var errorContentReview = false;
    } else {
        $("#errorContentReview").hide();
    }
    if (star == 0) {
        $(".error-star").show();
        var errorStar = false;
    } else {
        $(".error-star").hide();
    }
    if (errorDanhXungReview == false || errorNameReview == false || errorPhoneReview == false || errorContentReview == false || errorStar == false) {
        return false;
    }
}

function loadReview(){
    var idProduct =$("#productId").val();
    var urlRequest = '/load/comment';

    $.ajax({
        url : urlRequest,
        headers: TOKEN,
        method : 'POST',
        data : {idProduct : idProduct, type_comment: 2},
        success : function(data){
            $('#reviews').html(data.data);
        } 
    });
}

function loadScrollReview(){
    let checkScroll = true;
    $(window).scroll(function(){
        if($(this).scrollTop()>=600 && checkScroll){
            checkScroll = false;
            loadReview();
        }
    });
}

// load more review
function loadMoreReviews() {
    $(document).on("click", "#loadMoreReviews", function () {
        var type_comment = 2; // type_comment = 1 -> binhf luaanj
        var page = $("#pageReview").val();
        var type = $("#typeFilterReview").val();
        if (type == "" || typeof type == "undefined") {
            var type = "desc";
        }
        if (page == "" || typeof page == "undefined") {
            var page = 2;
        }
        $.ajax({
            url: "/filter/comment",
            type: "GET",
            data: { productId: $("#productId").val(), pageName: $("#pageName").val(), type: type, type_comment: type_comment, page: page },
            success: function (response) {
                $("#reviews").append(response.data);
                $("#pageReview").val(parseInt(page) + 1);
                var countLoadMoreCm = $("#countLoadMoreCm").val();
                var countLoadMore = parseInt(countLoadMoreCm) - 5;
                $("#countLoadMoreCm").val(countLoadMore);
                if (countLoadMore >= 5) {
                    var countLoadMore = 5;
                }
                $(".count-load-more-cm").text(countLoadMore);
                if (parseInt(page) == response.totalPage) {
                    $("#lcViewMoreCm").hide();
                }
            },
        });
    });
}

function ratingReview(star, averageRating, percentFiveStar, percentFourStar, percentThreeStar, percentTwoStar, percentOneStar) {
    $("#average-rating").html(averageRating);
    $(".progress-bar-5").attr("style", "width:" + percentFiveStar + "%;");
    $(".progress-bar-4").attr("style", "width:" + percentFourStar + "%;");
    $(".progress-bar-3").attr("style", "width:" + percentThreeStar + "%;");
    $(".progress-bar-2").attr("style", "width:" + percentTwoStar + "%;");
    $(".progress-bar-1").attr("style", "width:" + percentOneStar + "%;");
    var oldStar = $("#" + star + "star").text();
    $("#" + star + "star").text(parseInt(oldStar) + 1);
}

function sendReview() {
    $(document).on("click", "#sendReview", function () {
        var contentWrap = $('#modal_ajax');
        var url = $(this).data('url');
        var danhXung = $("input[name='danhXungReview']:checked").val();
        var name = $("input[name='nameReview']").val();
        var phone = $("input[name='phoneReview']").val();
        var email = $("input[name='emailReview']").val();
        var content = removeChar($("textarea[name='contentReview']").val());
        var star = $(".lc__rating-star").find("li.m-r-8.selected").length;

        var validate = validateForm(danhXung, name, phone, email, content, star);
        if (validate == false) {
            return false;
        }
        $.ajax({
            url: url,
            type: "POST",
            headers: TOKEN,
            data: { product_id: PRODUCT_ID, name: removeChar(name), phone: removeChar(phone), email: email, content: content, danh_xung: removeChar(danhXung), star: star , type_comment : 2},
            /*success: function (response) {

                var tracking = "Gá»­i Ä‘Ă¡nh giĂ¡ : " + star;
                ga("send", "event", "Product Detail Page", "Click ÄĂ¡nh giĂ¡", tracking, { nonInteraction: 1 });
                $(".send-review").prop("disabled", false);
                $("#lcBoxReviews").show();
                $(".new-page-reviews").html("");
                $("#pageReview").val(2);
                $("#sortTypeReviews").val("moi-nhat");
                $(".filter-reviews").removeClass("active");
                $("#descReview").addClass("active");
                $(".label-filter-review").text("Mới nhất");
                $(".menu-filter-review").removeAttr("style");
                $("#sectionReviews").show();
                $("#noneReviews").attr("style", "display:none !important;");
                $("#countLoadMoreRv").val(response.totalItems);
                var countLoadMoreRv = $("#countLoadMoreRv").val();
                var countLoadMore = parseInt(countLoadMoreRv) - 5;
                $("#countLoadMoreRv").val(countLoadMore);
                if (countLoadMore >= 5) {
                    var countLoadMore = 5;
                }
                $(".count-load-more-rv").text(countLoadMore);
                var averageRating = response.averageRating;
                ratingReview(star, averageRating, response.percentFiveStar, response.percentFourStar, response.percentThreeStar, response.percentTwoStar, response.percentOneStar);
                $(".average-rating-star").html("");
                $("#starRatingTop").html("");
                $(".star-rating-top").remove();
                response.starAcive.forEach(function (value, index) {
                    $(".average-rating-star").append('<li class="m-r-8 m-r-md-4"><span class="ic-star fill fs-p-20 fs-p-md-14"></span></li>');
                    $("#starRatingTop").append('<li><i class="ic-star"></i></li>');
                });
                if (averageRating < 5) {
                    response.starNotActive.forEach(function (value, index) {
                        $(".average-rating-star").append('<li class="m-r-8 m-r-md-4"><span class="ic-star fs-p-20 fs-p-md-14"></span></li>');
                        $("#starRatingTop").append('<li><i class="ic-star-o"></i></li>');
                    });
                }
                $("#starRatingTop").append("<li></li>");
                view("listReview", response.data, response.totalItems, response.totalPage);
                clearInputReview();
                $(".form-review").removeClass(MODAL_CLASS);
                openModalSuccess();
            },*/
            success: function (response) {
                if (response.code == 200) {
                    let html = response.html;
                    contentWrap.html(html);
                    $('#avgRating').text(response.avgRating + '/5');
                    $('#countRating').text(response.countRating);
                    $("#modal-comment-success").modal('show');
                    $('#modal-danh-gia').modal('hide'); 
                    loadReview();
                }

                clearInputReview();
            },
            error: function (response) {
                let html = response.html;
                contentWrap.html(html);
                $("#modal-comment-error").modal('show');
                $('#modal-danh-gia').modal('hide'); 
            },
        });
    });
}




function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function phonenumber(mobile) {
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    if (mobile !== "") {
        if (vnf_regex.test(mobile) == false) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function keyUpValidate(elementKeyup, elementHide, elementName = false, extend = false, errorText, star = false, textareaMobile = false, invaliEmail = false) {
    $(document).on("keyup", "#" + elementKeyup, function () {
        if ($(this).val() != "" && $(this).val().replace(/\s/g, "").length > 0 && removeChar($(this).val()) != "") {
            $("#" + elementHide).hide();
            $("#" + elementHide)
                .parent()
                .children()
                .removeClass("is-invalid");
        } else {
            $("#" + elementHide).show();
            $("#" + elementHide)
                .parent()
                .children()
                .addClass("is-invalid");
        }
        if (extend == "phone") {
            if ($(this).val().length > 0) {
                if ($(this).val().length < 10 || $(this).val().length > 10 || phonenumber($(this).val()) == false) {
                    $("." + errorText).text("Số điện thoại không hợp lệ");
                    $("#" + elementHide).show();
                    $("#" + elementHide)
                        .parent()
                        .children()
                        .addClass("is-invalid");
                } else {
                    $("#" + elementHide).hide();
                    $("#" + elementHide)
                        .parent()
                        .children()
                        .removeClass("is-invalid");
                }
            } else {
                $("." + errorText).text("Thông tin bắt buộc");
                $("#" + elementHide).show();
                $("#" + elementHide)
                    .parent()
                    .children()
                    .addClass("is-invalid");
            }
        }
        if (extend == "content") {
            if (removeChar($(this).val()).length < 3 || $(this).val().replace(/\s/g, "").length < 3) {
                $("#" + elementHide).show();
                $("#" + elementHide)
                    .parent()
                    .addClass("is-invalid");
            } else {
                $("#" + elementHide).hide();
                $("#" + elementHide)
                    .parent()
                    .removeClass("is-invalid");
            }
        }
    });
    if (invaliEmail != false) {
        $(document).on("keyup", "#" + elementKeyup, function () {
            var email = $(this).val();
            if (email != "" && email.length > 5 && email.replace(/\s/g, "").length > 0) {
                if (isEmail(email) == false) {
                    $("#" + elementHide).show();
                    $("#" + elementHide)
                        .parent()
                        .children()
                        .addClass("is-invalid");
                    return false;
                } else {
                    $("#" + elementHide).hide();
                    $("#" + elementHide)
                        .parent()
                        .children()
                        .removeClass("is-invalid");
                }
            } else {
                $("#" + elementHide).hide();
                $("#" + elementHide)
                    .parent()
                    .children()
                    .removeClass("is-invalid");
            }
        });
    }
    $(document).on("click", "." + elementKeyup, function () {
        var danhXung = $("input[name=" + elementName + "]:checked").val();
        if (typeof danhXung != "undefined") {
            $("#" + elementHide).hide();
            if (elementKeyup == "danh-xung-comment") {
                $(".check-form-create-comment").removeClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-reply-comment") {
                $(".check-form-reply-comment").removeClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-review") {
                $(".check-form-review").removeClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-reply-review") {
                $(".check-form-reply-review").removeClass("is-invalid");
            }
        } else {
            $("#" + elementHide).show();
            if (elementKeyup == "danh-xung-comment") {
                $(".check-form-create-comment").addClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-reply-comment") {
                $(".check-form-reply-comment").addClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-review") {
                $(".check-form-review").addClass("is-invalid");
            }
            if (elementKeyup == "danh-xung-reply-review") {
                $(".check-form-reply-review").addClass("is-invalid");
            }
        }
    });

    $("create-rating").click(function () {
        var rating = $(".lc__rating-star").find("li.m-r-8.selected").length;
        if (rating > 0) {
            $(".error-star").hide();
        } else {
            $(".error-star").show();
        }
    });

}



function openModalReplyComment() {
    $(document).on("click", ".open-modal-reply-comment", function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var type_comment = $(this).data("type_comment");
        $("#replyNameComment").text(name);
        $("#replyIdComment").val(id);
        $("#replyTypeComment").val(type_comment);
    });
}

function callKeyUpValidate() {
    //comment
    keyUpValidate("danh-xung-comment", "errorDanhXungComment", "danhXungComment");
    keyUpValidate("nameComment", "errorNameComment");
    keyUpValidate("phoneComment", "errorPhoneComment", "none", "phone", "text-phone-error-comment");
    keyUpValidate("emailComment", "errorEmailComment", "none", "none", "none", "none", "none", "is-email");
    keyUpValidate("contentComment", "errorContentComment", "none", "content");

    //reply-comment
    keyUpValidate("danh-xung-reply-comment", "errorDanhXungReplyComment", "danhXungReplyComment");
    keyUpValidate("nameReplyComment", "errorNameReplyComment");
    keyUpValidate("phoneReplyComment", "errorPhoneReplyComment", "none", "phone", "phone-error-reply-comment-text");
    keyUpValidate("emailReplyComment", "errorEmailReplyComment", "none", "none", "none", "none", "none", "is-email");
    keyUpValidate("contentReplyComment", "errorContentReplyComment", "none", "content");

    //review
    keyUpValidate("danh-xung-review", "errorDanhXungReview", "danhXungReview");
    keyUpValidate("nameReview", "errorNameReview");
    keyUpValidate("phoneReview", "errorPhoneReview", "none", "phone", "error-phone-review-text");
    keyUpValidate("emailReview", "errorEmailReview", "none", "none", "none", "none", "none", "is-email");
    keyUpValidate("contentReview", "errorContentReview", "none", "content");
    keyUpValidate("none", "none", "none", "none", "none", "star");
    if(0){
        keyUpValidate("none", "none", "none", "none", "none", "star", "contentCreateCommentMb");

        

        
        keyUpValidate("danh-xung-reply-review", "errorDanhXungReplyReview", "danhXungReplyReview");
        keyUpValidate("nameReplyReview", "errorNameReplyReview");
        keyUpValidate("phoneReplyReview", "errorPhoneReplyReview", "none", "phone", "error-phone-reply-review-text");
        keyUpValidate("emailReplyReview", "errorEmailReplyReview", "none", "none", "none", "none", "none", "is-email");
        keyUpValidate("contentReplyReview", "errorContentReplyReview", "none", "content");
    }
}


function like ()
    {
        $(document).on('click', '.js-like', function(event){
            event.preventdefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var likeStatus = localStorage.getItem(id);

            if(likeStatus != 'liked'){
                // $('.total-like-'+id).show();
                var totalLike = $('.total-like-'+id).data('like');
                var increaseLike = parseInt(totalLike) + 1;
                var likeHtml = increaseLike.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $('.total-like-'+id).text('('+ likeHtml +')');
                // $('.icon-like-'+id).show();
                $(this).find('.icon-like').html('<i class="fa fa-thumbs-up"></i>');

                $.ajax({
                    headers: TOKEN,
                    type: "POST",
                    url : url,
                    data : {
                        id : id
                    },
                    success : function(response)
                    {
                        localStorage.setItem(id, 'liked');
                    }
                });
            }
        });
    }


$(document).ready(function () {
    openModalReplyComment();
    openModalCreateComment();


    //comment
    loadScrollComment();
    loadMoreComments();
    sendComment();
    sendReplyComment();

    //review
    sendReview();
    loadScrollReview();
    loadMoreReviews();

    //like
    like();

    callKeyUpValidate();
});
