<div class="grid grid-cols-2 gap-3">
    <!-- Faces -->
    <div class="border p-3">
        <div class="cols-span-2 w-full bg-gray-50 rounded-lg border border-gray-200">
            <span class="block mb-2 text-sm font-semibold text-gray-900">MIKROSKOPIS</span>
        </div>
        <div class="grid grid-cols-1 gap-3">
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Konsistensi<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Konsistensi" name="konsistensi" id="konsistensi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("konsistensi") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.konsistensi")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.konsistensi") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-2">
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
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Darah<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Darah" name="darah" id="darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("darah") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.darah")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.darah") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lendir<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Lendir" name="lendir" id="lendir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("lendir") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.lendir")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.lendir") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="border p-3">
        <div class="cols-span-2 w-full bg-gray-50 rounded-lg border border-gray-200">
            <span class="block mb-2 text-sm font-semibold text-gray-900">MAKROSKOPIS</span>
        </div>
        <div class="grid grid-cols-1 gap-3">
            <div class="mb-2">
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
            <div class="mb-2">
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
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Cysta<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Cysta" name="cysta" id="cysta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("cysta") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.cysta")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.cysta") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Amoeba<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Amoeba" name="amoeba" id="amoeba" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("amoeba") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.amoeba")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.amoeba") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-2">
                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Telur Cacing<span class="me-2 text-red-500">*</span></label>
                <input type="text" placeholder="Masukkan Telur Cacing" name="telur_cacing" id="telur_cacing" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="<?= set_value("telur_cacing") ?>">
                <div class="text-red-500 text-xs italic font-semibold">
                    <?php if (session("errors.telur_cacing")) : ?>
                        <div class="text-red-500 text-sm">
                            <?= session("errors.telur_cacing") ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <div class="mb-2">
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
    </div>
</div>