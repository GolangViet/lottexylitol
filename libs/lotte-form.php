<?php

if(defined('APP_PATH') && class_exists('lotte_form') == false) :

    /**
     * Lotte Form
     */
    class lotte_form
    {
        function get_options($type = '', $key = null)
        {
            $options = [];

            if($type == 'gender') {
                $options = [
                    "0" => "Nam",
                    "1" => "Nữ",
                    "2" => "Khác",
                ];
            } else if($type == 'gender_en') {
                $options = [
                    "0" => "Male",
                    "1" => "Female",
                    "2" => "Other",
                ];
            } else if($type == 'age') {
                $options = [
                    "1" => "1 - 15",
                    "2" => "16 - 20",
                    "3" => "21 - 25",
                    "4" => "26 - 30",
                    "5" => "31 - 35",
                    "6" => "36 - 40",
                    "7" => "41 - 45",
                    "8" => "46 - 50",
                    "9" => "51 - 55",
                    "10" => "56 - 60",
                    "11" => "60 - 65",
                    "12" => "66 - 70",
                    "13" => "71 - 75",
                    "14" => "76 - 80",
                ];
            } else if($type == 'city') {
                $options = [
                    "1" => "Hà Nội",
                    "2" => "TP. Hồ Chí Minh",
                    "3" => "Hải Phòng",
                    "4" => "Đà Nẵng",
                    "5" => "Cần Thơ",
                    "6" => "An Giang",
                    "7" => "Bà Rịa-Vũng Tàu",
                    "8" => "Bắc Giang",
                    "9" => "Bắc Kạn",
                    "10" => "Bạc Liêu",
                    "11" => "Bắc Ninh",
                    "12" => "Bến Tre",
                    "13" => "Bình Định",
                    "14" => "Bình Dương",
                    "15" => "Bình Phước",
                    "16" => "Bình Thuận",
                    "17" => "Cà Mau",
                    "18" => "Cao Bằng",
                    "19" => "Đắk Lắk",
                    "20" => "Đắk Nông",
                    "21" => "Điện Biên",
                    "22" => "Đồng Nai",
                    "23" => "Đồng Tháp",
                    "24" => "Gia Lai",
                    "25" => "Hà Giang",
                    "26" => "Hà Nam",
                    "27" => "Hà Tĩnh",
                    "28" => "Hải Dương",
                    "29" => "Hậu Giang",
                    "30" => "Hòa Bình",
                    "31" => "Hưng Yên",
                    "32" => "Khánh Hòa",
                    "33" => "Kiên Giang",
                    "34" => "Kon Tum",
                    "35" => "Lai Châu",
                    "36" => "Lâm Đồng",
                    "37" => "Lạng Sơn",
                    "38" => "Lào Cai",
                    "39" => "Long An",
                    "40" => "Nam Định",
                    "41" => "Nghệ An",
                    "42" => "Ninh Bình",
                    "43" => "Ninh Thuận",
                    "44" => "Phú Thọ",
                    "45" => "Phú Yên",
                    "46" => "Quảng Bình",
                    "47" => "Quảng Nam",
                    "48" => "Quảng Ngãi",
                    "49" => "Quảng Ninh",
                    "50" => "Quảng Trị",
                    "51" => "Sóc Trăng",
                    "52" => "Sơn La",
                    "53" => "Tây Ninh",
                    "54" => "Thái Bình",
                    "55" => "Thái Nguyên",
                    "56" => "Thanh Hóa",
                    "57" => "Thừa Thiên - Huế",
                    "58" => "Tiền Giang",
                    "59" => "Trà Vinh",
                    "60" => "Tuyên Quang",
                    "61" => "Vĩnh Long",
                    "62" => "Vĩnh Phúc",
                    "63" => "Yên Bái",
                ];
            }

            if($key != null) {
                if(isset($options[$key])) {
                    return $options[$key];
                }
                
                return '';
            }

            return $options;
        }

        function get_options_html($type = '', $selected = '', $none_text = '')
        {
            $html = [];

            if($none_text != '') {
                $value = '';

                $list = explode(':', $none_text);
                if(count($list) == 2) {
                    list($value, $none_text) = array_map('trim', $list); 
                }

                $html[] = '<option value="'.$value.'">' . $none_text . '</option>';
            }

            $list = $this->get_options($type);
            if(count($list)>0) {
                $check = 'value';
                
                if(is_array($selected)) {
                    $check = array_key_first($selected);
                    $selected = $selected[$check];
                }

                foreach($list as $value => $label) {
                    $attr = '';

                    if($check == 'value' && $selected == $value) {
                        $attr = 'selected';
                    } else if($check == 'label' && $selected == $label) {
                        $attr = 'selected';
                    }

                    $html[] = '<option value="'.$value.'"' . $attr . '>' . $label . '</option>';
                }
            }

            return implode("\n", $html);
        }

        /**
         * Sample Data 
         */
        function get_sample_data($type = '')
        {
            $data = [];

            if($type == 'user') {
                $data = [
                    "name" => "Savannah Nguyen",
                    "email" => "savannah.nguyen@example.com",
                    "phone" => "234567890",
                    "address" => "2118 Thornridge Cir. Syracuse, Connecticut 35624",
                    "city" => "City",
                    "gender" => "Nữ",
                    "age" => "23",
                    "utm" => "",
                    "survey_expires" => 0,
                    "survey_count" => 0,
                    "gift_count" => 0
                ];
            }

            return $data;
        }
    }

    $lotte_form = new lotte_form();

endif;