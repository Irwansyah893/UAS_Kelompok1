<?= $this->extend('layout/main') ?>
<?= $this->Section('menu') ?>
<li class="has-submenu">
    <a href="<?= base_url('Layout') ?>"><i class="mdi mdi-airplay"></i>Beranda</a>
</li>
<li class="has-submenu">
    <a href="<?= base_url('Dosen') ?>">
    <span class="mdi mdi-account-multiple"></span></i> Dosen</a>
</li>
<li class="has-submenu">
    <a href="<?= base_url('Matakuliah') ?>"><span class="mdi mdi-animation"></span> Mata Kuliah</a>
</li>
<?= $this->endSection() ?>