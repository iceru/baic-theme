<?php get_header(); ?>

<?php
while (have_posts()):
    the_post();
    $car_id = get_the_ID();

    $banners = get_field('car_banner');
    $colors = get_field('colors');
    $price = get_field('price');
    $specs = get_field('car_specification');
    $accessories = get_field('accessories');
    ?>

    <main class="single-car-template">

        <section id="banner" class="relative overflow-hidden">
            <div class="banner-slider-main zoom-blur-out" data-scroll data-scroll-class="is-inview">
                <?php if ($banners):
                    foreach ($banners as $banner):
                        $banner_img = get_the_post_thumbnail_url($banner->ID, 'full');
                        ?>
                        <div class="relative w-full aspect-video">
                            <?php if ($banner_img): ?>
                                <img src="<?php echo esc_url($banner_img); ?>" alt="<?php echo esc_attr($banner->post_title); ?>"
                                    class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                    <?php endforeach;
                else: ?>
                    <div class="relative w-full aspect-video bg-jhl-gray-3 flex items-center justify-center">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div id="banner-dots-container" class="absolute bottom-0 left-0 w-full flex items-end"></div>
        </section>

        <section id="colors" class="py-20 bg-white">
            <div class="container">
                <div class="flex items-center justify-between mb-16">
                    <div class="hidden md:block fade-left" data-scroll data-scroll-class="is-inview"
                        data-scroll-delay="200ms">
                        <img src="<?php echo esc_url(get_field('logo')); ?>" alt="">
                    </div>
                    <div></div>
                </div>
                <div class="flex justify-center md:hidden mb-4">
                    <img class="h-3.5" src="<?php echo esc_url(get_field('logo')); ?>" alt="">
                </div>
                <div class="color-display-container max-w-5xl mx-auto mb-12 fade-up" data-scroll
                    data-scroll-class="is-inview" data-scroll-delay="400ms">
                    <?php if ($colors):
                        foreach ($colors as $index => $color):
                            $featured_img = get_the_post_thumbnail_url($color->ID, 'full');
                            $right_side = get_field('right_side', $color->ID);
                            $back_side = get_field('back_side', $color->ID);
                            ?>
                            <div id="color-content-<?php echo $color->ID; ?>"
                                class="color-content-item <?php echo $index === 0 ? 'block' : 'hidden'; ?>">
                                <div class="color-slick-slider">
                                    <?php if ($featured_img): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($featured_img); ?>"
                                                class="w-full h-[250px] md:h-[409px] object-contain rounded-lg" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($right_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($right_side); ?>"
                                                class="w-full h-[250px] md:h-[409px] object-contain rounded-lg" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($back_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($back_side); ?>"
                                                class="w-full h-[250px] md:h-[409px] object-contain rounded-lg" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="color-nav-slider mt-4 max-w-[600px] mx-auto">
                                    <?php if ($featured_img): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($featured_img); ?>"
                                                class="h-[100px] w-[138px] shrink-0 object-contain rounded-lg border border-jhl-gray-3 cursor-pointer"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($right_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($right_side); ?>"
                                                class="h-[100px] w-[138px] shrink-0 object-contain rounded-lg border border-jhl-gray-3 cursor-pointer"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($back_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($back_side); ?>"
                                                class="h-[100px] w-[138px] shrink-0 object-contain rounded-lg border border-jhl-gray-3 cursor-pointer"
                                                alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>

                <div class="flex flex-col items-center">
                    <div class="flex justify-center flex-wrap gap-6 color-swatches mb-6">
                        <?php if ($colors):
                            foreach ($colors as $index => $color):
                                $swatch_color = get_field('color', $color->ID);
                                $delay = ($index * 100) . 'ms';
                                ?>
                                <?php
                                $is_white = (trim(strtolower($swatch_color), '#') === 'ffffff' || trim(strtolower($swatch_color), '#') === 'fff' || strtolower($swatch_color) === 'white');
                                $active_border = $is_white ? '#000000' : $swatch_color;
                                ?>
                                <div class="flex flex-col items-center group cursor-pointer color-swatch-trigger fade-up <?php echo $index === 0 ? 'is-active' : ''; ?>"
                                    data-target="color-content-<?php echo $color->ID; ?>"
                                    data-color-name="color-name-<?php echo $color->ID; ?>"
                                    data-swatch-color="<?php echo esc_attr($swatch_color); ?>" data-scroll
                                    data-scroll-class="is-inview" data-scroll-delay="<?php echo $delay; ?>">
                                    <div class="w-6 h-6 rounded-full border p-[2px] transition-all"
                                        style="background-color: <?php echo esc_attr($swatch_color); ?>; background-clip: content-box; border: 1px solid <?php echo $index === 0 ? esc_attr($active_border) : '#ccc'; ?>;">
                                    </div>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>

                    <div class="color-names-container relative h-4 w-full fade-up" data-scroll data-scroll-class="is-inview"
                        data-scroll-delay="500ms">
                        <?php if ($colors):
                            foreach ($colors as $index => $color): ?>
                                <span id="color-name-<?php echo $color->ID; ?>"
                                    class="color-name absolute left-1/2 -translate-x-1/2 top-0 text-jhl-gray-1  text-center transition-opacity duration-300 <?php echo $index === 0 ? 'opacity-100' : 'opacity-0'; ?>">
                                    <?php echo $color->post_title; ?>
                                </span>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Price Section -->
        <section id="price" class="pb-16">
            <div class="container ">
                <p class="body text-jhl-gray-1 mb-2 fade-up text-center" data-scroll data-scroll-class="is-inview">Start
                    from</p>
                <div class="mx-auto w-fit">
                    <div class="md:text-5xl font-semibold text-jhl-black text-4xl fade-up text-center" data-scroll
                        data-scroll-class="is-inview" data-scroll-delay="200ms">
                        <?php echo $price ? $price : 'Contact for Price'; ?>
                    </div>
                    <p class="text-[10px] italic text-jhl-gray-1 mx-auto tracking-widest mt-4 fade-up" data-scroll
                        data-scroll-class="is-inview" data-scroll-delay="400ms">
                        *Price OTR Jakarta <br />
                        *Terms & conditions apply <br />
                        *CKD Unit Only <br />
                    </p>
                </div>
        </section>

        <section class="bg-beijing-black text-white relative min-h-screen" id="specs">
            <div class="md:absolute left-0 top-0 h-[380px] w-full md:h-full md:w-[40%] fade-right" data-scroll
                data-scroll-class="is-inview">
                <?php $spec_image = get_field('specification_image'); ?>
                <img src="<?php echo $spec_image ? esc_url($spec_image) : get_template_directory_uri() . '/images/spec.png'; ?>"
                    alt="" class="w-full h-full object-top object-cover">
            </div>
            <div class="container flex py-16">
                <div class="hidden md:block w-[45%]"></div>
                <div class="w-full md:w-[55%]">

                    <h2 class="text-[28px] uppercase mb-14 leading-[30px] fade-down" data-scroll
                        data-scroll-class="is-inview">SPESIFIKASI</h2>

                    <?php
                    // $specs is the single Post Object defined at the top of your file
                    if ($specs):
                        // Access fields from the spec post using its ID
                        $length_width = get_field('length_width', $specs->ID);
                        $wheelbase = get_field('wheelbase', $specs->ID);
                        $fuel_tank_capacity = get_field('fuel_tank', $specs->ID);
                        $ground_clearance = get_field('ground_clearance', $specs->ID);
                        $luggage_capacity = get_field('luggage_capacity', $specs->ID);
                        $approach_angle = get_field('approach_angle', $specs->ID);
                        $departure_angle = get_field('departure_angle', $specs->ID);
                        $rampover_angle = get_field('rampover_angle', $specs->ID);
                        $displacement = get_field('displacement', $specs->ID);
                        $cylinder_configuration = get_field('cylinder_configuration', $specs->ID);
                        $emission_standard = get_field('emission_standard', $specs->ID);
                        $maximum_power = get_field('maximum_power', $specs->ID);
                        $maximum_torque = get_field('maximum_torque', $specs->ID);
                        $drivetrain = get_field('drivetrain', $specs->ID);
                        $transmission = get_field('transmission', $specs->ID);
                        $front_suspension = get_field('front_suspension', $specs->ID);
                        $rear_suspension = get_field('rear_suspension', $specs->ID);
                        ?>
                        <div class="mb-6 border-b border-white spec-item fade-up" data-scroll data-scroll-class="is-inview"
                            data-scroll-delay="100ms">
                            <button class="spec-toggle mb-6 text-xl w-full text-left flex justify-between items-center">
                                <span>Performance</span>
                                <span class="toggle inline-block transition-transform duration-300"
                                    style="transform: rotate(180deg);">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/toggle-2.svg" alt=""
                                        class="w-5 h-5">
                                </span>
                            </button>
                            <div class="spec-content space-y-6 body mt-2">
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Displacement
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $displacement; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Cylinder Configuration
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $cylinder_configuration; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Emission Standard
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $emission_standard; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Maximum Power
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $maximum_power; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Maximum Torque
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $maximum_torque; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Transmission
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $transmission; ?>
                                    </div>
                                </div>
                                <div class="flex mb-10">
                                    <div class="w-[60%]">
                                        Drivetrain
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $drivetrain; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6 border-b border-white spec-item fade-up" data-scroll data-scroll-class="is-inview"
                            data-scroll-delay="200ms">
                            <button class="spec-toggle mb-6 text-xl w-full text-left flex justify-between items-center">
                                <span>Dimension & Capability</span>
                                <span class="toggle inline-block transition-transform duration-300">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/toggle-2.svg" alt=""
                                        class="w-5 h-5">
                                </span>
                            </button>
                            <div class="spec-content space-y-6 body hidden mt-4">
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Length x Width x Height (mm)
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $length_width; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Wheelbase (mm)
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $wheelbase; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Fuel tank capacity (l)
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $fuel_tank_capacity; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Ground clearance (mm)
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $ground_clearance; ?>
                                    </div>
                                </div>
                                <div class="flex mb-10">
                                    <div class="w-[60%]">
                                        Luggage capacity (litres) *seats down
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $luggage_capacity; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6 spec-item fade-up" data-scroll data-scroll-class="is-inview" data-scroll-delay="300ms">
                            <button class="spec-toggle mb-6 text-xl w-full text-left flex justify-between items-center">
                                <span>Chassis & Engineering</span>
                                <span class="toggle inline-block transition-transform duration-300">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/toggle-2.svg" alt=""
                                        class="w-5 h-5">
                                </span>
                            </button>
                            <div class="spec-content space-y-6 body hidden mt-4">
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Front Suspension
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $front_suspension; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Rear Suspension
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $rear_suspension; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Approach Angle
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $approach_angle; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Departure Angle
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $departure_angle; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-[60%]">
                                        Rampover Angle
                                    </div>
                                    <div class="w-[40%]">
                                        <?php echo $rampover_angle; ?>
                                    </div>
                                </div>
                                <div class="flex mb-10">
                                    <div class="w-[60%]">
                                        4WD System
                                    </div>
                                    <div class="w-[40%]">
                                        <?php 
                                        $four_wd_system = get_field('4wd_system', $specs->ID);
                                        echo $four_wd_system ? $four_wd_system : $drivetrain;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-[422px] mt-24 text-jhl-gray-3 text-[10px] font-medium leading-[16px]">
                            Note* <br />
                            All information content is for advertising display purposes only and is for reference. The actual
                            vehicle shall prevail. BAIC reserves the right to modify the described vehicle models and is not
                            obligated to provide prior notice for the purposes of marketing or product promotion at any time.

                        </div>
                    <?php else: ?>
                        <p>No specifications available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <script>
            jQuery(document).ready(function ($) {
                jQuery('.spec-toggle').on('click', function () {
                    const $btn = jQuery(this);
                    const $parent = $btn.closest('.spec-item');
                    const $content = $parent.find('.spec-content');
                    const $icon = $btn.find('.toggle');

                    // 1. If we click an already open item, just close it
                    if ($parent.hasClass('is-open')) {
                        $content.slideUp(300);
                        $parent.removeClass('is-open');
                        $icon.css('transform', 'rotate(0deg)');
                    }
                    // 2. If we click a closed item, close others and open this one
                    else {
                        // Close all others
                        jQuery('.spec-content').slideUp(300);
                        jQuery('.spec-item').removeClass('is-open');
                        jQuery('.toggle').css('transform', 'rotate(0deg)');

                        // Open this one
                        $content.slideDown(300);
                        $parent.addClass('is-open');
                        $icon.css('transform', 'rotate(180deg)');
                    }
                });
            });
        </script>

        <section id="accessories" class="py-24 bg-white">
            <div class="container">
                <div class="flex justify-between items-center mb-24">
                    <h2 class="text-3xl uppercase fade-down" data-scroll data-scroll-class="is-inview">
                        Aksesoris
                    </h2>
                    <div class="fade-left" data-scroll data-scroll-class="is-inview" data-scroll-delay="200ms">
                        <img src="<?php echo esc_url(get_field('logo')); ?>" alt="">
                    </div>
                </div>

                <div class="flex justify-center mb-24 zoom-blur-in" data-scroll data-scroll-class="is-inview"
                    data-scroll-delay="300ms">
                    <img src="<?php echo get_field('acc_image'); ?>" class="max-h-[478px] w-auto" alt="">
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php if ($accessories):
                        foreach ($accessories as $index => $accessory):
                            $acc_img = get_the_post_thumbnail_url($accessory->ID, 'medium');
                            $delay = ($index * 100) . 'ms';
                            ?>
                            <div class="w-full rounded-xl border p-[18px] pb-7 border-jhl-gray-3 overflow-hidden fade-up"
                                data-scroll data-scroll-class="is-inview" data-scroll-delay="<?php echo $delay; ?>">
                                <h6 class="text-jhl-gray-1 mb-4 md:mb-10 font-medium">
                                    <?php echo get_field('name', $accessory->ID) ?>
                                </h6>
                                <?php if ($acc_img): ?>
                                    <div class="md:px-4 flex justify-center items-center max-h-[75px] md:h-[134px]">
                                        <img src="<?php echo esc_url($acc_img); ?>" alt="<?php echo get_field('name') ?>"
                                            class="w-full h-full  max-h-[75px] md:max-h-[134px] object-contain">
                                    </div>
                                <?php else: ?>
                                    <div class="text-jhl-gray-3 uppercase text-xs">No Image</div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </section>

        <section class="py-24 md:py-12 bg-jhl-gray-1" id="forms">
            <div class="container flex flex-col md:flex-row justify-center space-y-24 md:space-y-0 md:space-x-6">
                <div class="flex flex-col justify-center items-center fade-up" data-scroll data-scroll-class="is-inview">
                    <div class="mb-6">
                        <img src="<?php echo get_template_directory_uri() ?>/images/icons/steering.png" alt="test-drive">
                    </div>
                    <button id="btn-test-drive"
                        class="open-form-popup px-6 py-4 text-white  border border-white rounded-full hover:bg-white/10 transition duration-500 flex items-center space-x-4"
                        data-form="test-drive" data-title="TEST DRIVE FORM">
                        <span class="text-xs font-semibold">Reservasi Test Drive</span>
                        <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="arrow-white">
                    </button>
                </div>
                <div class="flex flex-col justify-center items-center fade-up" data-scroll data-scroll-class="is-inview"
                    data-scroll-delay="200ms">
                    <div class="mb-6">
                        <img src="<?php echo get_template_directory_uri() ?>/images/icons/brochure.png" alt="brochure">
                    </div>

                    <?php
                    // Fetch the ACF field (ensure the field name matches 'brochure-file')
                    $brochure_file = get_field('brochure_file');
                    if ($brochure_file): ?>
                        <a href="<?php echo esc_url($brochure_file); ?>" download target="_blank" id="btn-get-brochure"
                            class="px-8 py-4 text-white border border-white rounded-full hover:bg-white/10 transition duration-500 flex items-center space-x-4">
                            <span class="text-xs font-semibold">Download Brochure</span>
                            <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="">
                        </a>
                    <?php else: ?>
                        <button
                            class="opacity-50 cursor-not-allowed px-8 py-4 text-white border border-white rounded-full flex items-center space-x-4"
                            disabled>
                            <span class="text-xs font-semibold">Brochure Unavailable</span>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col justify-center items-center fade-up" data-scroll data-scroll-class="is-inview"
                    data-scroll-delay="400ms">
                    <div class="mb-6">
                        <img src="<?php echo get_template_directory_uri() ?>/images/icons/list.png" alt="brochure">
                    </div>
                    <button id="btn-request-pricelist"
                        class="open-form-popup px-6 py-4 text-white  border border-white rounded-full hover:bg-white/10 transition duration-500 flex items-center space-x-4"
                        data-form="pricelist" data-title="REQUEST PRICELIST">
                        <span class="text-xs font-semibold">Request Pricelist</span>
                        <img src="<?php echo get_template_directory_uri() ?>/images/arrow-white.png" alt="">
                    </button>
                </div>
            </div>
        </section>
    </main>

    <div id="contact-popup" class="fixed inset-0 z-[100] hidden items-center justify-center">
        <div class="absolute inset-0 bg-black/70" id="close-overlay"></div>

        <div class="relative bg-white w-full max-w-6xl  py-8 px-24 shadow-2xl border-jhl-gray-3 border-5 z-10">
            <button id="close-contact" class="absolute top-4 right-4 text-black/50 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div id="popup-heading" class="text-[28px] mb-12 uppercase">TEST DRIVE FORM</div>

            <!-- Form 1: Test Drive -->
            <div id="form-container-test-drive" class="cf7-popup-wrapper td-form hidden">
                <?php echo do_shortcode('[contact-form-7 id="4fa6cd3" title="Test Drive Form"]'); ?>
            </div>

            <!-- Form 3: Pricelist -->
            <div id="form-container-pricelist" class="cf7-popup-wrapper td-form hidden">
                <!-- Replace ID/Title if needed -->
                <?php echo do_shortcode('[contact-form-7 id="a6761b5" title="PRICELIST FORM"]'); ?>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            // Open Popup Logic
            jQuery('.open-form-popup').on('click', function (e) {
                e.preventDefault();
                const title = jQuery(this).data('title');
                const formType = jQuery(this).data('form'); // test-drive, brochure, pricelist

                // Set Title
                jQuery('#popup-heading').text(title);

                // Hide all specific forms first
                jQuery('#contact-popup .cf7-popup-wrapper').addClass('hidden');

                // Show the specific form container
                jQuery('#form-container-' + formType).removeClass('hidden');

                // Show the modal
                jQuery('#contact-popup').removeClass('hidden').addClass('flex');
                jQuery('body').addClass('overflow-hidden');
            });

            // Function to Close Popup
            function closePopup() {
                jQuery('#contact-popup').addClass('hidden').removeClass('flex');
                jQuery('body').removeClass('overflow-hidden');
                // Optional: Reset form states if needed
            }

            // Close events
            jQuery('#close-contact').on('click', closePopup);
            jQuery('#close-overlay').on('click', closePopup);
        });
        jQuery(document).ready(function ($) {
            // Main Banners Slider
            jQuery('.banner-slider-main').slick({
                dots: true,
                arrows: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
                appendDots: jQuery('#banner-dots-container'),
                pauseOnHover: false
            });

            // Color Content Slider
            function initColorSlider() {
                jQuery('.color-content-item').each(function () {
                    var $main = jQuery(this).find('.color-slick-slider');
                    var $nav = jQuery(this).find('.color-nav-slider');

                    $main.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        fade: false,
                        asNavFor: $nav,
                        centerMode: true,
                        infinite: true,
                        prevArrow: '<button type="button" class="slick-prev !left-0 !md:left-10 z-10"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/prev.png" /></button>',
                        nextArrow: '<button type="button" class="slick-next !right-0 !md:right-10 z-10"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/next.png" /></button>',
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    centerPadding: '5%',
                                }
                            }
                        ]
                    });

                    $nav.slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: $main,
                        dots: false,
                        centerMode: false,
                        focusOnSelect: true,
                        arrows: false,
                        infinite: true
                    });
                });
            }

            initColorSlider();

            // Color Swatch Switcher
            jQuery('.color-swatch-trigger').on('click', function () {
                const target = jQuery(this).data('target');
                const nameTarget = jQuery(this).data('color-name');
                const swatchColor = jQuery(this).data('swatch-color');

                // Update trigger UI
                jQuery('.color-swatch-trigger').removeClass('is-active');
                jQuery('.color-swatch-trigger').find('> div').css('border-color', '#ccc');

                jQuery(this).addClass('is-active');

                // Border color logic: use swatch color unless it's white
                let borderColor = swatchColor;
                const cleanColor = swatchColor.replace('#', '').toLowerCase();
                if (cleanColor === 'ffffff' || cleanColor === 'fff' || cleanColor === 'white') {
                    borderColor = '#000000';
                }
                jQuery(this).find('> div').css('border-color', borderColor);

                // Update names
                jQuery('.color-name').removeClass('opacity-100').addClass('opacity-0');
                jQuery('#' + nameTarget).removeClass('opacity-0').addClass('opacity-100');

                // Update content
                jQuery('.color-content-item').addClass('hidden');
                const $target = jQuery('#' + target);
                $target.removeClass('hidden');

                // Refresh slick in hidden container
                $target.find('.color-slick-slider').slick('setPosition');
                $target.find('.color-nav-slider').slick('setPosition');
            });
        });
    </script>

<?php endwhile; ?>

<style>
    .color-nav-slider .slick-slide {
        opacity: 0.4;
        transition: opacity 0.3s ease;
    }

    .color-nav-slider .slick-current {
        opacity: 1;
    }

    .color-nav-slider .slick-slide img {
        border: 1px solid #d1d5db;
        /* gray-300 */
    }

    .color-nav-slider .slick-current img {
        border-color: #000;
    }
</style>

<?php get_footer(); ?>