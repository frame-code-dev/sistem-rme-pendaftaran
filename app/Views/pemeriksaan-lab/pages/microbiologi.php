<div class="grid grid-cols-2 gap-3">
    <!-- Microbiologi -->
        <div class="">
            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Malaria<span class="me-2 text-red-500">*</span></label>
            <input type="text" placeholder="Masukkan Malaria" name="malaria" id="malaria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
            value="<?= set_value("malaria") ?>">
            <div class="text-red-500 text-xs italic font-semibold">
                <?php if (session("errors.malaria")) : ?>
                    <div class="text-red-500 text-sm">
                        <?= session("errors.malaria") ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">BTA<span class="me-2 text-red-500">*</span></label>
            <input type="text" placeholder="Masukkan BTA" name="bta" id="bta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
            value="<?= set_value("bta") ?>">
            <div class="text-red-500 text-xs italic font-semibold">
                <?php if (session("errors.bta")) : ?>
                    <div class="text-red-500 text-sm">
                        <?= session("errors.bta") ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">TCM<span class="me-2 text-red-500">*</span></label>
            <input type="text" placeholder="Masukkan TCM" name="tcm" id="tcm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
            value="<?= set_value("tcm") ?>">
            <div class="text-red-500 text-xs italic font-semibold">
                <?php if (session("errors.tcm")) : ?>
                    <div class="text-red-500 text-sm">
                        <?= session("errors.tcm") ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">MH<span class="me-2 text-red-500">*</span></label>
            <input type="text" placeholder="Masukkan MH" name="mh" id="mh" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
            value="<?= set_value("mh") ?>">
            <div class="text-red-500 text-xs italic font-semibold">
                <?php if (session("errors.mh")) : ?>
                    <div class="text-red-500 text-sm">
                        <?= session("errors.mh") ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Trichomonas Vaginalis<span class="me-2 text-red-500">*</span></label>
            <input type="text" placeholder="Masukkan Trichomonas Vaginalis" name="tv" id="tv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
            value="<?= set_value("tv") ?>">
            <div class="text-red-500 text-xs italic font-semibold">
                <?php if (session("errors.tv")) : ?>
                    <div class="text-red-500 text-sm">
                        <?= session("errors.tv") ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>