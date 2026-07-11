<?php
defined('ABSPATH') or die();

function site_language_gettext($translation, $text, $domain)
{
    if(substr(get_locale(), 0, 2) != 'vi' || $domain != 'site') {
        return $translation;
    }

    $translations = [
        "Username is not exists" => "Tài khoản không tồn tại",
        "Password is not the correct" => "Mật khẩu không chính xác",
        "Request success" => "Xử lý thành công",
        "Request fail" => "Xử lý không thành công",
        "Send mail fail" => "Gửi email không thành công",
        "User signin invalid" => "Tài khoản đăng nhập không chính xác",
        "User signup fail" => "Đăng ký tài khoản không thành công",
        "User is not exists" => "Tài khoản không tồn tại",
        "User update success" => "Cập nhật tài khoản thành công",
        "User update fail" => "Cập nhật tài khoản không thành công",
        "Exists" => "đã có người dùng",
        "Incorrect number" => "Số không chính xác",
        "Incorrect phone" => "Số điện thoại không chính xác",
        "Incorrect email" => "Email không chính xác",
        "Incorrect code" => "Mã kích hoạt không chính xác",
        "email" => "Email",
        "phone" => "Số điện thoại",
        "city" => "Thành phố",
        "age" => "Độ tuổi",
        "gender" => "Giới tính",
        "address" => "Địa chỉ",
        "name" => "Họ tên",
        "code" => "Mã kích hoạt",
        "password" => "Mật khẩu",
        "newpassword" => "Mật khẩu mới",
        "No permission" => "Chưa có quyền truy cập",
        "Token null" => "Token trống",
        "Token expired" => "Phiên đăng nhập hết hạn",
        "Not enough" => "Không đủ",
        "Empty" => "Trống",
        "Process data fail" => "Xử lý dữ liệu thất bại",
        "Photo Contest" => "Cuộc thi hình ảnh",
        "Forgot password" => "Quên mật khẩu",
        "Reset password" => "Đặt lại mật khẩu",
        "Create code fail" => "Tạo mã kích hoạt không thành công",

        "Take the survey %s" => "Làm bài khảo sát %s",
        "Use %s points to exchange for gift %s" => "Dùng %s điểm đổi phần quà %s",
        "Rate product %s" => "Đánh giá sản phẩm %s",
        "Insert contest %s" => "Bạn đã đăng hình %s",
        "Update info" => "Bạn đã cập nhật thông tin",
        "You have participated in the activity %s" => "Bạn đã tham gia hoạt động %s",
        "Your score: %s" => "Bạn vừa đạt %s điểm",
        'YOUR GAME EXPIRED' => 'Hết thời gian chơi',

        "This code has already been used" => "Mã này đã dùng rồi",
        "No rate to run" => "Không có tỉ lệ để quay",
        "No lucky code to run" => "Không có mã để quay",
        "No user to run" => "Không có người để quay",
        "No gift to run" => "Không có quà để quay",
        "No permission to run" => "Không có quà để quay",
        "Insert data error" => "Lỗi thêm dữ liệu",
        "Code empty" => "Mã trống",
        "Code already used" => "Mã đã có người dùng",
        "Code does not exist" => "Mã không tồn tại",
        "This code you are using" => "Mã này bạn đang dùng",
        "This code you have used" => "Mã này bạn đã dùng",
        "Lucky fail" => "Lỗi vòng quay",
        "Gift fail" => "Lỗi lấy quà",
        "Male" => "Nam",
        "Female" => "Nữ",
        "Other" => "Khác",
    ];

    if(isset($translations[$text])) {
        return $translations[$text];
    } else if(strpos($translation, 'Incorrect') > -1) {
        $translation = 'thông tin không chính xác';
    }

    return $translation;
}
add_filter("gettext_site", "site_language_gettext", 10, 3);
