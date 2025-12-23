<?php get_header(); ?>

<section id="banners" class="relative overflow-hidden">
    <div class="banner-slider">
        <?php
        $banners = new WP_Query(['post_type' => 'banner', 'posts_per_page' => 5]);
        while ($banners->have_posts()):
            $banners->the_post(); ?>
            <div class="relative h-[96vh] w-full">
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

<section id="promotions">

</section>

<section id="dealers">

</section>

<section id="socials">

</section>


<?php get_footer();


