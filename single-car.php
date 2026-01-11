<?php get_header(); ?>

<?php
while (have_posts()):
    the_post();
    $car_id = get_the_ID();

    $banners = get_field('car_banner');
    $colors = get_field('colors');
    $price = get_field('price');
    $specs = get_field('specifications');
    $accessories = get_field('accessories');
    ?>

    <main class="single-car-template">

        <section id="banner" class="relative overflow-hidden">
            <div class="banner-slider-main">
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
                    <h2 class="text-center text-3xl font-light tracking-widest uppercase">PILIHAN WARNA</h2>
                    <div>
                        <img src="<?php echo esc_url(get_field('logo')); ?>" alt="">
                    </div>
                </div>
                <div class="color-display-container max-w-5xl mx-auto mb-12">
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
                                                class="w-full h-[409px] object-contain rounded-lg" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($right_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($right_side); ?>"
                                                class="w-full h-[409px] object-contain rounded-lg" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($back_side): ?>
                                        <div class="px-2">
                                            <img src="<?php echo esc_url($back_side); ?>"
                                                class="w-full h-[409px] object-contain rounded-lg" alt="">
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
                                ?>
                                <?php
                                $is_white = (trim(strtolower($swatch_color), '#') === 'ffffff' || trim(strtolower($swatch_color), '#') === 'fff' || strtolower($swatch_color) === 'white');
                                $active_border = $is_white ? '#000000' : $swatch_color;
                                ?>
                                <div class="flex flex-col items-center group cursor-pointer color-swatch-trigger <?php echo $index === 0 ? 'is-active' : ''; ?>"
                                    data-target="color-content-<?php echo $color->ID; ?>"
                                    data-color-name="color-name-<?php echo $color->ID; ?>"
                                    data-swatch-color="<?php echo esc_attr($swatch_color); ?>">
                                    <div class="w-6 h-6 rounded-full border p-1 transition-all"
                                        style="background-color: <?php echo esc_attr($swatch_color); ?>; background-clip: content-box; border: 1px solid <?php echo $index === 0 ? esc_attr($active_border) : '#ccc'; ?>;">
                                    </div>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>

                    <div class="color-names-container relative h-4 w-full">
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
            <div class="container text-center">
                <p class="body text-jhl-gray-1 mb-2">Start from</p>
                <div class="md:text-5xl font-semibold text-jhl-black text-4xl">
                    <?php echo $price ? $price : 'Contact for Price'; ?>
                </div>
                <p class="text-[10px] max-w-[308px] uppercase text-jhl-gray-1 mx-auto tracking-widest mt-4">
                    *Price OTR Jakarta. Terms & conditions apply <br />
                    *CKD Unit Only
                </p>
        </section>

        <!-- 4. Spec Section -->
        <!-- <section id="specs" class="py-24 bg-beijing-black text-white">
            <div class="container">
                <div class="flex justify-between items-end mb-16">
                    <h2 class="text-3xl font-light tracking-widest uppercase italic">Specifications</h2>
                    <a href="#" class="text-xs font-semibold tracking-widest flex items-center uppercase text-jhl-gray-1">
                        <span>Download Brochure</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/icons/download.png" class="ml-2 w-4"
                            alt="">
                    </a>
                </div>

                <div class="grid md:grid-cols-2 gap-x-32 gap-y-6">
                    <?php if ($specs):
                        foreach ($specs as $spec): ?>
                            <div class="flex justify-between items-center py-4 border-b border-white/10">
                                <span class="text-sm uppercase tracking-widest text-jhl-gray-1">
                                    <?php echo esc_html($spec['label']); ?>
                                </span>
                                <span class="text-lg font-medium italic">
                                    <?php echo esc_html($spec['value']); ?>
                                </span>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <div class="flex justify-between items-center py-4 border-b border-white/10">
                            <span class="text-sm uppercase tracking-widest text-jhl-gray-1">Engine</span>
                            <span class="text-lg font-medium italic">
                                <?php echo get_field('engine'); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-white/10">
                            <span class="text-sm uppercase tracking-widest text-jhl-gray-1">Transmission</span>
                            <span class="text-lg font-medium italic">
                                <?php echo get_field('transmission'); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-white/10">
                            <span class="text-sm uppercase tracking-widest text-jhl-gray-1">Max Power</span>
                            <span class="text-lg font-medium italic">
                                <?php echo get_field('max_power'); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-white/10">
                            <span class="text-sm uppercase tracking-widest text-jhl-gray-1">Dimensions</span>
                            <span class="text-lg font-medium italic">
                                <?php echo get_field('dimensions'); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section id="accessories" class="py-24 bg-white">
            <div class="container">
                <h2 class="text-center text-3xl font-light tracking-widest uppercase mb-16">Accessories</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <?php if ($accessories):
                        foreach ($accessories as $accessory):
                            $acc_img = get_the_post_thumbnail_url($accessory->ID, 'medium');
                            ?>
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-full aspect-square bg-[#F1F1F1] rounded-xl flex items-center justify-center mb-6 overflow-hidden">
                                    <?php if ($acc_img): ?>
                                        <img src="<?php echo esc_url($acc_img); ?>"
                                            alt="<?php echo esc_attr($accessory->post_title); ?>"
                                            class="w-full h-full object-contain p-4 hover:scale-110 transition-transform duration-500">
                                    <?php else: ?>
                                        <div class="text-jhl-gray-3 uppercase text-xs">No Image</div>
                                    <?php endif; ?>
                                </div>
                                <h6 class="text-xs font-semibold tracking-widest uppercase text-jhl-black">
                                    <?php echo $accessory->post_title; ?>
                                </h6>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </section> -->

    </main>

    <script>
        $(document).ready(function () {
            // Main Banners Slider
            $('.banner-slider-main').slick({
                dots: true,
                arrows: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
                appendDots: $('#banner-dots-container'),
                pauseOnHover: false
            });

            // Color Content Slider
            function initColorSlider() {
                $('.color-content-item').each(function () {
                    var $main = $(this).find('.color-slick-slider');
                    var $nav = $(this).find('.color-nav-slider');

                    $main.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        fade: false,
                        asNavFor: $nav,
                        centerMode: true,
                        infinite: true,
                        prevArrow: '<button type="button" class="slick-prev !left-10 z-10"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/prev.png" /></button>',
                        nextArrow: '<button type="button" class="slick-next !right-10 z-10"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/next.png" /></button>',
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
                        centerMode: true,
                        focusOnSelect: true,
                        arrows: false,
                        infinite: true
                    });
                });
            }

            initColorSlider();

            // Color Swatch Switcher
            $('.color-swatch-trigger').on('click', function () {
                const target = $(this).data('target');
                const nameTarget = $(this).data('color-name');
                const swatchColor = $(this).data('swatch-color');

                // Update trigger UI
                $('.color-swatch-trigger').removeClass('is-active');
                $('.color-swatch-trigger').find('> div').css('border-color', '#ccc');

                $(this).addClass('is-active');

                // Border color logic: use swatch color unless it's white
                let borderColor = swatchColor;
                const cleanColor = swatchColor.replace('#', '').toLowerCase();
                if (cleanColor === 'ffffff' || cleanColor === 'fff' || cleanColor === 'white') {
                    borderColor = '#000000';
                }
                $(this).find('> div').css('border-color', borderColor);

                // Update names
                $('.color-name').removeClass('opacity-100').addClass('opacity-0');
                $('#' + nameTarget).removeClass('opacity-0').addClass('opacity-100');

                // Update content
                $('.color-content-item').addClass('hidden');
                const $target = $('#' + target);
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