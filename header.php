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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-zinc-900 antialiased'); ?>>
    <?php do_action('tailpress_site_before'); ?>

    <div id="page" class="min-h-screen flex flex-col">
        <?php do_action('tailpress_header'); ?>

        <header class="fixed z-40 top-4 left-1/2 -translate-x-1/2 max-w-[1200px] w-full">

            <div class="flex items-center justify-between text-white rounded-full py-[11px] px-[35px] isolate w-full">
                <div class="absolute inset-0 bg-[#171717]/30 backdrop-blur-2xl rounded-full -z-10"></div>

                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/logo.png" class="h-[14px]" alt="">
                </div>
                <div class="hidden md:block">
                    <nav>
                        <ul class="flex items-center space-x-10 text-sm font-medium">
                            <li><a href="/" class="uppercase text-[13px] !no-underline">Home</a></li>

                            <li class="group relative py-2">
                                <div class="uppercase text-[13px] !no-underline cursor-default">Product</div>

                                <ul
                                    class="absolute left-1/2 -translate-x-1/2 top-full py-6 w-[700px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                                    <div class="p-[24px] space-y-3 isolate relative">
                                        <div
                                            class="absolute inset-0 mb-0 bg-[#171717]/30 backdrop-blur-2xl rounded-xl shadow-2xl -z-10 border border-white/10">
                                        </div>

                                        <div>
                                            <h5 class="!text-white mb-6 text-lg font-semibold">Products</h5>

                                            <div class="grid grid-cols-3 gap-6">
                                                <?php
                                                $args = array(
                                                    'post_type' => 'cars',
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

                                                        <div class="flex flex-col items-center text-center space-y-3">
                                                            <div
                                                                class="w-full aspect-video overflow-hidden rounded-lg bg-white/5">
                                                                <?php if ($car_image): ?>
                                                                    <img src="<?php echo esc_url($car_image); ?>"
                                                                        alt="<?php the_title(); ?>"
                                                                        class="w-full h-full object-contain hover:scale-105 transition-transform duration-300">
                                                                <?php endif; ?>
                                                            </div>

                                                            <h6 class="text-white font-medium text-sm"><?php the_title(); ?>
                                                            </h6>

                                                            <a href="<?php the_permalink(); ?>"
                                                                class="px-4 py-2 border border-white/30 text-white text-[11px] uppercase tracking-widest hover:bg-white hover:text-black transition-colors duration-300 rounded">
                                                                Explore
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
                                <a href="/news" class="uppercase text-[13px] font-medium !no-underline">
                                    Service
                                </a>
                            </li>


                            <li>
                                <a href="/news" class="uppercase text-[13px] font-medium !no-underline">
                                    Promotion
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div>
                    <a href="#" class="text-[13px] font-medium flex items-center !no-underline space-x-1">
                        <img src="<?php echo get_template_directory_uri() ?>/images/icon-contact.png" class="size-3"
                            alt="">
                        <span>Contact</span>
                    </a>
                </div>
            </div>
        </header>

        <div id="content" class="site-content grow">
            <?php if (is_front_page()): ?>
            <?php endif; ?>

            <?php do_action('tailpress_content_start'); ?>
            <main>