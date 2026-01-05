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
    <div class="grid md:grid-cols-4 gap-4">
        <?php
        if (!empty($external_dealers) && is_array($external_dealers)):
            foreach ($external_dealers as $dealer):
                // Extracting data from the REST API object
                $title = $dealer->title->rendered;

                // ACF fields usually reside in the 'acf' key in REST API
                $acf = $dealer->acf;
                $address = isset($acf->address) ? $acf->address : '';
                $business_hours = isset($acf->business_hours) ? $acf->business_hours : '';
                $whatsapp = isset($acf->whatsapp) ? $acf->whatsapp : '#';
                $phone = isset($acf->phone) ? $acf->phone : '#';
                $location = isset($acf->location) ? $acf->location : '#';

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
<?php get_footer(); ?>