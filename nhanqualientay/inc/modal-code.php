<?php
defined('APP_PATH') or die();
?>
<section id="box-code" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans">
        <h2 class="gift-contes-title-2 txt-bold u-mb-20 u-sp-mb-20">
            NHẬP MÃ DỰ THƯỞNG <br>ĐỂ ĐƯỢC THAM GIA TRÒ CHƠI
        </h2>
        <div class="code-description u-mb-20 u-sp-mb-20">
            Mở nắp, tìm mã may mắn,<br>
            cơ hội trúng thưởng ngay!
        </div>
        <form class="form-code js-verify-code-form" data-toggle="validator" role="form" autocomplete="off">
            <input type="hidden" value="<?php echo $csrf_token ?>" data-field="csrf" />
            <div class="form-group js-message u-hidden" data-message="Xác minh mã dự thưởng thành công!">
                <p class="text-center c-red"></p>
            </div>
            <div class="form-group">
                <input type="text" data-field="code" class="form-control" id="inputcode" placeholder="Nhập mã dự thưởng" data-error="Vui lòng nhập mã dự thưởng" minlength="8" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group txt-center">
                <button type="submit" class="btn-dark-green-2 hover shadown"><span>NHẬP MÃ</span></button>
            </div>
        </form>
    </div>
</section>
<section id="box-code-error" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans txt-center">
        <div class="txt-green-2 u-pb-60 u-sp-pb-60">
            <div class="error error-1 u-hidden">
                Mã dự thưởng đã được sử dụng, hãy mua thêm sản phẩm để lấy mã dự thưởng và không bỏ lỡ cơ hội trúng thưởng!
            </div>
            <div class="error error-2">
                Lượt chơi đã bị khoá.<br>
                Vui lòng liên hệ fanpage Lotte Xylitol<br>
                để được hỗ trợ mở khoá.
            </div>
            <div class="error error-3 u-hidden">
                Chúc bạn may mắn lần sau.<br>
                Hãy mua thêm sản phẩm để lấy mã dự thưởng và không bỏ lỡ cơ hội trúng thưởng!
            </div>
            <div class="error error-4 u-hidden">
                Mã dự thưởng chưa chính xác.<br>
                Vui lòng nhập lại mã dự thưởng.
            </div>
        </div>
        <div class="form-group">
            <a class="btn-dark-green-2 shadow-2 hover btn-back js-btn-back-code"><span>QUAY LẠI</span></a>
        </div>
    </div>
</section>
