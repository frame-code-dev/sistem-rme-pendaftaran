<div class="grid grid-cols-2 gap-3">
    <!-- Klinik Kimia + Hematologi -->
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nilai Normal<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Nilai Normal" name="nilai_normal" id="nilai_normal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("nilai_normal") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.nilai_normal")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.nilai_normal") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Hasil<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Hasil" name="hasil" id="hasil" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("hasil") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.hasil")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.hasil") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Satuan<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Satuan" name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("satuan") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.satuan")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.satuan") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>