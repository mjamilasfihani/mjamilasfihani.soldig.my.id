<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', service('request')->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mohammad Jamil Asfihani">

    <!-- General CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/googlefont-nunito.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome-all.min.css">

    <!-- Plugins -->
    <?= $this->renderSection('css'); ?>

    <!-- Template CSS -->

    <!-- Title -->
    <title><?= ucwords(basename(current_url())); ?> &mdash; Mohammad Jamil Asfihani</title>
</head>
<body>
<?= $this->renderSection('app'); ?>

<!-- Modal -->
<?= $this->renderSection('modal'); ?>
<!-- End of Modal -->

<!-- General JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugins -->
<?= $this->renderSection('js'); ?>

<!-- Page Specific JS -->
<?= $this->renderSection('script'); ?>

<!-- Template JS -->
<script type="text/javascript" src="assets/js/theme.js"></script>
</body>
</html>
