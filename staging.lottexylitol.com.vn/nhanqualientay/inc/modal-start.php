<?php
defined('APP_PATH') or die();
?>
<section id="box-start" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans">
        <form class="form-term js-term-form" data-toggle="validator" data-step="<?php echo $step ?>" role="form" autocomplete="off" data-modal="<?php echo $next_step ?>">
            <div class="description u-pb-30 u-sp-pb-20">
                <strong class="txt-green-2">Bước 1:</strong><br class="ipSE-hide">
                Nhập mã dự thưởng nằm trên thẻ trúng thưởng trong sản phẩm.<br><br>
                <strong class="txt-green-2">Bước 2:</strong><br class="ipSE-hide">
                Tham gia trò chơi điền vào chỗ trống bằng cách đọc kỹ câu hỏi và chọn các đáp án chính xác nhất trong số các đáp án. Màn hình hiện đáp án chính xác cuối cùng sau trò chơi. Sau đó chọn nút “Hiểu rồi”.<br><br>
                <strong class="txt-green-2">Bước 3:</strong><br class="ipSE-hide">
                Bấm nút “Chơi ngay” để nhận phần quà may mắn ngẫu nhiên.<br><br>
                <strong class="txt-green-2">Bước 4:</strong><br class="ipSE-hide">
                Kiểm tra thông tin nhận quà trong trang cá nhân để nhận thưởng.
            </div>
            <div class="u-pb-30 u-sp-pb-20 ipSE-row-2">
                <label class="checkbox">
                    Tôi đã đọc và đồng ý <a class="link-u js-btn-terms">thể lệ và điều khoản tham gia chương trình</a>
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
                <br>
                <label class="checkbox">
                    Tôi đã đọc và đồng ý với <a class="link-u" href="/privacy-policy/" target="_blank">chính sách về quyền riêng tư</a> của Lotte Xylitol Việt Nam
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group txt-center">
                <?php if ($signup_link != '') : ?>
                    <a class="btn-dark-green-2 hover shadow txt-upper disabled js-button" href="<?php echo $signup_link ?>"><span>Chơi ngay</span></a>
                <?php else: ?>
                    <button type="submit" class="btn-dark-green-2 hover shadow txt-upper disabled js-button"><span>Chơi ngay</span></button>
                <?php endif ?>
            </div>
        </form>
    </div>
</section>
