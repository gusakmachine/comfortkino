<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;
use frontend\assets\FilmAsset;

$this->title = 'My Yii Application';

FilmAsset::register($this);


?>
<section class="main-film">
    <a href="#" class="film__poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
    <a href="#" class="film__trailer-preview" style="background-image: url(img/youtube-preview/maxresdefault.jpg)">
        <div class="film__play">
            <svg class="film__play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
            </svg>
        </div>
    </a>
    <div class="film max-height-on">
        <div class="film__top-left-content">
            <div class="film__left-content">
                <p class="film__label">
                    <span class="film__country">Страна 1, Страна 2</span>
                    <span class="film__genre">жанр</span>
                    <span class="film__duration">0 часов 0 минут</span>
                </p>
                <a href="#" class="film__title">Название фильма</a>
            </div>
            <a class="film__trailer" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                <span class="film__trailer-title">Обоссаный трейлер</span>
                <svg class="film__trailer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                    <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
                </svg>
            </a>
        </div>
        <p class="film__description">Талантливый выпускник Оксфорда, применив свой уникальный ум и невиданную дерзость, придумал нелегальную схему обогащения, используя поместья обедневшей английской аристократии.
            Однако когда он решает продать свой бизнес влиятельному клану миллиардеров из США, на его пути встают не менее обаятельные, но жёсткие джентльмены.
            Намечается обмен любезностями, который точно не обойдётся без перестрелок и парочки несчастных случаев.</p>
        <span class="film__day-name">Сегодня <?= $days[0]['day'], '.', $days[0]['month']; ?></span>
        <div class="flex-wrapper">
            <a href="#" class="film__sessions-info">
                <span class="film__session-time">17:00</span>
                <span class="film__session-price">от 380 ₽</span>
            </a>
            <a href="#" class="film__sessions-info">
                <span class="film__session-time">19:20</span>
                <span class="film__session-price">от 380 ₽</span>
            </a>
            <a href="#" class="film__sessions-info">
                <span class="film__session-time">21:40</span>
                <span class="film__session-price">от 380 ₽</span>
            </a>
        </div>
        <span class="film__day-name">Завтра <?= $days[1]['day'], '.', $days[1]['month']; ?></span>
        <div class="flex-wrapper">
            <a href="#" class="film__sessions-info">
                <span class="film__session-time">17:00</span>
                <span class="film__session-price">от 380 ₽</span>
            </a>
        </div>
        <div class="partially-hidden-content">
           <?php for ($i = 2; $i < 5; $i++): ?>
               <span class="film__day-name"><?= $days[$i]['day-of-week'], ' ', $days[$i]['day'], '.', $days[$i]['month']; ?></span>
               <div class="flex-wrapper">
                   <a href="#" class="film__sessions-info">
                       <span class="film__session-time">17:00</span>
                       <span class="film__session-price">от 380 ₽</span>
                   </a>
               </div>
           <?php endfor; ?>
<!--            <span class="film__day-name">Завтра 16.03</span>-->
<!---->
<!--            <span class="film__day-name">Завтра 16.03</span>-->
<!--            <div class="flex-wrapper">-->
<!--                <a href="#" class="film__sessions-info">-->
<!--                    <span class="film__session-time">17:00</span>-->
<!--                    <span class="film__session-price">от 380 ₽</span>-->
<!--                </a>-->
<!--            </div>-->
<!--            <span class="film__day-name">Завтра 16.03</span>-->
<!--            <div class="flex-wrapper">-->
<!--                <a href="#" class="film__sessions-info">-->
<!--                    <span class="film__session-time">17:00</span>-->
<!--                    <span class="film__session-price">от 380 ₽</span>-->
<!--                </a>-->
<!--            </div>-->
        </div>
        <button class="film__show-all-sessions-btn">Еще сеансы</button>
    </div>
</section>
<section class="additionally-film">
    <div class="container">
        <div class="film-about">
            <h3 class="film-about__director">Режиссёр</h3>
            <p class="film-about__directors-names">Имя режиссёра</p>
            <h3 class="film-about__genre">Жанр</h3>
            <p class="film-about__genre-names">Название жанра</p>
            <h3 class="film-about__actors">Актёры</h3>
            <p class="film-about__actors-names">Имена актёров</p>
            <h3 class="film-about__description">Описание</h3>
            <p class="film-description-mobile">Талантливый выпускник Оксфорда, применив свой уникальный ум и невиданную дерзость, придумал нелегальную схему обогащения, используя поместья обедневшей английской аристократии.
                Однако когда он решает продать свой бизнес влиятельному клану миллиардеров из США, на его пути встают не менее обаятельные, но жёсткие джентльмены.
                Намечается обмен любезностями, который точно не обойдётся без перестрелок и парочки несчастных случаев.</p>
        </div>
        <div class="film-gallery">
            <div class="film-gallery__top-content">
                <h1 class="film-gallery__film-frames">Кадры из фильма</h1>
                <div class="film-gallery__buttons">
                    <button class="film-gallery__btn --prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="#30a6f1">
                            <path d="M16.5 23c-.6 0-1.2-.2-1.7-.5l-13-7.7c-.9-.6-1.5-1.5-1.7-2.6-.2-1 0-2.1.6-3 .3-.3.8-.8 1.1-1l13-7.7c1.1-.7 2.5-.6 3.6.1 1 .8 1.6 1.9 1.6 3.2v15.4c0 1.2-.6 2.4-1.6 3.2-.6.4-1.2.6-1.9.6zm-13.1-12.2l-.2.2c-.2.2-.2.5-.2.7s.2.5.4.6l12.9 7.7c.1.1.2.1.3 0 .2-.2.3-.4.3-.7v-15.5c0-.3-.1-.6-.4-.7.1-.1-.1-.1-.2-.1l-12.9 7.8z"></path>
                        </svg>
                    </button>
                    <button class="film-gallery__btn --next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="#30a6f1">
                            <path d="M16.5 23c-.6 0-1.2-.2-1.7-.5l-13-7.7c-.9-.6-1.5-1.5-1.7-2.6-.2-1 0-2.1.6-3 .3-.3.8-.8 1.1-1l13-7.7c1.1-.7 2.5-.6 3.6.1 1 .8 1.6 1.9 1.6 3.2v15.4c0 1.2-.6 2.4-1.6 3.2-.6.4-1.2.6-1.9.6zm-13.1-12.2l-.2.2c-.2.2-.2.5-.2.7s.2.5.4.6l12.9 7.7c.1.1.2.1.3 0 .2-.2.3-.4.3-.7v-15.5c0-.3-.1-.6-.4-.7.1-.1-.1-.1-.2-.1l-12.9 7.8z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="film-gallery__bottom-content dragscroll">
                <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__big-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
                <div class="wrap">
                    <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__middle-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
                    <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__middle-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
                </div>
                <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__middle-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
                <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__middle-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
                <a href="img/posters/1d5491e6b2e4107880accec6815b4f29.jpg" class="film-gallery__middle-image" style="background-image: url('img/posters/1d5491e6b2e4107880accec6815b4f29.jpg')"></a>
            </div>
        </div>
    </div>
</section>