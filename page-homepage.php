<?php get_header(); ?>
<?php
// 1. Try to get the data from the cache (transient) first
$cache_key = 'external_dealers_data';
$external_dealers = get_transient($cache_key);

// 2. If the cache is empty, fetch the data from the API
if (false === $external_dealers) {
    $source_url = 'https://jhl-auto.codeomnia.com/wp-json/wp/v2/dealers?_embed&per_page=4&orderby=date&order=asc';
    $response = wp_remote_get($source_url, ['timeout' => 10]);

    if (!is_wp_error($response)) {
        $external_dealers = json_decode(wp_remote_retrieve_body($response));

        // 3. Save the data to cache for 1 hour (3600 seconds)
        set_transient($cache_key, $external_dealers, 3600);
    }
}
delete_transient('external_promotions_data');
$promo_cache_key = 'external_promotions_data';
$external_promotions = get_transient($promo_cache_key);

// If cache is empty, fetch from API
if (false === $external_promotions) {
    // orderby=date & order=asc to keep oldest to newest as requested previously
    $promo_url = 'https://jhl-auto.codeomnia.com/wp-json/wp/v2/promotions?_embed&per_page=5&orderby=date&order=asc';
    $promo_response = wp_remote_get($promo_url, ['timeout' => 15]);

    if (!is_wp_error($promo_response)) {
        $external_promotions = json_decode(wp_remote_retrieve_body($promo_response));
        set_transient($promo_cache_key, $external_promotions, 3600); // Cache for 1 hour
    }
}
?>
<section id="banners" class="relative overflow-hidden">
    <div class="banner-slider zoom-blur-out" data-scroll data-scroll-class="is-inview">
        <?php
        $banners = new WP_Query(['post_type' => 'banner', 'posts_per_page' => 5]);
        while ($banners->have_posts()):
            $banners->the_post(); ?>
            <div class=" relative h-fit md:h-[96vh] max-h-[780px] w-full">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover aspect-video']); ?>

            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>

    <div id="banner-dots-container" class="absolute bottom-0 left-0 w-full flex items-end"></div>
</section>

<section id="list-cars" class="py-16 overflow-hidden">
    <div class="text-[28px] uppercase mb-16 md:mb-24 container text-jhl-gray-1 fade-down" data-scroll
        data-scroll-class="is-inview">
        OUR MODELS
    </div>
    <div class="car-list-slider fade-up" data-scroll data-scroll-class="is-inview">
        <?php
        $cars = new WP_Query(['post_type' => 'car', 'posts_per_page' => -1]);
        while ($cars->have_posts()):
            $cars->the_post();
            $logo = get_field('logo');
            ?>
            <div class="px-0 md:px-8 car-slide-item">
                <div class="relative flex flex-col items-center">

                    <div class="car-active-element opacity-0 transition-opacity duration-500 mb-0 md:mb-16">
                        <?php if ($logo): ?>
                            <img src="<?= $logo; ?>" class="h-[17px] w-auto object-contain" alt="brand-logo">
                        <?php endif; ?>
                    </div>

                    <div class="car-img-container">
                        <?php the_post_thumbnail('large', ['class' => 'w-full']); ?>
                    </div>

                    <div class="car-active-element -mt-12 md:mt-12 opacity-0 z-10 relative transition-opacity duration-500">
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

<section class="bg-jhl-gray-1 text-white relative block md:flex justify-between">

    <div class="container py-14">
        <h3 class="max-w-[349px] text-4xl leading-[39px] mb-4 fade-right" data-scroll data-scroll-class="is-inview">
            BUAT JANJI TEST DRIVE ANDA
        </h3>
        <a href="javascript:void(0)" id="open-contact"
            class="border border-white hover:bg-white/30 transition duration-500 rounded-full px-7 py-[18.5px] inline-flex items-center space-x-4 text-xs font-semibold tracking-wider fade-right"
            data-scroll data-scroll-class="is-inview" data-scroll-delay="400ms">
            <span>Hubungi Kami</span>
            <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="">
        </a>
    </div>
    <div class="right-0 static md:absolute h-full fade-left" data-scroll data-scroll-class="is-inview"
        data-scroll-delay="400ms">
        <img src="<?php echo get_template_directory_uri() ?>/images/dashboard-car.png"
            class="h-full w-auto object-contain" alt="">
    </div>
</section>

<div id="contact-popup" class="fixed inset-0 z-[100]  hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/70" id="close-overlay"></div>

    <div
        class="relative bg-white w-full max-w-6xl max-h-[90vh] overflow-y-auto px-4 py-8 md:px-24 shadow-2xl border-jhl-gray-3 border-5 z-10">
        <button id="close-contact" class="absolute top-4 right-4 text-white/50 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="text-[28px] mb-10 uppercase">TEST DRIVE FORM</div>

        <div class="cf7-popup-wrapper td-form">
            <?php echo do_shortcode('[contact-form-7 id="4fa6cd3" title="Test Drive Form"]'); ?>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {

        // 1. Open Popup
        jQuery(document).on('click', '#open-contact', function (e) {
            e.preventDefault();
            jQuery('#contact-popup').removeClass('hidden').addClass('flex');
            jQuery('body').addClass('overflow-hidden');
        });

        // 2. Close Popup
        function closePopup() {
            jQuery('#contact-popup').addClass('hidden').removeClass('flex');
            jQuery('body').removeClass('overflow-hidden');
        }

        jQuery(document).on('click', '#close-contact, #close-overlay', function () {
            closePopup();
        });
    });
