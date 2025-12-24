<?php get_header(); ?>

<section id="banners" class="relative overflow-hidden">
    <div class="banner-slider">
        <?php
        $banners = new WP_Query(['post_type' => 'banner', 'posts_per_page' => 5]);
        while ($banners->have_posts()):
            $banners->the_post(); ?>
            <div class="relative h-[96vh] w-full aspect-video">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                <div class="absolute inset-0 flex items-center px-12">
                    <h2 class="text-white text-6xl font-bold uppercase"><?php the_title(); ?></h2>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>

    <div id="banner-dots-container" class="absolute bottom-0 left-0 w-full flex items-end"></div>
</section>

<section id="list-cars" class="py-16 overflow-hidden">
    <div class="text-[28px] uppercase mb-24 container">
        OUR MODELS
    </div>
    <div class="car-list-slider">
        <?php
        $cars = new WP_Query(['post_type' => 'car', 'posts_per_page' => -1]);
        while ($cars->have_posts()):
            $cars->the_post();
            $logo = get_field('logo');
            ?>
            <div class="px-8 transition-all duration-700 car-slide-item">
                <div class="relative flex flex-col items-center">

                    <div class="car-active-element opacity-0 transition-opacity duration-500 mb-16">
                        <?php if ($logo): ?>
                            <img src="<?= $logo; ?>" class="h-[17px] w-auto object-contain" alt="brand-logo">
                        <?php endif; ?>
                    </div>

                    <div class="car-img-container transition-all duration-700 ease-in-out">
                        <?php the_post_thumbnail('large', ['class' => 'w-full']); ?>
                    </div>

                    <div class="car-active-element mt-12 opacity-0 transition-opacity duration-500">
                        <a href="<?php the_permalink(); ?>"
                            class="flex items-center  text-jhl-gray-1 font-semibold text-xs !no-underline ">
                            <span>Telusuri <?php the_title(); ?></span>
                            <div class="relative flex items-center ml-4">
                                <img src="<?php echo get_template_directory_uri() ?>/images/arrow.png" alt="">
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
</section>

<section class="bg-jhl-gray-1 text-white relative flex justify-between">

    <div class="container py-14">
        <h3 class="max-w-[349px] text-4xl leading-[39px] mb-4">
            BUAT JANJI TEST DRIVE ANDA
        </h3>
        <a href=""
            class="border border-white rounded-full px-7 py-[18.5px] inline-flex items-center space-x-4 text-xs font-semibold tracking-wider">
            <span>Hubungi Kami</span>
            <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="">
        </a>
    </div>
    <div class="right-0 absolute h-full">
        <img src="<?php echo get_template_directory_uri() ?>/images/dashboard-car.png"
            class="h-full w-auto object-contain" alt="">
    </div>
</section>



<section class="py-20 bg-beijing-black" id="promotions">
    <div class="container">
        <h2 class="text-[28px] md:text-[44px] mb-8 text-white">
            PROMOTIONS
        </h2>
        <div class="grid md:grid-cols-5 gap-6">
            <?php
            $promo_query = new WP_Query([
                'post_type' => 'promotion', // Change to your CPT slug
                'posts_per_page' => 5,
            ]);

            if ($promo_query->have_posts()):
                while ($promo_query->have_posts()):
                    $promo_query->the_post(); ?>
                    <div>
                        <div class="mb-8">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'rounded-lg w-full h-auto']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/promo-1.png" alt="" class="rounded-lg">
                            <?php endif; ?>
                        </div>
                        <h5 class="leading-[22px] font-medium mb-8 line-clamp-2 !text-white">
                            <?php the_title(); ?>
                        </h5>
                        <a href="<?php the_permalink(); ?>"
                            class="text-xs text-jhl-gray-1 font-semibold uppercase tracking-wide inline-flex space-x-[10px] items-center">
                            <div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/chev-right.png" alt="">
                            </div>
                            <span>Learn More</span>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<section class="py-[100px] text-jhl-gray-1" id="dealers">
    <div class="container">
        <div class="text-center mb-10 flex justify-between items-center">
            <h2 class="text-[28px] font-light">
                FIND A DEALER
            </h2>
            <a href="<?php echo get_post_type_archive_link('dealer'); ?>"
                class="inline-flex items-center space-x-[10px] text-sm font-semibold text-jhl-gray-2 ">
                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/chev-right.png" alt="">
                </div>
                <span>TELUSURI</span>
            </a>
        </div>
        <div class="grid md:grid-cols-4 gap-4">
            <?php
            $dealer_query = new WP_Query([
                'post_type' => 'dealer', // Change to your CPT slug
                'posts_per_page' => 4,
            ]);

            if ($dealer_query->have_posts()):
                while ($dealer_query->have_posts()):
                    $dealer_query->the_post(); ?>
                    <div>
                        <div class="mb-4">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'rounded-lg h-[318px] object-cover w-full']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/alsut.png" alt=""
                                    class="rounded-lg h-[318px] object-cover w-full">
                            <?php endif; ?>
                        </div>
                        <h4 class="leading-7 text-xl mb-4 text-jhl-black">
                            <?php the_title(); ?>
                        </h4>
                        <div class="body">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<section id="socials">

</section>


<?php get_footer();


