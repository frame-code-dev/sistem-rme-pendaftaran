<div class="grid grid-cols-2 gap-3">
    <!-- Urine -->
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Berat Jenis<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Berat Jenis" name="berat_jenis" id="berat_jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("berat_jenis") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.berat_jenis")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.berat_jenis") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">pH<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan pH" name="ph" id="ph" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("ph") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.ph")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.ph") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Warna<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Warna" name="warna" id="warna" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("warna") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.warna")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.warna") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Protein<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Protein" name="protein" id="protein" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("protein") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.protein")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.protein") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Reduksi<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Reduksi" name="reduksi" id="reduksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("reduksi") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.reduksi")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.reduksi") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Keton<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Keton" name="keton" id="keton" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("keton") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.keton")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.keton") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nitrit<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Nitrit" name="nitrit" id="nitrit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("nitrit") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.nitrit")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.nitrit") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Urobilin<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Urobilin" name="urobilin" id="urobilin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("urobilin") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.urobilin")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.urobilin") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Bilirubin<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Bilirubin" name="bilirubin" id="bilirubin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("bilirubin") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.bilirubin")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.bilirubin") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lekosit<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Lekosit" name="lekosit" id="lekosit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("lekosit") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.lekosit")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.lekosit") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Eritrosit<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Eritrosit" name="eritrosit" id="eritrosit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("eritrosit") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.eritrosit")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.eritrosit") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lekosit<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Lekosit" name="lekosit_urine" id="lekosit_urine" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("lekosit_urine") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.lekosit_urine")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.lekosit_urine") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Epital<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Epital" name="epital" id="epital" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("epital") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.epital")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.epital") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Silinder<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Silinder" name="silinder" id="silinder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("silinder") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.silinder")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.silinder") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kristal<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Kristal" name="kristal" id="kristal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("kristal") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.kristal")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.kristal") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lainnya<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Lainnya" name="lainnya" id="lainnya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("lainnya") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.lainnya")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.lainnya") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>