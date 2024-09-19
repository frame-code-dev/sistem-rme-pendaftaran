<div class="grid grid-cols-2 gap-3">
    <!-- Imonologi -->
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Golongan Darah<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Golongan Darah" name="golongan_darah" id="golongan_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("golongan_darah") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.golongan_darah")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.golongan_darah") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tes Kehamilan<span class="me-2 text-red-500">*</span></label>
        <input type="text" placeholder="Masukkan Tes Kehamilan" name="test_kehamilan" id="test_kehamilan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
        value="<?= set_value("test_kehamilan") ?>">
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.test_kehamilan")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.test_kehamilan") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Thypi O<span class="me-2 text-red-500">*</span></label>
        <select name="salmonella_o" id="salmonella_o"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.salmonella_o")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.salmonella_o") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Thypi H<span class="me-2 text-red-500">*</span></label>
        <select name="salmonella_h" id="salmonella_h"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
    
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.salmonella_h")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.salmonella_h") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Parathypi A<span class="me-2 text-red-500">*</span></label>
        <select name="parathypi_a" id="parathypi_a"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.parathypi_a")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.parathypi_a") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Parathypi B<span class="me-2 text-red-500">*</span></label>
        <select name="parathypi_b" id="parathypi_b"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
    
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.parathypi_b")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.parathypi_b") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">HbsAg<span class="me-2 text-red-500">*</span></label>
        <select name="hbsag" id="hbsag"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
    
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.hbsag")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.hbsag") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Sifilis<span class="me-2 text-red-500">*</span></label>
        <select name="sifilis" id="sifilis"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
    
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.sifilis")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.sifilis") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="">
        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">HIV<span class="me-2 text-red-500">*</span></label>
        <select name="hiv" id="hiv"  class="w-full border border-gray-300 rounded p-2">
            <option> -- Pilih -- </option>
        </select>
    
        <div class="text-red-500 text-xs italic font-semibold">
            <?php if (session("errors.hiv")) : ?>
                <div class="text-red-500 text-sm">
                    <?= session("errors.hiv") ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>