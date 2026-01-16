<?php

/**
 * Theme footer template.
 *
 * @package TailPress
 */
?>
</main>

<?php do_action('tailpress_content_end'); ?>
</div>

<?php do_action('tailpress_content_after'); ?>

<footer class="bg-jhl-black text-white py-11 md:pt-16 md:pb-8" role="contentinfo">
    <div class="container">
        <div class="flex flex-wrap md:flex-nowrap justify-between space-y-24 md:space-y-0">
            <div class="flex flex-wrap md:flex-nowrap items-center" id="logo">
                <div class="pr-10 mb-14 md:mb-0 md:mr-10 md:border-r border-jhl-gray-2">
                    <img src="<?php echo get_template_directory_uri() ?>/images/logo-jhl.png" alt="" class="mb-5">
                    <p class="text-xs text-center">
                        Service You Can Trust, <br /> Peace of Mind You Deserve
                    </p>
                </div>
                <div>
                    <p class="font-bold text-[13px] mb-4">
                        JHL AUTO - Head Office
                    </p>
                    <p class="text-xs leading-6">
                        Jl. Jalur Sutera Boulevard Kav. 30 <br />
                        Kota Tangerang, Banten - 15143
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap md:space-x-16 w-full md:w-fit" id="footer-nav">
                <div class="w-[48%] md:w-fit mb-20 md:mb-0">
                    <p class="font-medium text-[10px] text-jhl-gray-1 uppercase leading-[27px] tracking-widest mb-6">
                        NAVIGASI
                    </p>
                    <ul class="text-white space-y-3">
                        <li>
                            <a href="https://jhl.codeomnia.com/our-story" class="text-xs !no-underline">
                                Our Story
                            </a>
                        </li>
                        <li>
                            <a href="https://jhl.codeomnia.com/career" class="text-xs !no-underline">
                                Career
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-[48%] md:w-fit order-3 md:order-2">
                    <p class="font-medium text-[10px] text-jhl-gray-1 uppercase leading-[27px] tracking-widest mb-6">
                        Brands
                    </p>
                    <ul class="text-white space-y-3">
                        <li>
                            <a href="/" class="text-xs !no-underline">
                                BAIC
                            </a>
                        </li>
                        <li>
                            <a href="https://jhl.codeomnia.com/service" class="text-xs !no-underline">
                                Service Center
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-[48%] md:w-fit order-2 md:order-3">
                    <p class="font-medium text-[10px] text-jhl-gray-1 uppercase leading-[27px] tracking-widest mb-6">
                        Updates
                    </p>
                    <ul class="text-white space-y-3">
                        <li>
                            <a href="https://jhl.codeomnia.com/news" class="text-xs !no-underline">
                                News
                            </a>
                        </li>
                        <li>
                            <a href="https://jhl.codeomnia.com/news?type=promo" class="text-xs !no-underline">
                                Promo
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mx-auto pt-6 border-t md:text-center mt-20 border-jhl-gray-1 opacity-60">
            <div class="text-xs text-[#939598]">
                &copy; JHL Auto <?php echo esc_html(date_i18n('Y')); ?> - | All Rights Reserved
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>