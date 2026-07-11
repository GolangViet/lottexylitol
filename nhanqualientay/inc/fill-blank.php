<?php
defined('APP_PATH') or die();

$list = [
    [
        'question' => '<span class="title">XYLITOL</span> là chất ngọt tự nhiên, có trong nhiều loại <span class="value">...</span>, <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'Rau Củ',
                'img' => 'icon-01.png',
                'selected' => 1,
            ],
            [
                'title' => 'Trái Cây',
                'img' => 'icon-02.png',
                'selected' => 1,
            ],
            [
                'title' => 'Đường Tinh Luyện',
                'img' => 'icon-03.png',
            ],
        ],
    ],
    [
        'question' => '<span class="title">XYLITOL</span> là chất tạo ngọt tự nhiên, có tác dụng <span class="value">...</span> và hạn chế vi khuẩn <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'Ngăn Ngừa Sâu Răng',
                'img' => 'icon-04.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'Mutan Gây Sâu Răng',
                'img' => 'icon-05.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => 'Vi Khuẩn',
                'img' => 'icon-06.png',
            ],
            [
                'title' => 'Sâu răng',
                'img' => 'icon-07.png',
            ],
            [
                'title' => 'Virus',
                'img' => 'icon-08.png',
            ],
        ],
    ],
    [
        'question' => '<span class="title">Lotte Xylitol</span> là kẹo gum được <span class="value">...</span> chứng nhận và khuyên dùng.',
        'answers' => [
            [
                'title' => 'Hội Răng Hàm Mặt VN',
                'img' => 'icon-09.png',
                'selected' => 1,
            ],
            [
                'title' => 'Sở Y Tế',
                'img' => 'icon-10.png',
            ],
            [
                'title' => 'Bệnh Viện RHM',
                'img' => 'icon-11.png',
            ],
        ],
    ],
    [
        'question' => 'Ngoài ngăn ngừa sâu răng, kẹo gum <span class="title">Lotte Xylitol</span> còn giúp thúc đẩy quá trình <span class="value">...</span>, giúp <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'Tái Khoáng Hóa',
                'img' => 'icon-12.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'Men Răng Khỏe Hơn',
                'img' => 'icon-13.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => 'Vui Miệng',
                'img' => 'icon-14.png',
            ],
            [
                'title' => 'Tỉnh Táo',
                'img' => 'icon-15.png',
            ],
        ],
    ],
    [
        'question' => 'Để đạt hiệu quả ngăn ngừa sâu răng, nhai <span class="value">...</span>, <span class="value">...</span> và các dịp ăn vặt.',
        'answers' => [
            [
                'title' => '2 viên Lotte Xylitol',
                'img' => 'icon-16.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'Sau Mỗi Bữa Ăn',
                'img' => 'icon-17.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => '4 Viên Mỗi Ngày',
                'img' => 'icon-18.png',
            ],
            [
                'title' => 'Trước Khi Ăn',
                'img' => 'icon-19.png',
            ],
        ],
    ],
];

// $index = rand(0, count($list) - 1);
// $index = count($list) - 1;

if(empty($fill_blank_index) || $fill_blank_index == -1) {
    $index = 0; // rand(0, count($list) - 1);
} else {
    $index = $fill_blank_index;
}

$item = $list[$index];

for($i = 1; $i < count($item['answers']) - 1; $i++) {
    $j = rand(0, $i);

    $tmp = $item['answers'][$i];
    $item['answers'][$i] = $item['answers'][$j];
    $item['answers'][$j] = $tmp;
}

$answers = [];

$results = [];

$time = strtotime('+20 minutes');

// foreach($list as $index => $item) :
?>
<div class="section-contest section-must-buy fill-blank" id="fill-blank">
    <div class="txt-center">
        <p class="title u-pb-20 u-sp-pb-10">Điền vào chỗ trống</p>
        <p class="u-pb-20 u-sp-pb-10">Kéo câu trả lời vào chỗ trống để hoàn thiện câu</p>
    </div>
    <div class="group-questions">
        <div class="txt-center u-pb-30 u-sp-pb-30">
            <?php echo $item['question'] ?>
        </div>
        <div class="u-relative">
            <?php /* <div class="img-01"><img width="125" src="<?php echo APP_ASSETS; ?>img/must-buy/img-product-01.png" alt="" /></div> */ ?>
            <div class="img-01 lottie-icon-01 lottie-icon" data-src="/assets/json/bottle-blank/bottle.json"></div>
            <?php foreach ($item['answers'] as $answer) :
                if (empty($answer['selected'])) continue;
                $results[] = $answer;
                $answers[] = md5($time . $answer['title']);
            ?>
                <div class="row-question"><span class="button-question js-question-item">Kéo vào đây</span></div>
            <?php endforeach ?>
            <div class="txt-right row-error" style="display: none;">
                <div class="msg-error">Chưa chính xác, hãy thử lại</div>
            </div>
        </div>
    </div>
    <div class="group-answers">
        <?php foreach ($item['answers'] as $answer) : ?>
            <div class="row-answer u-pb-50 u-sp-pb-40">
                <a class="btn-dark-green-2 shadow-2 js-answer-item" data-value="<?php echo !empty($answer['selected']) ? 'selected' : 'disabled' ?>" <?php echo isset($answer['index']) ? ' data-index="' . $answer['index'] . '"' : '' ?>>
                    <i class="before"><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/must-buy/<?php echo $answer['img'] ?>" alt="" /></i>
                    <span data-value="<?php echo md5($time . $answer['title']);  ?>"><?php echo $answer['title'] ?></span>
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <div class="group-results txt-center" style="display: none;">
        <div class="row-note u-mb-30 u-sp-mb-30">
            Xin mời đoàn mình<br class="u-sp"> di chuyển lên đỉnh vinh quang!
        </div>
        <div class="row-images u-mb-30 u-sp-mb-30">
            <?php $answer = $results[rand(0, count($results) - 1)]; ?>
            <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/must-buy/<?php echo $answer['img'] ?>" alt="" data-value="<?php echo md5($time . $answer['title']);  ?>" />
        </div>
        <div class="buttons">
            <a class="btn-dark-green-2 shadow js-step-lucky" data-value="<?php
                $answers[] = 'i' . ($index + 1);
                $answers[] = $time;
                $value = implode('.', $answers);
                echo hash_hmac('sha256', $value, 'fill-blank-' . $time) . '.' . $value;
            ?>"><span>HIỂU RỒI</span></a>
        </div>
    </div>
</div>
<?php
// endforeach;
