<section id="product" class="container">
	<div class="row">
        <nav id="bread-crumbs" class="col-12">
            <ul>
                <li><a href=""><span>Каталог</span></a></li>
                <li><a href=""><span>Обувь</span></a></li>
                <li><a href=""><span>Ботинки</span></a></li>
            </ul>
        </nav>
		<h1 class="col-12">Название продаваемого товара</h1>
        <div class="product-thumb col-md-12 col-lg-4">
            <div class="owl-carousel">
                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test1.jpg'>">
                    <a href="/assets/media/product/product-test1.jpg" data-fancybox='images-123'>
                        <img src="/assets/media/product/product-test1.jpg" class="object-position-y-top" alt="">
                    </a>
                </div>

                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test.jpg' alt=''>">
                    <a href="/assets/media/product/product-test.jpg" data-fancybox="images-123">
                        <img src="/assets/media/product/product-test.jpg" class="object-position-y-top">
                    </a>
                </div>

                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test1.jpg'>">
                    <a href="/assets/media/product/product-test1.jpg" data-fancybox='images-123'>
                        <img src="/assets/media/product/product-test1.jpg" class="object-position-y-top" alt="">
                    </a>
                </div>

                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test.jpg' alt=''>">
                    <a href="/assets/media/product/product-test.jpg" data-fancybox="images-123">
                        <img src="/assets/media/product/product-test.jpg" class="object-position-y-top">
                    </a>
                </div>

                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test.jpg' alt=''>">
                    <a href="/assets/media/product/product-test.jpg" data-fancybox="images-123">
                        <img src="/assets/media/product/product-test.jpg" class="object-position-y-top">
                    </a>
                </div>

                <div class="product-thumb-img item" data-dot="<img src='/assets/media/product/product-test.jpg' alt=''>">
                    <a href="/assets/media/product/product-test.jpg" data-fancybox="images-123">
                        <img src="/assets/media/product/product-test.jpg" class="object-position-y-top">
                    </a>
                </div>

            </div>
        </div>

<!--        в этом блоке подтягиваются основные характеристики товара, который указал продавец при размещении-->
        <div class="product-description col-md-12 col-lg-5">
            <div class="product-spec flex">
                <div class="prod-spec-item">
                    <span class="prod-spec-name">Размер:</span>
                    <a href=""><span>45</span></a>
                </div>

                <div class="prod-spec-item">
                    <span class="prod-spec-name">Состояние:</span>
                    <span>б/у</span>
                </div>

                <div class="prod-spec-item">
                    <span class="prod-spec-name">Цвет:</span>
                    <span>коричневый</span>
                </div>

                <div class="prod-spec-item">
                    <span class="prod-spec-name">Бренд:</span>
                    <a href=""><span>Zara</span></a>
                </div>

                <div class="prod-spec-item">
                    <span class="prod-spec-name">Состав:</span>
                    <span>100% котон</span>
                </div>

            </div>

            <div class="prod-desc">
                <h4>Описание товара</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, illo quis. Accusamus, animi cum dignissimos doloremque doloribus, dolorum eligendi enim facilis illum impedit ipsum possimus praesentium quasi quo repellat voluptates.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aspernatur beatae cum dolore facere fuga impedit labore laudantium maxime neque possimus quas quis quos sapiente sit, tempore veniam voluptate. Officia?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam asperiores atque cumque debitis est fugiat illo illum iste itaque labore nisi nostrum pariatur perferendis quasi, quibusdam quos, recusandae ullam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, ea eaque est facilis harum illum iusto modi non tenetur voluptate? Animi commodi esse expedita iure officia quod rem similique tenetur?
                </p>
            </div>
        </div>

        <div class="product-basic-block col-md-12 col-lg-3">
            <div class="product-price flex">
                <span class="price-number">2 300</span>
                <span class="price-currency">грн.</span>
            </div>
            <div class="button-buy">
                <div class="flex">
<!--                    при клике открывает страницу переписки с продавцом-->
                    <a href="" class="button-for-buy flex align-center">Написать продавцу</a>
<!--                    добавляет товар в избранное пользователя-->
                    <a href="" class="button-for-like flex align-center" title="Добавить вещь в избранное"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                <span class="button-buy-info">Чтобы купить этот товар, тебе нужно связаться с продавцом. </span>
            </div>
            <div class="product-seller-info flex flex-column align-center">
                <div class="product-seller-photo">
                    <img src="/assets/media/default-user.png" alt="">
                </div>
                <a href=""><span class="login-seller">login-prodavca</span></a>
                <span class="seller-from">Черкассы</span>
                <span class="last-seen">был на сайте 3 часа назад</span>
            </div>
        </div>

<!--        этот блок отображается,только в том случае, если у продавца больше чем один товар. в этом блоке не нужно отображать товар, который сейчас открыт на странице-->
        <div class="other-product-seller col-12">
            <h2>Другие товары <a href="/">login-prodavca</a>:</h2>
        </div>


        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

<!--        эта кнопка отображается, только если у продавца, больше чем 6 товаров-->

        <div class="col-12 all-other-product-seller flex justify-content-end">
            <a href="">Все товары продавца</a>
        </div>



        <div class="similar-product col-12">
            <h2>Похожие товары:</h2>
        </div>


        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

        <div class="product-item-on-grid col-6 col-sm-6 col-md-3 col-xl-2">
            <a href="/product">
                <div class="img-wrap-on-grid">
                    <img src="/assets/media/product/product-test.jpg" alt="" class="item-min">
                    <div class="img-wrap-on-grid-hover">
                        <span>Zara</span>
                        <span>Размер: 45</span>
                    </div>
                </div>
                <div class="product-item-on-grid-desc">
                    <h3>Название продаваемого товара</h3>
                    <span class="price">200 грн.</span>
                </div>
            </a>
        </div>

	</div>
</section>