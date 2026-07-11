<?php
defined('APP_PATH') or die();

$list = [
    [
        'question' => '<span class="title">XYLITOL</span> is a natural sweetener found in many types of <span class="value">...</span>, <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'VEGETABLES',
                'img' => 'icon-01.png',
                'selected' => 1,
            ],
            [
                'title' => 'FRUITS',
                'img' => 'icon-02.png',
                'selected' => 1,
            ],
            [
                'title' => 'REFINED SUGAR',
                'img' => 'icon-03.png',
            ],
        ],
    ],
    [
        'question' => '<span class="title">XYLITOL</span> is a natural sweetener that helps <span class="value">...</span> and limits <span class="value">...</span> which contribute to tooth decay.',
        'answers' => [
            [
                'title' => 'Prevent cavities',
                'img' => 'icon-04.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'Mutans bacteria',
                'img' => 'icon-05.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => 'Pathogens',
                'img' => 'icon-06.png',
            ],
            [
                'title' => 'Tooth decay',
                'img' => 'icon-07.png',
            ],
            [
                'title' => 'Virus',
                'img' => 'icon-08.png',
            ],
        ],
    ],
    [
        'question' => '<span class="title">Lotte Xylitol</span> is a chewing gum certified and recommended by the <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'Vietnam Dental Association',
                'img' => 'icon-09.png',
                'selected' => 1,
            ],
            [
                'title' => 'Department of Health',
                'img' => 'icon-10.png',
            ],
            [
                'title' => 'Dental Hospital',
                'img' => 'icon-11.png',
            ],
        ],
    ],
    [
        'question' => 'Beyond preventing dental damage, <span class="title">Lotte Xylitol</span> chewing gum also promotes <span class="value">...</span>, leading to <span class="value">...</span>',
        'answers' => [
            [
                'title' => 'Remineralization',
                'img' => 'icon-12.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'Stronger tooth enamel',
                'img' => 'icon-13.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => 'Enjoyable',
                'img' => 'icon-14.png',
            ],
            [
                'title' => 'Refreshing',
                'img' => 'icon-15.png',
            ],
        ],
    ],
    [
        'question' => 'For effective cavity prevention, chew <span class="value">...</span>, <span class="value">...</span> and after snacks.',
        'answers' => [
            [
                'title' => '2 pieces of Lotte Xylitol',
                'img' => 'icon-16.png',
                'selected' => 1,
                'index' => 0,
            ],
            [
                'title' => 'After every meal',
                'img' => 'icon-17.png',
                'selected' => 1,
                'index' => 1,
            ],
            [
                'title' => '4 pieces of Lotte Xylitol daily',
                'img' => 'icon-18.png',
            ],
            [
                'title' => 'Before eating',
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
        <p class="title u-pb-20 u-sp-pb-10">FILL IN THE BLANKS</p>
        <p class="u-pb-20 u-sp-pb-10">Drag the answers into the blanks to complete the sentence</p>
    </div>
    <div class="group-questions">
        <div class="txt-center u-pb-30 u-sp-pb-30">
            <?php echo $item['question'] ?>
        </div>
        <div class="u-relative">
            <div class="img-01 lottie-icon-01 lottie-icon" data-src="/assets/json/bottle-blank/bottle.json"></div>
            <?php foreach ($item['answers'] as $answer) :
                if (empty($answer['selected'])) continue;
                $results[] = $answer;
                $answers[] = md5($time . $answer['title']);
            ?>
                <div class="row-question"><span class="button-question js-question-item">Drag here</span></div>
            <?php endforeach ?>
            <div class="txt-right row-error" style="display: none;">
                <div class="msg-error">Incorrect, please try again</div>
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
            Onward to glory, everyone!
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
            ?>"><span>GOT IT!</span></a>
        </div>
    </div>
</div>
<?php
// endforeach;