</script>


<section class="py-20 bg-beijing-black" id="promotions">
    <div class="container">
        <h2 class="text-[28px] md:text-[44px] mb-8 text-white fade-down" data-scroll data-scroll-class="is-inview">
            PROMOTIONS
        </h2>
        <div class="flex -mr-4 md:mr-0 overflow-auto md:grid md:grid-cols-5 gap-6">
            <?php if (!empty($external_promotions) && is_array($external_promotions)): ?>
                <?php foreach ($external_promotions as $index => $promo):
                    $title = $promo->title->rendered;
                    $permalink = $promo->link;

                    $delay = ($index * 100) . 'ms';

                    // Get Featured Image
                    $image_url = '';
                    if (!empty($promo->_embedded->{'wp:featuredmedia'}[0]->source_url)) {
                        $image_url = $promo->_embedded->{'wp:featuredmedia'}[0]->source_url;
                    }
                    ?>
                    <div class="w-[75%] md:w-full shrink-0 fade-right" data-scroll data-scroll-class="is-inview"
                        data-scroll-delay="<?php echo $delay; ?>">
                        <div class="mb-8">
                            <?php if ($image_url): ?>
                                <img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr($title); ?>"
                                    class="rounded-lg w-full h-auto">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/promo-1.png" alt="" class="rounded-lg">
                            <?php endif; ?>
                        </div>

                        <h5 class="leading-[22px] font-medium mb-6 line-clamp-2 !text-white">
                            <?php echo $title; ?>
                        </h5>

                        <a href="<?php echo esc_url($permalink); ?>"
                            class="text-xs text-jhl-gray-1 font-semibold uppercase tracking-wide inline-flex space-x-[10px] items-center">
                            <div>
                                <img src="<?php echo get_template_directory_uri() ?>/images/chev-right.png" alt="">
                            </div>
                            <span>Learn More</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-white opacity-50">No promotions currently available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-14 md:py-[100px] text-jhl-gray-1" id="dealers">
    <div class="container">
        <div class="md:text-center mb-10 block md:flex justify-between items-center">
            <h2 class="text-[28px] font-light mb-9 md:mb-0 fade-down" data-scroll data-scroll-class="is-inview">FIND A
                DEALER</h2>
            <a href="/service"
                class="inline-flex items-center space-x-[10px] text-sm font-semibold text-jhl-gray-2 fade-right"
                data-scroll data-scroll-class="is-inview" data-scroll-delay="400ms">
                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/chev-right.png" alt="">
                </div>
                <span>TELUSURI</span>
            </a>
        </div>
    </div>


    <div class="flex container pr-0 md:pr-4 overflow-auto md:grid md:grid-cols-4 gap-4">
        <?php if (!empty($external_dealers) && is_array($external_dealers)): ?>
            <?php foreach ($external_dealers as $index => $post):
                $title = $post->title->rendered;
                $excerpt = $post->content->rendered;
                $address = $post->acf->address ?? '';

                $delay = ($index * 100) . 'ms';

                // Get Featured Image from embedded data
                $image_url = '';
                if (!empty($post->_embedded->{'wp:featuredmedia'}[0]->source_url)) {
                    $image_url = $post->_embedded->{'wp:featuredmedia'}[0]->source_url;
                }
                ?>
                <div class="w-[75%] md:w-full shrink-0 fade-right" data-scroll data-scroll-class="is-inview"
                    data-scroll-delay="<?php echo $delay; ?>">
                    <div class="mb-4">
                        <?php if ($image_url): ?>
                            <img src="<?php echo $image_url; ?>" class="rounded-lg h-[318px] object-cover w-full"
                                alt="<?php echo esc_attr($title); ?>">
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/alsut.png"
                                class="rounded-lg h-[318px] object-cover w-full" alt="">
                        <?php endif; ?>
                    </div>

                    <h4 class="leading-7 text-xl mb-4 text-jhl-black">
                        <?php echo $title; ?>
                    </h4>

                    <p class="body text-jhl-gray-2 leading-relaxed">
                        <?php echo esc_html($address); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-span-4 text-center">Unable to load dealers at this time.</p>
        <?php endif; ?>
    </div>
</section>
<section class="py-20 bg-beijing-black" id="socials">
    <div class="container">
        <h2 class="text-[28px] uppercase md:text-[44px] mb-8 text-white fade-down" data-scroll
            data-scroll-class="is-inview">
            Socials
        </h2>
    </div>
</section>


<?php get_footer();


