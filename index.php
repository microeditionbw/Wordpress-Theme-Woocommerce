<?php get_header(); ?>
<div class="main-header-backgroud">
               <div class="titles">
               <div class="titles__first">
                  <?php echo get_theme_mod( 'setting_welcome', '123' ); ?>
               </div>
               <h1><?php printf( esc_html__( '%s', 'textdomain' ), get_bloginfo ( 'description' ) ); ?></h1>
               <a class="button anchor" href="#whywe">Далее</a>
            </div>
</div>
      <section id="services">
         <div id="whywe"></div>
         <div class="container">
            <div class="title">
               <h2>
                  Почему мы?
               </h2>
               <p>
                  Мы ценим ваш выбор!
               </p>
            </div>
            <div class="services clearfix">
               <div class="services__item">
                  <img src="<?php echo get_template_directory_uri()?>/assets/images/icon1.png" alt="Услуга">
                  <h3>Качество</h3>
                  <p>
                     Все изделия выполнены исключительно из натуральной кожи.
                  </p>
               </div>
               <div class="services__item">
                  <img src="<?php echo get_template_directory_uri()?>/assets/images/icon2.png" alt="Услуга">
                  <h3>Онлайн</h3>
                  <p>
                     Вы можете позвонить нам, и заказать понравившееся иделие или изделие под заказ!
                  </p>
               </div>
               <div class="services__item">
                  <img src="<?php echo get_template_directory_uri()?>/assets/images/icon3.png" alt="Услуга">
                  <h3>Гарантия сделки</h3>
                  <p>
                     Мы вышлем изделие почтой, вы получите и проверите, в случае успеха совершается сделка.
                  </p>
               </div>
            </div>
         </div>
      </section>
      <section id="portfolio">
         <div class="my-5 text-center container">
            <div class="title">
               <h2>
                  Портфолио
               </h2>
               <p>
                  Последние работы
               </p>
            </div>
            <!-- Top content -->
            <div class="container-fluid">
<?php echo do_shortcode('[woo_product_slider id="67"]'); ?>
               <div class="more-portfolio">
                  <p>
                     <a href="http://wordpress/shop/">Смотреть все</a>
                  </p>
               </div>
            </div>
         </div>
      </section>
      <section id="contact">
         <div class="container">
            <div class="title">
               <h2>
                  Напишите нам
               </h2>
               <p>
                  Мы вам ответим!
               </p>
            </div>
            <div class="row">
               <div class="col-md-8">
                  <form method="post">
                     <input class="form-control" name="name" placeholder="Имя..." /><br />
                     <input class="form-control" name="phone" placeholder="Телефон..." /><br />
                     <input class="form-control" name="email" placeholder="E-mail..." /><br />
                     <textarea class="form-control" name="text" placeholder="Чем мы можем вам помочь?" style="height:150px;"></textarea><br />
                     <input class="btn btn-primary" type="submit" value="Отправить" /><br /><br />
                  </form>
               </div>
               <div class="col-md-4">
                  <b>Информация мастера:</b> <br />
                  Телефон: <a href="tel:5551234567">8 (978) 8432707</a><br />
                  Instagram: <a href="https://www.instagram.com/armenshakhnazarian71/">Перейти</a><br />
                  Звонить с 10:00 - 17:00
                  <br /><br />
                  Golden skin org., <br />
                  Республика Крым,<br />
                  город Ялта.<br />
                  <a href="mailto:#">почта</a><br />
               </div>
            </div>
         </div>
      </section>
<?php
get_footer();
