<?php get_header(); ?>
<section class="py-28 container">
    <img src="<?php echo get_template_directory_uri() ?>/images/map.png" class="mx-auto w-full" alt="">
</section>
<section class="pb-28 container !md:px-0">
    <h2 class="text-center uppercase mb-14">Authorized Dealers</h2>
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
                    <div class="mb-[30px]">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large', ['class' => 'rounded-lg h-[282px] object-cover w-full']); ?>
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/alsut.png" alt=""
                                class="rounded-lg h-[282px] object-cover w-full">
                        <?php endif; ?>
                    </div>
                    <h5 class="mb-7 tracking-wider text-jhl-black">
                        <?php the_title(); ?>
                    </h5>
                    <p class="body mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>
                    <p class="body text-jhl-black mb-10">
                        <span class="font-bold">Business Hours:</span>
                        <?php echo get_field('business_hours') ?>
                    </p>
                    <div class="flex space-x-4">
                        <a href="<?php get_field('whatsapp') ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/WhatsApp.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                        <a href="<?php get_field('phone ') ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/Phone.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                        <a href="<?php get_field('location') ?>" class="bg-jhl-black p-[5px] rounded block">
                            <img src="<?php echo get_template_directory_uri() ?>/images/Locaiton.png"
                                class="h-[22px] w-[22px] object-contain" alt="">
                        </a>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</section>
<section class="py-20 relative h-[615px]">
    <div class="absolute left-0 top-0 w-full h-[80%] bg-gradient-to-b from-jhl-black to-transparent z-[5] opacity-70">
    </div>
    <div class="absolute left-0 top-0 w-full h-full z-0">
        <img src="<?php echo get_template_directory_uri() ?>/images/armada.png" class="h-full w-full object-cover"
            alt="">
    </div>
    <div class="container text-white flex justify-between relative z-10">
        <div>
            <h2 class="mb-4">Armada Bisnis</h2>
            <p class="body mb-9">Solusi lengkap kebutuhan perusahaan Anda</p>
            <a href=""
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
<?php get_footer();