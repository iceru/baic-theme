<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-zinc-900 antialiased'); ?>>
    <?php do_action('tailpress_site_before'); ?>

    <div id="page" class="min-h-screen flex flex-col">
        <?php do_action('tailpress_header'); ?>

        <header data-aos="fade-down" data-aos-duration="1000"
            class="fixed z-40 top-4 left-1/2 -translate-x-1/2 max-w-[1200px] hidden md:block w-full">

            <div class="flex items-center justify-between text-white py-[11px] px-[35px] w-full isolate">
                <div class="absolute inset-0 bg-[#171717]/30 backdrop-blur-2xl rounded-full -z-10"></div>
                <div>
                    <a href="/">
                        <img src="<?php echo get_template_directory_uri() ?>/images/logo.png" class="h-[14px]" alt="">
                    </a>
                </div>
                <div class="hidden md:block">
                    <nav>
                        <ul class="flex items-center space-x-10 text-sm font-medium">
                            <li><a href="/" class="uppercase text-[13px] !no-underline">Home</a></li>

                            <li class="group relative py-2">
                                <div class="uppercase text-[13px] !no-underline cursor-default">Product</div>

                                <ul
                                    class="absolute left-1/2 translate-y-2 group-hover:translate-y-0 -translate-x-[40%] top-full py-6 w-[700px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                                    <div class="px-10 py-8 space-y-3 relative isolate">
                                        <div id="products-popup"
                                            class="absolute inset-0 mb-0 bg-[#171717]/30 backdrop-blur-2xl rounded-xl shadow-2xl z-0 border border-white/10">
                                        </div>

                                        <div class="relative z-10">
                                            <h5 class="!text-white mb-6 text-lg font-semibold">Products</h5>

                                            <div class="grid grid-cols-3 gap-14">
                                                <?php
                                                $args = array(
                                                    'post_type' => 'car',
                                                    'posts_per_page' => 6,
                                                    'orderby' => 'title',
                                                    'order' => 'ASC',
                                                );

                                                $car_query = new WP_Query($args);

                                                if ($car_query->have_posts()):
                                                    while ($car_query->have_posts()):
                                                        $car_query->the_post();
                                                        $car_image = get_field('car_image', get_the_ID());
                                                        ?>

                                                        <div class="flex flex-col items-center text-center space-y-5">
                                                            <div class="w-full aspect-video overflow-hidden rounded-lg">
                                                                <?php if ($car_image): ?>
                                                                    <img src="<?php echo esc_url($car_image); ?>"
                                                                        alt="<?php the_title(); ?>"
                                                                        class="w-full h-full object-contain transition-transform duration-300">
                                                                <?php endif; ?>
                                                            </div>

                                                            <h6 class="text-white font-medium text-sm"><?php the_title(); ?>
                                                            </h6>

                                                            <a href="<?php the_permalink(); ?>"
                                                                class="px-4 py-2 border border-white text-white text-[11px] uppercase 
                                                                tracking-widest hover:bg-white/20 transition-colors 
                                                                duration-300 rounded flex items-center space-x-2 group">
                                                                <img src="<?php echo get_template_directory_uri() ?>/images/chev-right-white.png"
                                                                    class="" alt="">
                                                                <span>Explore</span>
                                                            </a>
                                                        </div>

                                                    <?php endwhile;
                                                    wp_reset_postdata();
                                                else: ?>
                                                    <p class="text-white text-sm col-span-3">No cars found.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </li>

                            <li>
                                <a href="/service" class="uppercase text-[13px] font-medium !no-underline">
                                    Service
                                </a>
                            </li>


                            <li>
                                <a href="https://jhl-auto.codeomnia.com/news"
                                    class="uppercase text-[13px] font-medium !no-underline">
                                    Promotion
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div>
                    <a href="https://jhl-auto.codeomnia.com"
                        class="text-[13px] font-medium flex items-center !no-underline space-x-1">
                        <img src="<?php echo get_template_directory_uri() ?>/images/logo-jhl.png" class="h-7 w-auto"
                            alt="">
                    </a>
                </div>
            </div>
        </header>

        <header
            class="md:hidden w-full  px-4 py-9 bg-gradient-to-b from-black to-black/90 flex justify-between items-center z-50">
            <div class="space-y-3 cursor-pointer" id="sidebar-btn">
                <div class="h-[1px] w-8 bg-white"></div>
                <div class="h-[1px] w-8 bg-white"></div>
            </div>
            <div>
                <a href="/">
                    <img src="<?php echo get_template_directory_uri() ?>/images/logo-jhl.png" class="h-7" alt="">
                </a>
            </div>
        </header>

        <aside id="main-sidebar"
            class="fixed inset-0 z-[100] bg-[#171717]/30 backdrop-blur-2xl transform -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="flex flex-col justify-between items-center h-full pt-[22px] pb-24">

                <div class="flex justify-between items-center w-full px-4" id="sidebar-header">
                    <div id="back-container" class="invisible opacity-0 transition-opacity duration-200 cursor-pointer">
                        <div class="back-to-main text-white text-sm uppercase tracking-widest font-medium">
                            <img src="<?php echo get_template_directory_uri() ?>/images/icons/chev-white.png" class=""
                                alt="">
                        </div>
                    </div>
                    <div id="close-sidebar"
                        class="text-white text-2xl uppercase tracking-widest font-medium cursor-pointer">✕</div>
                </div>

                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/logo-jhl.png" class="h-14" alt="">
                </div>

                <div class="w-full relative overflow-hidden h-[300px]">
                    <ul id="menu-main"
                        class="flex flex-col space-y-8 justify-center items-center px-10 text-center transition-all duration-300">
                        <li><a href="/" class="text-white uppercase font-medium tracking-widest">Home</a></li>
                        <li><a href="javascript:void(0)" data-target="submenu-product"
                                class="submenu-trigger text-white uppercase font-medium tracking-widest">Product</a>
                        </li>
                        <li><a href="/service" class="text-white uppercase font-medium tracking-widest">
                                Service
                            </a>
                        </li>
                        <li><a href="/news" class="text-white uppercase font-medium tracking-widest">News &
                                Promotion</a></li>
                    </ul>

                    <div id="submenu-product"
                        class="hidden absolute inset-0 flex flex-col space-y-8 justify-center items-center text-center transition-all duration-300">
                        <div class="flex overflow-auto space-x-4">
                            <?php
                            $args = array(
                                'post_type' => 'car',
                                'posts_per_page' => 6, // Adjust number of cars to show
                                'orderby' => 'title',
                                'order' => 'ASC',
                            );

                            $car_query = new WP_Query($args);

                            if ($car_query->have_posts()):
                                while ($car_query->have_posts()):
                                    $car_query->the_post();
                                    $car_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                    ?>

                                    <a href="<?php the_permalink(); ?>"
                                        class="flex flex-col items-center text-center space-y-5 shrink-0 w-[75%]">
                                        <div class="w-full aspect-video overflow-hidden rounded-lg">
                                            <?php if ($car_image): ?>
                                                <img src="<?php echo esc_url($car_image); ?>" alt="<?php the_title(); ?>"
                                                    class="w-full h-full object-contain transition-transform duration-300">
                                            <?php endif; ?>
                                        </div>

                                        <h6 class="text-white font-medium text-sm"><?php the_title(); ?>
                                        </h6>
                                    </a>

                                <?php endwhile;
                                wp_reset_postdata();
                            else: ?>
                                <p class="text-white text-sm col-span-3">No cars found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="javascript:void(0)" id="open-contact"
                        class="text-[13px] font-medium flex items-center !no-underline space-x-1 tracking-wide text-white">
                        <img src="<?php echo get_template_directory_uri() ?>/images/icons/contact.png" class="size-3 "
                            alt="">
                        <span>Contact</span>
                    </a>
                </div>
            </div>
        </aside>

        <script>
            jQuery(document).ready(function () {
                // Function to reset menu state
                function resetMenu() {
                    jQuery('#back-container').addClass('invisible opacity-0');
                    jQuery('[id^="submenu-"]').addClass('hidden').hide();
                    jQuery('#menu-main').show().css('opacity', '1');
                }

                // Open Sidebar
                jQuery('#sidebar-btn').on('click', function () {
                    jQuery('#main-sidebar').removeClass('-translate-x-full');
                });

                // Close Sidebar
                jQuery('#close-sidebar').on('click', function () {
                    jQuery('#main-sidebar').addClass('-translate-x-full');
                    // Reset to main menu after slide-out animation completes
                    setTimeout(resetMenu, 300);
                });

                // Open Submenu
                jQuery('.submenu-trigger').on('click', function () {
                    const target = jQuery(this).data('target');

                    jQuery('#menu-main').fadeOut(200, function () {
                        jQuery('#' + target).removeClass('hidden').fadeIn(200);
                        // Show Back button in header
                        jQuery('#back-container').removeClass('invisible opacity-0');
                    });
                });

                // Back to Main Menu
                jQuery('.back-to-main').on('click', function () {
                    const visibleSubmenu = jQuery('[id^="submenu-"]:visible');

                    visibleSubmenu.fadeOut(200, function () {
                        jQuery(this).addClass('hidden');
                        jQuery('#menu-main').fadeIn(200);
                        // Hide Back button in header
                        jQuery('#back-container').addClass('invisible opacity-0');
                    });
                });
            });
        </script>

        <div class="fixed bottom-6 right-6 z-[80] flex flex-col items-end space-y-4">
            <button id="social-toggle"
                class="w-11 h-11 rounded-full bg-jhl-gray-1 flex items-center justify-center shadow-md transition-transform duration-300">

                <svg id="toggle-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                    <path d="M18 15l-6-6-6 6" />
                </svg>

                <img id="toggle-share" src="<?php echo get_template_directory_uri(); ?>/images/icons/share.png"
                    class="w-5 h-5" alt="share">
            </button>
            <div id="social-expandable" class="flex flex-col space-y-4 mb-2 hidden">
                <a href="mailto:<?php echo get_field('contact_email', 'option') ?: 'info@jhlauto.co.id'; ?>"
                    class="w-11 h-11 rounded-full bg-jhl-gray-1 flex items-center justify-center shadow-md hover:bg-[#808285] transition-colors">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/email.png" class="w-5 h-5"
                        alt="Email">
                </a>

                <a href="<?php echo get_field('instagram_url', 'option') ?: '#'; ?>" target="_blank"
                    class="w-11 h-11 rounded-full bg-jhl-gray-1 flex items-center justify-center shadow-md hover:bg-[#808285] transition-colors">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/instagram.png" class="w-5 h-5"
                        alt="Instagram">
                </a>

                <a href="<?php echo get_field('tiktok_url', 'option') ?: '#'; ?>" target="_blank"
                    class="w-11 h-11 rounded-full bg-jhl-gray-1 flex items-center justify-center shadow-md hover:bg-[#808285] transition-colors">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/tiktok.png" class="w-5 h-5"
                        alt="TikTok">
                </a>

                <a href="<?php echo get_field('facebook_url', 'option') ?: '#'; ?>" target="_blank"
                    class="w-11 h-11 rounded-full bg-jhl-gray-1 flex items-center justify-center shadow-md hover:bg-[#808285] transition-colors">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook.png" class="w-5 h-5"
                        alt="Facebook">
                </a>
            </div>


            <a href="https://wa.me/<?php echo get_field('whatsapp_number', 'option') ?: '628123456789'; ?>"
                target="_blank" class="flex items-center  rounded-md  transition-all group !no-underline">
                <div class="bg-jhl-black rounded-full p-1 mr-3 h-16 w-16 flex justify-center items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icons/whatsapp.png" class="w-9 h-9"
                        alt="WhatsApp">
                </div>
                <span class=" bg-jhl-foreground p-[9px] rounded font-bold text-sm tracking-widest uppercase">Chat
                    Now</span>
            </a>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                jQuery('#social-toggle').on('click', function () {
                    const $btn = jQuery(this);
                    const $container = jQuery('#social-expandable');
                    const $iconArrow = jQuery('#toggle-icon');
                    const $iconShare = jQuery('#toggle-share');

                    // Toggle state class
                    $btn.toggleClass('is-open');

                    // Animation for the menu
                    $container.slideToggle(300);

                    if ($btn.hasClass('is-open')) {
                        // OPEN STATE: Show Arrow, Hide Share
                        $iconShare.hide();
                        $iconArrow.removeClass('hidden').show();
                        $btn.css('transform', 'rotate(180deg)');
                    } else {
                        // CLOSED STATE (Default): Show Share, Hide Arrow
                        $iconArrow.hide();
                        $iconShare.show();
                        $btn.css('transform', 'rotate(0deg)');
                    }
                });
            });
        </script>

        <div id="content" class="site-content grow">
            <?php if (is_front_page()): ?>
            <?php endif; ?>

            <?php do_action('tailpress_content_start'); ?>
            <main>