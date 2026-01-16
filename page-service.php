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
?>

<section class="py-28 container">
    <img src="<?php echo get_template_directory_uri() ?>/images/map.png" class="mx-auto w-full" alt="">
</section>

<section class="pb-28 container !md:px-0">
    <h2 class="text-center uppercase mb-14">Authorized Dealers</h2>
    <div class="grid md:grid-cols-4 gap-16 md:gap-4">
        <?php
        if (!empty($external_dealers) && is_array($external_dealers)):
            foreach ($external_dealers as $dealer):
                // Extracting data from the REST API object
                $title = $dealer->title->rendered;

                // ACF fields usually reside in the 'acf' key in REST API
                $dealer_acf = $dealer->acf;
                $address = isset($dealer_acf->address) ? $dealer_acf->address : '';
                $business_hours = isset($dealer_acf->business_hours) ? $dealer_acf->business_hours : '';
                $whatsapp = isset($dealer_acf->whatsapp) ? $dealer_acf->whatsapp : '#';
                $phone = isset($dealer_acf->phone) ? $dealer_acf->phone : '#';
                $location = isset($dealer_acf->location) ? $dealer_acf->location : '#';

                // Get featured image from _embedded if available
                $image_url = get_template_directory_uri() . '/images/alsut.png'; // Fallback
                if (!empty($dealer->_embedded->{'wp:featuredmedia'}[0]->source_url)) {
                    $image_url = $dealer->_embedded->{'wp:featuredmedia'}[0]->source_url;
                }
                ?>
                <div>
                    <div class="mb-[30px]">
                        <img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>"
                            class="rounded-lg h-[282px] object-cover w-full">
                    </div>
                    <h5 class="mb-5 tracking-wider !text-jhl-black">
                        <?php echo $title; ?>
                    </h5>
                    <p class="body mb-4 !text-jhl-gray-1">
                        <?php echo $address; ?>
                    </p>
                    <div class="body text-jhl-black mb-10 h-24">
                        <span class="font-bold">Business Hours:</span>
                        <div class="mt-1">
                            <?php echo nl2br(wp_kses_post($business_hours)); ?>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <a href="<?php echo $whatsapp; ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/WhatsApp.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                        <a href="<?php echo $phone; ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/Phone.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                        <a href="<?php echo $location; ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/Location.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                    </div>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</section>

<section class="py-20 relative min-h-screen md:min-h-auto md:h-[615px]">
    <div class="absolute left-0 top-0 w-full h-[80%] bg-gradient-to-b from-jhl-black to-transparent z-[5] opacity-70">
    </div>
    <div class="absolute left-0 top-0 w-full h-full z-0">
        <img src="<?php echo get_template_directory_uri() ?>/images/armada.png" class="h-full w-full object-cover"
            alt="">
    </div>
    <div class="container text-white flex flex-col md:flex-row justify-between relative z-10">
        <div class="mb-14 md:mb-0">
            <h2 class="mb-4">Armada Bisnis</h2>
            <p class="body mb-9">Solusi lengkap kebutuhan perusahaan Anda</p>
            <a href="javascript:void(0)" id="open-contact"
                class="border border-white hover:bg-white/20 transition duration-500 rounded-full px-7 py-[18.5px] inline-flex items-center space-x-4 text-xs font-semibold tracking-wider">
                <span>Hubungi Kami</span>
                <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="">
            </a>
        </div>
        <div class="max-w-[588px]">
            Kami menyediakan layanan pengadaan dan pengelolaan unit yang dirancang khusus untuk berbagai kebutuhan
            bisnis Anda. Dengan layanan personal melalui Account Manager khusus, dapatkan satu titik kontak untuk
            menjawab seluruh kebutuhan Anda. Dari pemilihan unit, kustomisasi, koordinasi servis, hingga penawaran harga
            korporat yang lebih kompetitif.
            <br /><br />
            Hubungi tim kami untuk mengetahui paket, manfaat, dan skema pembiayaan yang
            paling sesuai dengan operasional bisnis Anda.
        </div>
    </div>
</section>

<section class="py-20 container" id="services">
    <h2 class="mb-7">LAYANAN</h2>
    <?php
    $services_args = array(
        'post_type' => 'service',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    $services_query = new WP_Query($services_args);

    if ($services_query->have_posts()):
        ?>
        <div class="py-9">
            <ul class="flex border-b whitespace-nowrap overflow-auto scroll-m-2 border-jhl-gray-3 service-tabs">
                <?php
                $count = 0;
                while ($services_query->have_posts()):
                    $services_query->the_post();
                    ?>
                    <li class="pb-4 mx-10 whitespace-nowrap text-beijing-black first:ml-0 cursor-pointer service-tab <?php echo $count === 0 ? 'border-b border-jhl-black font-semibold' : ''; ?>"
                        data-target="service-<?php the_ID(); ?>">
                        <?php the_title(); ?>
                    </li>
                    <?php
                    $count++;
                endwhile;
                ?>
            </ul>
        </div>

        <div class="service-contents">
            <?php
            $count = 0;
            $services_query->rewind_posts();
            while ($services_query->have_posts()):
                $services_query->the_post();
                $acf_title = get_field('title');
                $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                ?>
                <div id="service-<?php the_ID(); ?>"
                    class="service-content grid md:grid-cols-2 items-center md:gap-20 <?php echo $count === 0 ? '' : 'hidden'; ?>">
                    <div class="mb-14 md:mb-0">
                        <img src="<?php echo $featured_img; ?>" alt="<?php the_title(); ?>" class="w-full h-auto rounded-lg">
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-8 md:max-w-[247px] text-beijing-black"><?php echo $acf_title; ?></h4>
                        <div class="body">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php
                $count++;
            endwhile;
            ?>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                $('.service-tab').on('click', function () {
                    var target = $(this).data('target');

                    // Update tabs
                    $('.service-tab').removeClass('border-b border-jhl-black font-semibold');
                    $(this).addClass('border-b border-jhl-black font-semibold');

                    // Update content
                    $('.service-content').addClass('hidden');
                    $('#' + target).removeClass('hidden');
                });

                // 1. Open Popup
                $('#open-contact').on('click', function (e) {
                    e.preventDefault();
                    $('#contact-popup').removeClass('hidden').addClass('flex');
                    $('body').addClass('overflow-hidden'); // Prevent background scrolling
                });

                // 2. Function to Close Popup
                function closePopup() {
                    $('#contact-popup').addClass('hidden').removeClass('flex');
                    $('body').removeClass('overflow-hidden');
                }

                // Close via 'X' button
                $('#close-contact').on('click', function () {
                    closePopup();
                });

                // Close via clicking the dark overlay background
                $('#close-overlay').on('click', function () {
                    closePopup();
                });
            });
        </script>

        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</section>

<div id="contact-popup" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/70" id="close-overlay"></div>

    <div class="relative bg-white w-full max-w-6xl  py-8 px-24 shadow-2xl border-jhl-gray-3 border-5 z-10">
        <button id="close-contact" class="absolute top-4 right-4 text-white/50 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="text-[28px] mb-12 uppercase">ARMADA BISNIS FORM</div>

        <div class="cf7-popup-wrapper td-form">
            <?php echo do_shortcode('[contact-form-7 id="be408c9" title="ARMADA BISNIS FORM"]'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>